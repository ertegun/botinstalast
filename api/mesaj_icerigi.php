<?php 
// header("Content-type: application/json; charset=utf-8");

include 'config.php';
include 'mongo.php';

extract($_REQUEST);

$json = $ig->direct->getThread($mid);
$inbox = json_decode($json,true);
$mesaj=$inbox['thread']['last_permanent_item'];
$mesaj['message_id']=$mid;
$mesaj['status']=0;

var_dump($mesaj);

try {
  $insertOneResult = $collection_MesajKutusu->insertOne($mesaj);
} catch (\Throwable $th) {
  die($th);
}
