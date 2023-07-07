<?php
  include_once __DIR__."/../connect/Config/CustomLibrary.php";

  if(!isset($_GET['view']))
    header("Location: /dashboard");

  $view = $_GET['view'];
  include_once "static/includes/headLinks.php"; 
?>
<link rel="stylesheet" href="../static/css/module-custom-tables.css">
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
              if(file_exists("static/tables/$view.table.php"))
                include_once "static/tables/$view.table.php";
              else echo '<h4 class="clr-success">Table Not Found</h4>';
            ?>
            <!-- Page View Ends -->
          </main>
        </section>
      </div>
    </div>
    <?php include_once "static/includes/footer.php"; ?>