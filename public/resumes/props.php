<?php
// ICONS
class Icon
{
  public static function get(string $label)
  {
    $label = strtolower($label);

    $IconObject = array(
      "phone" => true,
      "email" => true,
      "date" => true,
      "address" => true,
      "facebook" => true,
      "instagram" => true,
      "telegram" => true,
      "twitter" => true,
      "linkedIn" => true,
      "tiktok" => true,
      "pinterest" => true,
      "youTube" => true,
      "reddit" => true,
      "whatsApp" => true,
      "website" => true,
      "others" => true,
      "default" => true,
    );

    $icon = array_key_exists($label, $IconObject) ? $label : "default";
    return self::loadIconImage($icon);
  }
  // Load Icon
  private static function loadIconImage($name)
  {
    $temp =  '<img src="/static/media/icons/{{NAME}}.png" width="30px" alt="Icon {{NAME}}">';
    return str_replace("{{NAME}}", $name, $temp);
  }
}
// Getting Resume Data
$cover = $resume['cover_photo'] ?? null;
$cover = $cover ? "/uploads/covers/" . $cover : "";

$personal = $resume['personal'] ?? [];
$extras = $resume['extras'] ?? [];
$education = $resume['education'] ?? [];
$experience = $resume['experience'] ?? [];
$social = $resume['social'] ?? [];
$language = $resume['language'] ?? [];
$skill = $resume['skill'] ?? [];
$hobby = $resume['hobby'] ?? [];
// Sanitize Data
function clean(string $value)
{
  $value = htmlspecialchars($value);
  $value = strip_tags($value);
  $value = trim($value);
  return $value;
}
// Get Object Value
function get(array $data, string $key)
{
  $value = $data[$key] ?? '';
  return  clean($value);
}

// Get Icon
function getIcon(string $name)
{
  return Icon::get($name);
}

// // // get Personal Data
// function getP($key)
// {
//   global $personal;
//   echo '<pre>';
//   print_r($personal);
//   echo '</br>';
//   echo '</pre>';
//   // exit();
//   $value = $personal[$key] ?? '';
//   return clean($value);
// }
// get Personal Data

// function getX(string $key)
// {
//   global $extras;
//   $value = $extras[$key] ?? '';
//   return clean($value);
// }

// Structure Body
function makeBody(string $string)
{
  $body = "";
  $items = explode("\n", $string);

  foreach ($items as $key => $value) {
    if (empty($value)) continue;
    if ($key === 0) $body .= '<p class="mb-x txt-justified">' . clean($value) . '</p>';
    else $body .= '<p class="p-list">' . clean($value) . '</p>';
  }
  return $body;
}
?>

<style>
  #template_main {
    /* outline: 5px solid orange; */
    /* margin: 5px auto !important; */
    /* min-height: 1450px; */
    /* padding-bottom: 40px; */
    border-radius: 1rem;
    overflow: hidden;
    font-family: 1.2rem;
    position: relative;
  }

  .on-icon img {
    width: 20px !important;
  }
</style>