<?php

namespace App\Controllers;

use App\Middlewares\AuthMiddleware;
use App\Models\User;
use Devlee\mvccore\FileUpload;
use Devlee\XRouter\Router;
use Devlee\XRouter\Request;
use Devlee\XRouter\Response;

use Devlee\mvccore\Session;
use Devlee\mvccore\Library;
use Devlee\mvccore\SendEmail;

class AuthController
{
  private User $UserObj;
  private Session $session;
  // private $DataAccess;

  public function __construct()
  {

    /**
     * Introducing middle wares
     *
     * Middleware => AuthMiddleware
     *  ::isUser(token);
     *  ::isAdmin(role);
     *
     */

    $this->UserObj = new User();
    $this->session = new Session();
    Router::setLayout('layouts/auth');
    // $this->DataAccess = new DataAccess();
  }

  // Fetch User
  // Basis Authentication
  public function get_user_info(Request $req, Response $res)
  {
    $user = $this->session->get('user');
    $token = $req->body('_sess_token');

    if ($user && $user['_sess_token'] === $token) {
      return $res->json($this->UserObj->findOne(['userID' => $user['userID']]));
    }

    $res->status(401)->json(['message' => 'Unauthorized...']);
  }

  // Register New User
  public function signup(Request $req, Response $res)
  {
    // $res->sendPage('register');
    // exit;
    if ($req->isPost()) {
      $data = $req->body();
      $data['userID'] = Library::generateToken(12);

      $this->UserObj->loadData($data);

      if ($this->UserObj->validate() && $this->UserObj->save()) {
        // Setting User
        $data['_sess_token'] = Library::generateToken(16);
        $this->setUser($data);

        // Setting Toast
        $this->session->setToast("toast", 'Hi, ' . $data['username'] . '. 😎');

        return $res->json([
          "_sess_token" => $data["_sess_token"],
          "_reff" => "_signup",
        ]);
      }

      // Form Errors
      $errors =  $this->UserObj->getErrors();
      return $res->status(422)->json($errors);
    }

    // Register Page
    $res->render('signup');
  }

  // Login
  public function login(Request $req, Response $res)
  {
    if ($req->isPost()) {
      $data = $req->body();

      $this->UserObj->loadData($data);
      $where = ['email' => $data['username'] ?? false, 'username' => $data['username'] ?? false];

      $user_data = $this->UserObj->findOne($where, [], 'OR');
      if ($this->UserObj->validate($data) && $user_data) {
        // Checking User Password

        if (!$this->UserObj->verifyHashed($data['password'], $user_data['password'])) {
          $error_response = [
            'message' => 'Username or password is incorrect'
          ];

          return $res->status(422)->json($error_response);
        }

        $user_data['_sess_token'] = Library::generateToken(16);
        $this->setUser($user_data);

        // Setting Toast
        $this->session->setToast("toast", 'Welcome back, ' . $user_data['username'] . '. 😎');
        return $res->json([
          "_sess_token" => $user_data["_sess_token"],
          "_reff" => "_login",
        ]);
      }

      // Form Errors
      $errors =  $this->UserObj->getErrors();
      $errors['message'] = 'Invalid login credentials';

      return $res->status(422)->json($errors);
    }

    // Register Page
    $res->render('login');
  }

