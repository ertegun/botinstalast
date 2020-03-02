<?php
header("Access-Control-Allow-Origin: *");
// header("Content-type: application/json; charset=utf-8");
include 'config.php';
include 'mongo.php';
$document = $collection_MesajKutusu->findOne(['status' => 0]);
$sendMsg = '';

try {
  if ($document != null) {
    $recipients =
      [
        'users' => [$document->user_id] // must be an [array] of valid UserPK IDs | 1596158719=ertegunfidan
      ];
    $item_id = $document->item_id;
    var_dump($item_id, $document->user_id);
    $post_item_url = "$serverUrl/post/$item_id";
    if ($document->user_id != $my_user_id) {
      $sendMsg = $ig->direct->sendText($recipients, $post_item_url); //code...
    }
    // var_dump($sendMsg);

    $update = $collection_MesajKutusu->updateOne(
      ['item_id' => $document->item_id],
      ['$set' => ['status' => 1]]
    );
    // var_dump($update);
  }
} catch (\Throwable $th) {
  //throw $th;
}

echo 'sender OK';
exit;
