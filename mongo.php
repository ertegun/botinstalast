<?php
require 'vendor/autoload.php';
try {
  // Mongo Sunucusuna bağlanalım
  // $mongo = new MongoDB\Client("mongodb://localhost:27017");
  $mongo = new MongoDB\Client("mongodb://192.168.20.129:32768");
  $db = $mongo->instabot;
  $collection_MesajKutusu = $db->MesajKutusu;
} catch (\Throwable $e) {
  die('Baglanti Kurulamadi : ' . $e->getMessage());
}


/*
try {
  // $insertOneResult = $collection->insertOne(['message_id' => '0PkQctVaCN']);
} catch (\Throwable $th) {
  die($th);
}
*/


/*
try {
  $document = $collection->find();
  foreach ($document as $row) {
    var_dump($row);
  }
} catch (\Throwable $th) {
  throw $th;
}
*/


/*
class MyMongo
{
  function __construct()
  {
  }
}
*/
