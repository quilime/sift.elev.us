<?php

namespace Sift {

require_once('Config.php');

class SQLiteConnection {
    
    private $pdo;
    
    public function connect() {
      try {
        if ($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
        }
        return $this->pdo;         
      } catch (\PDOException $e) {
         // handle the exception here
      }      
    }

    // get table list
    public function getTableList() {
      $stmt = $this->pdo->query("SELECT name
                                 FROM sqlite_master
                                 WHERE type = 'table'
                                 ORDER BY name");
      $tables = [];
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $tables[] = $row['name'];
      }
      return $tables;
  }

}

}