<?php
  include_once __DIR__."/../connect/Config/CustomLibrary.php";
  
  if(!isset($_GET['form']))
    header("Location: /dashboard");

  $form = $_GET['form'];
 
 include_once "static/includes/headLinks.php"; 
?>
</head>

<body>
  <div id="root">
    <div class="dashboard-main">
      <div class="container">
        <?php include_once "static/includes/sideNav.php"; ?>
        <section class="main-content">
          <?php include_once "static/includes/header.php"; ?>
          <main>

            <!-- Page View Start -->

            <?php
              if(file_exists("static/forms/$form.form.php"))
                include_once "static/forms/$form.form.php";
              else echo '<h4 class="clr-success">Form Not Found</h4>';
            ?>

            <!-- Page View Ends -->
          </main>
        </section>
      </div>
    </div>
    <?php include_once "static/includes/footer.php"; ?>