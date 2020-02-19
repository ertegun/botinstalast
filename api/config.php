<?php 
$username = 'badiekremix';
$password = '1q2w3e';
$my_user_id = '3418730320';
$debug = false;
$truncatedDebug = false;

require __DIR__ . '/vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
\InstagramAPI\Utils::$ffprobeBin = 'D:/GitHub/instabot/ffmpeg/bin/ffprobe.exe';
\InstagramAPI\Media\Video\FFmpeg::$defaultBinary = 'D:/GitHub/instabot/ffmpeg/bin/ffmpeg.exe';

$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);

try {
  $ig->login($username, $password);
} catch (\Throwable $th) {
  //throw $th;
  echo $th->getMessage();
}

?>