<?php
#bu sayfa sürekli çağırlacak
#gelen kutusundaki son mesajları db ye kaydedip gelen kutusundan mesajları siler
header("Access-Control-Allow-Origin: *");
// header("Content-type: application/json; charset=utf-8");
include 'config.php';
include 'mongo.php';

$json = $ig->direct->getInbox();
$inbox = json_decode($json);
$threads = $inbox->inbox->threads;
$response = array();
$response['threads_count'] = count($threads);
foreach ($threads as $key => $value) :
  $mid = $value->thread_id;

  //Kişilerden gelen mesajlar /SOHBETLER
  $json = $ig->direct->getThread($mid);
  $inbox = json_decode($json, true);
  $mesaj = $inbox['thread']['last_permanent_item'];
  $mesaj['message_id'] = $mid;
  $mesaj['status'] = 0;
  $recipients =
    [
      'users' => [$mesaj['user_id']] // must be an [array] of valid UserPK IDs | 1596158719=ertegunfidan
    ];
  // var_dump($mesaj);
  // exit;
  #sohbetteki son mesajları sisteme kaydediyorum
  try {

    $inserted_count = 0;
    echo $item_type = $mesaj['item_type'];
    if ($item_type == 'profile') {
      $profile_id = $mesaj['profile']['pk'];
      $result = $ig->people->follow($profile_id);
      $sendMsg = $ig->direct->sendText($recipients, 'Takip isteği gönderildi');
      continue;
    }

    if ($item_type == 'placeholder') {
      $text = $mesaj['placeholder']['message'];
      if (strpos($text, 'has a private account')) {
        //Takip edilmeyen sayfa,takip edeceğiz
        $temp_str = explode("@", $text, 2)[1];
        $user_name = explode(" ", $temp_str, 2)[0]; //Takip edilecek sayfanın adı
        $userId = $ig->people->getUserIdForName($user_name); //takip edilecek sayfanın id si
        // $ig->people->follow($userId); 
        //id ile sayfayı takip ediyoruz.
        $msg = "B001. Ne yazık ki @$user_name sayfasını takip etmediğim için videoyu şuan çeviremiyorum."
          . "Ama merak etme @$user_name sayfasına takip isteği gönderdim.Daha sonra tekrar dene";
        $ig->direct->sendText($recipients, $msg);
        // $ig->direct->hideThread($mid); //Tüm konuşmayı siler
      }

      if (strpos($text, 'This post is unavailable because it was deleted')) {
        #siliniş mesaj.işlem yapılmayacak
      }

      continue;
    }

    if ($item_type == 'text') {
      #text mesaj bir işlem yapılmayacak
      continue;
    }
    if ($mesaj['user_id'] != $my_user_id) { //son mesaj benim değilse sisteme ekle
      $insertOneResult = $collection_MesajKutusu->insertOne($mesaj);
      // $inserted_id = $insertOneResult->getInsertedId();
      $inserted_count = $insertOneResult->getInsertedCount();
    }

    if ($inserted_count) {
      $response['thread_' . $key] = $mid;
      # code... delete mesaj
      echo $json = $ig->direct->hideThread($mid); //Tüm konuşmayı siler
    }
  } catch (\Throwable $th) {
    die($th);
  }

endforeach;
