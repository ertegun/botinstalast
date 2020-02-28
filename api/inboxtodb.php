<?php
#bu sayfa sürekli çağırlacak
#gelen kutusundaki son mesajları db ye kaydedip gelen kutusundan mesajları siler
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include 'config.php';
include 'mongo.php';

$json = $ig->direct->getInbox();
$inbox = json_decode($json);
$threads = $inbox->inbox->threads;

foreach ($threads as $key => $value) :
  $mid = $value->thread_id;
  //Kişilerden gelen mesajlar /SOHBETLER
?>
  <!-- <a href="mesaj_icerigi.php?mid=<?= $mid; ?>">mesaj</a><br> -->
<?php

  $json = $ig->direct->getThread($mid);
  $inbox = json_decode($json, true);
  $mesaj = $inbox['thread']['last_permanent_item'];
  $mesaj['message_id'] = $mid;
  $mesaj['status'] = 0;

  #sohbetteki son mesajları sisteme kaydediyorum
  try {
    $insertOneResult = $collection_MesajKutusu->insertOne($mesaj);
    // $inserted_id = $insertOneResult->getInsertedId();
    $inserted_count = $insertOneResult->getInsertedCount();

    if ($inserted_count) {
      # code... delete mesaj
      echo $json = $ig->direct->hideThread($mid); //Tüm konuşmayı siler
    }
  } catch (\Throwable $th) {
    die($th);
  }

endforeach;

?>