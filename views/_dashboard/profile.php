 <?php
  include_once __DIR__ . "/../globals/globals.php"
  ?>
 </head>

 <body>
   <div id="root">

     <div class="dashboard-main">
       <header class="mt-2">
         <div class="container-x flex between">
           <a href="
        <?= isset($_GET['password']) ? '/user/profile' : '/dashboard/'; ?>
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
         <?php if (isset($errors) && !empty($errors)) { ?>
         <div class="form-errors">
           <p class="mt-2 mb-2"><?= $errors[0] ?></p>
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
                     <input type="file" name="profile" id="profile_photo" accept="image/*">
                     <div class="image-holder">
                       <div class="image">
                         <img src="<?= $profile ?>" alt="Profile picture" class="img-cover profile_cover">
                         <label for="profile_photo" class="edit-btn flex">
                           <i class="fas fa-camera"></i>
                         </label>
                       </div>
                     </div>
                     <button class="save-profile-btn btn btn-s mt-2 w-full" name="change_profile">save</button>
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
                 <!-- <input type="hidden" name="user_id" id="user_id" value="<?= $id ?>" /> -->
               </div>
               <div class="body">
                 <div class="input-group">
                   <label for="username">Username</label>
                   <div class="input disabled"><?= $username ?></div>
                 </div>
                 <div class="input-group">
                   <label for="email">Email Address</label>
                   <div class="input disabled"><?= $email ?></div>
                 </div>
                 <div class="input-group">
                   <label for="tel">Mobile number</label>
                   <input type="text" name="phone" id="phone" placeholder="Mobile number..." required
                     value="<?= $phone ?>" />
                 </div>
                 <div class="input-group">
                   <label for="address">Your address</label>
                   <textarea name="address" id="address" placeholder="About this appointment" required
                     style="height: 100px;"><?= $address ?></textarea>
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
                   <input type="password" name="old_password" id="old_password" placeholder="Enter old password..."
                     required />
                 </div>

                 <div class="input-group">
                   <label for="password">New Password</label>
                   <input type="password" name="password" id="password" placeholder="Enter New password..." required />
                 </div>

                 <div class="input-group">
                   <label for="confirm_password">Confirm new Password</label>
                   <input type="password" name="confirm_password" id="confirm_password"
                     placeholder="Enter old password..." required />
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
     <?php include_once __DIR__ . "/../globals/dash-footer.php"; ?>

   </div>
 </body>

 </html>