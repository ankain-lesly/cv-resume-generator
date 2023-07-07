 <?php

  use App\Config\CustomLibrary;
  use App\Controllers\UserController;
  use App\Models\DataAccess;

  include_once __DIR__ . '/../connect/Controllers/UserController.php';

  include_once "static/includes/headLinks.php";
  $DataAccess = new DataAccess();

  $admin = $_SESSION['user']['role'];
  $admin_token = $_SESSION['user']['token'];

  $id = '';
  $username = '';
  $email = '';
  $phone = '';
  $address = '';

  $User = new UserController();
  // SUBMIT DATA
  if (isset($_POST['update_profile'])) {
    $update = $User->updateProfile();

    if (isset($update['errors'])) {
      $id = $update['data']['user_id'];
      $username = $update['data']['username'];
      $email = $update['data']['email'];
      $phone = $update['data']['phone'];
      $address = $update['data']['address'];
    } else {
      CustomLibrary::setToast('Profile Updated Successfully. 😎', '/dashboard/profile.php?status=opdated');
    }
  }
  if (isset($_POST['change_password'])) {
    extract($_POST);
    $email = $_SESSION['user']['email'];
    $uuid = $_SESSION['user']['token'];

    $sql = "SELECT password FROM tblusers WHERE email = :email";
    $user =  $DataAccess->fetchCustomData($sql, [$email]);

    if (!$user) return false;

    if (password_verify($old_password, $user['password'])) {
      if ($password === $confirm_password) {
        $passEncypt = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE tblusers SET password = :password WHERE userID = :id";
        $res = $DataAccess->queryCustomData($sql, [$passEncypt, $uuid]);

        if ($res) {
          CustomLibrary::setToast('Password Changed Successfully. 😎', '/dashboard/profile.php?status=opdated');
        }
      } else {
        $update['errors'][] = 'New passwords do not match!';
      }
    } else {
      $update['errors'][] = 'Incorrect password. Please try again!';
    }
  } else {
    $user = $User->user($admin_token);
    if ($user) {
      $id = $user['id'];
      $username = $user['username'];
      $email = $user['email'];
      $phone = $user['phone'];
      $address = $user['address'];
    }
  }

  ?>

 </head>

 <body>
   <div id="root">

     <div class="dashboard-main">
       <header class="mt-2">
         <div class="container-x flex between">
           <a href="
          <?php
          if (isset($_GET['password'])) {
            echo '/dashboard/profile.php';
          } else {
            echo '/dashboard';
          }
          ?>
          " class="btn btn-s">Back</a>
           <h4>Edit Account</h4>
         </div>
       </header>
       <div class="form-container container-x">
         <nav class="">
           <h3 class="clr-success mb-1">My profile Details</h3>
         </nav>
         <!-- Product Image -->
         <div class="form-section">
           <div class="head flex between wrap">
             <h3><i class="fas fa-user"></i></h3>
             <a href="?password=true"><small class="btn btn-p">change password</small></a>
           </div>
         </div>
         <?php if (isset($update['errors'])) { ?>
           <div class="form-errors">
             <p class="mt-2 mb-2"><?= $update['errors'][0] ?></p>
           </div>
         <?php } ?>

         <?php if (!isset($_GET['password'])) { ?>
           <!-- Product Info -->
           <div class="flex gap-1 top start form-sections">

             <form method="post" enctype="multipart/form-data">
               <div class="form-section">
                 <div class="head">
                   <h3>Profile Picture</h3>
                 </div>
                 <div class="body">
                   <div class="input-group">
                     <div class="profile-image flex column">
                       <div class="image-holder">
                         <div class="image">
                           <img src="/static//media/user.png" alt="Profile picture" class="img-cover">
                           <label for="profile" class="edit-btn flex">
                             <i class="fas fa-camera"></i>
                           </label>
                         </div>
                       </div>
                       <input type="file" name="profile" id="profile" accept="image/*">
                       <button class="save-profile-btn btn btn-s">save</button>
                     </div>
                     <!-- CUSTOM SELECT -->
                   </div>
                 </div>
               </div>
             </form>

             <form method="post">
               <div class="form-section">
                 <div class="head">
                   <h3>Profile info</h3>
                   <input type="hidden" name="user_id" id="user_id" value="<?= $id ?>" />
                 </div>
                 <div class="body">
                   <div class="input-group">
                     <label for="username">Full Name</label>
                     <input type="text" name="username" id="username" placeholder="Full name" required value="<?= $username ?>" />
                   </div>
                   <div class="input-group">
                     <label for="email">Email Address</label>
                     <input type="text" name="email" class="disabled" id="email" placeholder="Email address.." required value="<?= $email ?>" />
                   </div>
                   <div class="input-group">
                     <label for="tel">Mobile number</label>
                     <input type="text" name="phone" id="phone" placeholder="Mobile number..." required value="<?= $phone ?>" />
                   </div>
                   <div class="input-group">
                     <label for="address">Your address infor..</label>
                     <textarea name="address" id="address" placeholder="About this appointment" required style="height: 100px;"><?= $address ?></textarea>
                   </div>
                 </div>
                 <div class="actions flex mt-2 end gap-2 pb-2 wrap mr-2">
                   <a href="/dashboard/" class="btn btn-s">Cancel</a>
                   <button class="btn btn-p" type="submit" name="update_profile">
                     <span class="mr-1"> Update Info </span>
                   </button>
                 </div>
               </div>
             </form>
           </div>
         <?php } else { ?>
           <div class="flex gap-1 top start form-sections">
             <div class="form-section">
               <div class="head">
                 <h3>Change Password</h3>
               </div>
               <div class="body">
                 <div class="input-group">
                   <div class="profile-image flex column">
                     <div class="image-holder txt-center">
                       <i class="fas fa-plus clr-warning"></i>
                       <br><br>
                       <h4>Setup your new<br>password</h4>
                     </div>
                   </div>
                   <!-- CUSTOM SELECT -->
                 </div>
               </div>
             </div>

             <form method="post">
               <div class="form-section">
                 <div class="head">
                   <h3>Data Create</h3>
                 </div>
                 <div class="body">
                   <div class="input-group">
                     <label for="old_password">Old Password</label>
                     <input type="text" name="old_password" id="old_password" placeholder="Enter old password..." required />
                   </div>

                   <div class="input-group">
                     <label for="password">New Password</label>
                     <input type="text" name="password" id="password" placeholder="Enter New password..." required />
                   </div>

                   <div class="input-group">
                     <label for="confirm_password">Confirm new Password</label>
                     <input type="text" name="confirm_password" id="confirm_password" placeholder="Enter old password..." required />
                   </div>

                   <div class="actions flex mt-2 end gap-2 pb-2 wrap mr-2">
                     <a href="/dashboard/" class="btn btn-s">Cancel</a>
                     <button class="btn btn-p" type="submit" name="change_password">
                       <span class="mr-1"> Update Info </span>
                     </button>
                   </div>
                 </div>
             </form>
           </div>
         <?php } ?>
       </div>
     </div>
     <?php include_once "static/includes/footer.php"; ?>