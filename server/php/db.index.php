<?php

require_once('sift/sift.db.php');

use Sift\SiftDB;
$siftDB = new SiftDB();

$pdo = $siftDB->connect();

if ($pdo == null) {
  echo 'Could not connect to the SQLite database';
  exit();  
} else {
  echo "DB Connected.";
}

$tables = $siftDB->getTableList();

print_r($tables);

// insert a new image
// $imageId = $siftDB->insertImage('filename.png', 'desc', 'tags');