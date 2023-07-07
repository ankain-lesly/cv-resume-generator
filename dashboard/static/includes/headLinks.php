<?php
include_once __DIR__ . "/../../../static/globals/globals.php";

if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
  unset($_SESSION['user']);
}
if (!isset($_SESSION['user']['username'])) {
  header('Location: /register.php?v=login');
  // echo "<script>window.location = '/register.php?v=login'</script>";
  exit;
}

echo createCSSLink('main');
?>
<title>Dashboard - Supercarsauto</title>