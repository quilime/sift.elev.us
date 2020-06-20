<?php

require_once('db.php');
require_once('insert.php');

use Sift\SQLiteConnection;
use Sift\SQLiteInsert;

$cx = new SQLiteConnection();

$pdo = $cx->connect();

if ($pdo == null) {
  echo 'Could not connect to the SQLite database';
  exit();  
}


$dbInsert = new SQLiteInsert($pdo);

// insert a new image
$imageId = $dbInsert->insertImage('filename.png', 'desc', 'tags');