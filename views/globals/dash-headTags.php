<?php
include_once "globals.php";

if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
  unset($_SESSION['user']);
}

if (!isset($_SESSION['user']['username'])) {
  header('Location: /register?v=login');
  // echo "<script>window.location = '/register?v=login'</script>";
  exit;
}

echo createCSSLink('main');
?>
<title>Dashboard | HND Resume</title>