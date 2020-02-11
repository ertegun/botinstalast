<?php
header("Content-type: application/json; charset=utf-8");
include '../mongo.php';
extract($_REQUEST);
$document = $collection_MesajKutusu->findOne(['item_id' => '29162993218054333028679218030968832']);
// var_dump($document);
// $url = $document->media_share->image_versions2->candidates[0]->url;
// $media_type = $document->media_share->media_type;
echo json_encode($document);

?>