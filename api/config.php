<?php

set_time_limit(0);
date_default_timezone_set('UTC');

$username = 'badiekremix';
$password = 'Acer123ert';
$my_user_id = '3418730320';
$debug = false;
$truncatedDebug = false;
$serverUrl = 'http://' . $_SERVER['HTTP_HOST'];

require __DIR__ . '/vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
// \InstagramAPI\Utils::$ffprobeBin = 'D:/GitHub/instabot/ffmpeg/bin/ffprobe.exe';
// \InstagramAPI\Media\Video\FFmpeg::$defaultBinary = 'D:/GitHub/instabot/ffmpeg/bin/ffmpeg.exe';


$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);

try {
  $ig->login($username, $password);
} catch (\Throwable $th) {
  //throw $th;
  echo $th->getMessage();
}

/*
$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);

try {
  $loginResponse = $ig->login($username, $password);
  var_dump($loginResponse);
  if ($loginResponse !== null && $loginResponse->isTwoFactorRequired()) {
    $twoFactorIdentifier = $loginResponse->getTwoFactorInfo()->getTwoFactorIdentifier();

    // The "STDIN" lets you paste the code via terminal for testing.
    // You should replace this line with the logic you want.
    // The verification code will be sent by Instagram via SMS.
    $verificationCode = trim(fgets(STDIN));
    $ig->finishTwoFactorLogin($username, $password, $twoFactorIdentifier, $verificationCode);
  }
} catch (\Exception $e) {
  echo 'Something went wrong: ' . $e->getMessage() . "\n";
}
*/