  // Password Reset
  public function resetPassword(Request $req, Response $res)
  {
    $data = $req->body();
    $error = false;

    if ($req->isPost() && $data['reset_email']) {
      $user = $this->UserObj->findOne(["email" => $data['reset_email']], ["username", 'email', "userID"]);

      if (!$user) {
        $error = "Your Email address is not valid";
      } else {
        $token = Library::generateToken(12);

        $createToken = $this->UserObj->update(
          ["password_reset" => $token, "userID" => $user['userID']],
          ['userID']
        );
        if ($createToken) {
          $mail = new SendEmail();
          $message = "<h2>Dear " . $user['username'] . ",</h3>";
          $message .= "<br>We receipt a password reset request from an account bearing this email. To proceed, kindly visit the link provided below. <br>With regards :) <br><br>";
          $message .= 'Reset Link: <a href="https://resumemaker.letech-cg.com/account/change-password?reff=send-xp&reset=' . $token . '&token=true" class="mail_btn">Reset my password</a><br>';
          $message .= "Let us know if you face any difficulties";
          $message .= "<p style='text-align:center;'><small>Resume Maker &copy; 2023 - letech-cg.com</span></p>";
          $mail->setEmail(
            $data['reset_email'],
            "HND Resumes: Request to reset account password",
            $message
          );

          $mail->send();

          $this->session->setToast("toast", 'Verified ✔. Am email has been sent to your email address');
          $res->redirect("/account/reset-password?verified=true");
        } else {
          $error = "Error creating reset request, Try again";
        }
      }
    }

    $res->render('reset-password', ['error' => $error]);
  }
  // Password Reset
  public function changePassword(Request $req, Response $res)
  {
    $token = $req->query('reset');
    $error = false;

    if (!$token) {
      $this->session->setToast("toast", 'Your password reset session, had expired. 🚩');
      $res->redirect("/account/login?reff=expired-sess");
    }

    $user = $this->UserObj->findOne(['password_reset' => $token]);

    if (!$user) {
      $this->session->setToast("toast", 'Your password reset session, had expired. 🚩');
      $res->redirect("/account/login?reff=expired-sess");
    }

    if ($req->isPost()) {
      $data = $req->body();
      $password = $data['password'];
      $con_password = $data['confirm_password'];

      if ($password !== $con_password) {
        $error = "Passwords don't match.. 🚩";
        return $res->render('change-password', ['error' => $error]);
      }
      $new = [];
      $new['password'] = $this->UserObj->hashString($password);
      $new['userID'] = $user['userID'];

      $update = $this->UserObj->update($new, ['userID']);

      echo "here";
      if ($update) {
        $update = $this->UserObj->update(["password_reset" => 'DONE', 'userID' => $user['userID']], ['userID']);

        if ($update) {
          $mail = new SendEmail();
          $message = "<h2>Dear " . $user['username'] . ",</h3>";
          $message .= "<br>Your password was successfully changed on " . date("d/m/y") . " We hope this was initiated by you. <br>With regards :) <br><br>";
          $message .= "<br>Let us know if you face any difficulties";
          $message .= "<p style='text-align:center;'><small>Resume Maker &copy; 2023 - letech-cg.com</span></p>";
          $mail->setEmail(
            $data['reset_email'],
            "HND Resumes: Request to reset account password",
            $message
          );

          $mail->send();

          $this->session->setToast("toast", 'Password change successfully ✔');
          $this->setUser($user);
          $res->redirect("/app/");
        } else {
          $error = "Something went wrong...";
        }
      }
    }

    $res->render('change-password', ['error' => $error]);
  }
  // Logout
  public function logout(Request $req, Response $res)
  {
    // Clearing user data
    $this->session->clear('user');
    // Setting Toast
    $this->session->setToast("toast", 'You have been logged out: ✔');
    $res->redirect('/');
  }

  private function setUser(array $data)
  {
    $user_data = array(
      'name' => $data['username'],
      'userID' => $data['userID'],
      'email' => $data['email'],
      'role' => $data['role'] ?? "USER",
      'profile' => $data['profile'] ?? '',
      '_sess_token' => $data['_sess_token'],
    );
    $this->session->set('user', $user_data);
  }

  public function profile(Request $req, Response $res)
  {
    (new AuthMiddleware())->isUser();

    Router::setLayout('layouts/dashboard');
    $user = $this->session->get('user');
    $user_id = $user['userID'];
    $user_email = $user['email'];
    $username = $user['name'];

    if ($req->isPost()) {
      $data = $req->body();
      $data['userID'] = $user_id;
      $data['email'] = $user_email;

      if (isset($_FILES['profile'])) {
        $image = $_FILES['profile'];

        $file_options = [
          "path" => "/uploads/profiles/",
          "filename" => "IMG-" . strtoupper(str_replace(" ", "-", $username)) . "-" . $user_id,
          "accept" => ['.jpg', '.png', '.jpeg'],
        ];

        $FileHandler = new FileUpload();

        $data['profile'] = $FileHandler->setup($file_options, $image);

        $FileHandler->upload();

        if ($FileHandler->errors()) {
          $this->session->setToast('toast', "Ooops error uploading image 🚩");
        } else {
          $_SESSION['user']['profile'] = $data['profile'];
          $update = $this->UserObj->update($data, ["userID", "email"]);
          $this->session->setToast('toast', "Profile Photo changed successfully 🐱‍🏍");
        }
      } elseif (isset($data['update_profile'])) {
        $update = $this->UserObj->update($data, ["userID", "email"]);

        $this->session->setToast('toast', "Profile updated successfully 🐱‍🏍");
      } elseif (isset($data['change_password'])) {

        $user =  $this->UserObj->findOne(["userID" => $user_id, "email" => $user_email], ['password']);

        if ($user && $this->UserObj->verifyHashed($data["old_password"], $user['password'])) {
          $status = ['errors' => []];
          if ($data["password"] === $data["confirm_password"]) {
            $passEncypt = $this->UserObj->hashString($data["password"]);

            $form_data = ['password' => $passEncypt, "userID", $user_id, "email" => $user_email];
            $this->UserObj->update($form_data, ["userID", "email"]);

            $this->session->setToast('toast', 'Password Changed Successfully. 😎');
          } else {
            $status['errors'][] = 'New passwords do not match!';
          }
        } else {
          $status['errors'][] = 'Incorrect password. Please try again!';
        }
        $res->render("_dashboard/profile", $status);
      }
    }

    $user_info = $this->UserObj->findOne(["email" => $user_email, "userID" => $user_id]);

    $user_info['profile'] = $user_info['profile'] ? "/uploads/profiles/" . $user_info['profile'] : "/static/media/user.png";
    // Rendering profile view
    $res->render("_dashboard/profile", $user_info);
  }
}
