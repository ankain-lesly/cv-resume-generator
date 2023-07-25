 <main>

<?php
  if(file_exists("forms/$form.form.php"))
    include_once "forms/$form.form.php";
  else echo '<h4 class="clr-success">Form Not Found</h4>';
?>

</main>