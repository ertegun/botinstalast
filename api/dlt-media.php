<?php
// header("Content-type: application/json; charset=utf-8");

error_reporting(E_ALL);
ini_set('display_errorw', 1);
set_time_limit(0);

$username = 'qralbot';
$password = '1q2w3e';
$my_user_id = '3418730320';
$debug = false;
$truncatedDebug = false;

require __DIR__ . '/vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);

try {
  $ig->login($username, $password);
} catch (\Throwable $th) {
  //throw $th;
  echo $th->getMessage();
}

// $ig->media->delete('2090871256890413164', 'PHOTO');
$json = $ig->timeline->getSelfUserFeed();
$data = json_decode($json);
echo $ig->media->delete($data->items[0]->pk, 'PHOTO');
exit;
