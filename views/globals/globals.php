<?php
function createCSSLink($stylesheet)
{
  if (is_array($stylesheet)) {
    $links = '';

    for ($i = 0; $i < count($stylesheet); $i++) {
      $sheet = $stylesheet[$i];
      $links  .= '<link rel="stylesheet" href="/static/styles/' . $sheet . '.css">';
    }

    return $links;
  }

  $link  = '<link rel="stylesheet" href="/static/styles/' . $stylesheet . '.css">';
  return $link;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <meta name="description" content="HND CV Maker, Create amazing CV's downloadable in PDF with our awesome resume maker" />

  <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700&display=swap" rel="stylesheet"> -->
  <!-- <script src="https://kit.fontawesome.com/8ea543231b.js" crossorigin="anonymous"></script> -->

  <link rel="stylesheet" href="/00FA/css/all.css" />

  <link rel="icon" href="/favicon.ico" />

  <?php
  echo createCSSLink(["index", "global", "module-custom-select", "toast", "module-custom-tables"]);
  ?>