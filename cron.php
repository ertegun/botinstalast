<?php
include './config.php';
include './mongo.php';

$collection = (new MongoDB\Client)->test->zips;

$document = $collection_MesajKutusu->findOne(['status' => 0]);

var_dump($document->media_share->image_versions2->candidates[0]->url);

switch ($document->media_share->media_type) {
  case 1: #resim

    break;
  case 2: #video
    # code...
    break;
  case 3:
    # code...
    break;
  default:
    # code...
    break;
}
