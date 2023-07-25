<?php
  // if(!isset($_GET['view']))
  $view = $_GET['view'] ?? header("Location: /dashboard");

?>

<main>

<!-- Page View Start -->
<?php
  if(file_exists("tables/$view.table.php"))
    include_once "tables/$view.table.php";
  else echo '<h4 class="clr-success">Table Not Found</h4>';
?>
<!-- Page View Ends -->
</main>