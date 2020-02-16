<?php
header("Content-type: application/json; charset=utf-8");
include '../mongo.php';
// extract($_REQUEST);
// $entityBody = file_get_contents('php://input');
$data = json_decode(file_get_contents('php://input'), true);
echo ($data);
exit;

$mid=$_REQUEST['mid'];
$document = $collection_MesajKutusu->findOne(['item_id' => $mid]);

// $document = $collection_MesajKutusu->findOneAndUpdate(
//   [ 'item_id' => $document->item_id],
//   [ '$set' => [ 'status' => 1 ]]
// );
// var_dump($document);
// $url = $document->media_share->image_versions2->candidates[0]->url;
// $media_type = $document->media_share->media_type;
echo json_encode($document);//29162993218054333028679218030968832
// echo json_encode($_REQUEST);
?>