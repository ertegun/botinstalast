<?php
include './config.php';
include './mongo.php';

$json = $ig->direct->getInbox();
$inbox = json_decode($json);
$threads = $inbox->inbox->threads;

foreach ($threads as $key => $value) :
  $mid = $value->thread_id;
  //Kişilerden gelen mesajlar /SOHBETLER
?>
  <a href="mesaj_icerigi.php?mid=<?= $mid; ?>">mesaj</a><br>
<?php

  $json = $ig->direct->getThread($mid);
  $inbox = json_decode($json, true);
  $mesaj = $inbox['thread']['last_permanent_item'];
  $mesaj['message_id'] = $mid;
  $mesaj['status'] = 0;

  // var_dump($mesaj);
  // exit;
  #sohbetteki son mesajları sisteme kaydediyorum
  try {
    $insertOneResult = $collection_MesajKutusu->insertOne($mesaj);
    $inserted_id = $insertOneResult->getInsertedId();
    $inserted_count = $insertOneResult->getInsertedCount();

    if ($inserted_count) {
      # code... delete mesaj
      echo $json = $ig->direct->hideThread($mid); //Tüm konuşmayı siler
      #sohbetteki son mesajı kayıt ettikten sonra sahbet bilgilerini kaydediyorum
    }
  } catch (\Throwable $th) {
    die($th);
  }

endforeach;

?>