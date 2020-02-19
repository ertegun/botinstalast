<?php
// header("Content-type: application/json; charset=utf-8");

error_reporting(E_ALL);
ini_set('display_errorw', 1);
set_time_limit(0);

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
// $captionText = 'API ile Yükledim';

// echo $ig->account->getCurrentUser();//profil bilgilerim
// exit;
// echo $ig->account->setBiography('Bu API ile düzenlendi');//Biyografi düzeneme
// $photo='istanbul.jpg';
// $metadata=['caption'=>'API ile yükledim'];
// echo $ig->timeline->uploadPhoto($photo,$metadata);
// echo $userId=$ig->people->getUserIdForName('ertegunfidan');
//  echo $json=$ig->timeline->getUserFeed($userId);
// echo json_encode($json,true);
// exit;
// $video='cez.mp4';
// $metadata=['caption'=>'API ile yükledim'];
// \InstagramAPI\Utils::$ffmpegBin = 'C:/FFmpeg/bin/ffprobe.exe';
//  \InstagramAPI\Utils::$ffprobeBin = 'C:/FFmpeg/bin/ffmpeg.exe';

// $video=new \InstagramAPI\Media\Video\InstagramVideo($video);
// echo $ig->timeline->uploadVideo($video->getFile(),$metadata);

// include_once("classes/instagram-photo-video-upload-api.class.php");
// Upload Video
// $obj = new InstagramUpload();
// $obj->Login("qralbot", "1q2w3e");
// $obj->UploadVideo("cez.mp4", "square-thumb.jpg", "Test Upload Video From PHP");
$json = $ig->direct->getInbox();
// echo $json;
// exit;
$inbox = json_decode($json);
$threads = $inbox->inbox->threads;

foreach ($threads as $key => $value) {
  $thread_ids[] = $value->thread_id; //Kişilerden gelen mesajlar
}
var_dump($thread_ids);

$json = $ig->direct->getThread('340282366841710300949128352309656283355');
var_dump($json);
exit;
foreach ($thread_ids as $key => $value) {
  $json = $ig->direct->getThread($value);
  $data = json_decode($json);
  $silinecek_mesaj_thread_id = '';
  $tum_mesajlar_silinebilir = true;
  $items = $data->thread->items;

  $last_permanent_item = $data->thread->last_permanent_item; //şimdilik son gönderilen mesajı okuyup onu yükleyeceğim
  // echo json_encode($thread_ids);
  // exit;
  $item_id = $last_permanent_item->item_id;
  $user_id = $last_permanent_item->user_id;

  switch ($last_permanent_item->item_type) {
    case 'media_share':
      if (isset($last_permanent_item->media_share->video_versions)) {
        #Gelen mesajın video olduğunu anlıyorum
        $url  = $last_permanent_item->media_share->video_versions[0]->url;
        $path = $item_id . '.mp4';
        $media_type = 'video';
      } else if (isset($last_permanent_item->media_share->image_versions2)) {
        #Gelen mesaj video değilse image_versions2 dan resim olduğunu anlıyorum
        echo json_encode($last_permanent_item);
        $url  = $last_permanent_item->media_share->image_versions2->candidates[0]->url;
        $path = $item_id . '.jpg';
        $media_type = 'photo';
      }
      /*İNDİR */
      $fp = fopen($path, 'w');
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_FILE, $fp);
      $data = curl_exec($ch);
      curl_close($ch);
      fclose($fp);
      /*İNDİR */

      /*Timeline a Yükle */
      $captionText = 'API ile Yükledim';
      switch ($media_type) {
        case 'photo':
          $filename = $item_id . '.jpg';
          try {
            $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($filename);
            $json =  $ig->timeline->uploadPhoto($photo->getFile(), ['caption' => $captionText]);
          } catch (\Throwable $th) {
            throw $th;
          }
          $msg = "B002. Fotoğrafı paylaştım :)";
          break;
        case 'video':
          $filename = $item_id . '.mp4';
          try {
            $json = $ig->timeline->uploadVideo($filename, ['caption' => $captionText]);
          } catch (\Throwable $th) {
            throw $th;
          }
          $msg = "B003. Videoyu paylaştım :)";
          break;
        default:
          break;
      }
      /*Timeline a Yükle */
      $data = json_decode($json);
      $media_id = $data->media->id;
      /**Mesajı Cevapla */
      $recipients =
        [
          'users' => [$user_id] // must be an [array] of valid UserPK IDs | 1596158719=ertegunfidan
        ];
      $ig->direct->sendText($recipients, $msg);
      $ig->direct->sendPost($recipients, $media_id, ['media_type' => $media_type]);
      /**Mesajı Cevapla */
      break;
    case 'placeholder':
      $text = $last_permanent_item->placeholder->message;
      if (strpos($text, 'has a private account')) {
        //Takip edilmeyen sayfa,takip edeceğiz
        $temp_str = explode("@", $text, 2)[1];
        $user_name = explode(" ", $temp_str, 2)[0]; //Takip edilecek sayfanın adı
        $userId = $ig->people->getUserIdForName($user_name); //takip edilecek sayfanın id si
        $ig->people->follow($userId); //id ile sayfayı takip ediyoruz
        $tum_mesajlar_silinebilir = false;
        $silinecek_mesaj_thread_id = $thread_ids[$key];
        $recipients =
          [
            'users' => [$user_id] // must be an [array] of valid UserPK IDs | 1596158719=ertegunfidan
          ];
        $msg = "B001. Ne yazık ki @$user_name sayfasını takip etmediğim için videoyu çeviremiyorum." +
          "Ama merak etme @$user_name sayfasına takip isteği gönderdim.Daha sonra tekrar dene";
        $ig->direct->sendText($recipients, $msg);
      }
      if (strpos($text, 'This post is unavailable because it was deleted')) {
        #siliniş mesaj.işlem yapılmayacak
        break;
      }

      break;
    case 'profile':
      # Gelen mesaj profil ise TAKİP ET FONKSIYONU
      var_dump('TAKİP ET');
      break;
    default:
      # code...
      break;
  }
  if ($tum_mesajlar_silinebilir) {
    // $json = $ig->direct->hideThread($silinecek_mesaj_thread_id); //Tüm konuşmayı siler

  }
}
// echo json_encode($video_items);
// $msg = 'Bu benim test mesajım!';
// echo $ig->direct->sendText(['users' => ['1596158719']], $msg);
// var_dump($item_arr);
// echo $json = $ig->direct->hideThread('340282366841710300949128352309656283355');//Tüm konuşmayı siler

// var_dump(phpinfo());
// echo $ig->people->follow('user_id');
