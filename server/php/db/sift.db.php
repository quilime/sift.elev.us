<?php

namespace Sift {

require_once('sift.config.php');

class SiftDB {
    
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


    // public function insertImage($projectName) {
    //     $sql = 'INSERT INTO projects(project_name) VALUES(:project_name)';
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindValue(':project_name', $projectName);
    //     $stmt->execute();

    //     return $this->pdo->lastInsertId();
    // }


    public function insertImage($filename, $desc, $tags) {
        $sql = 'INSERT INTO images(filename, desc, tags, uploadedat) '
             . 'VALUES(:filename, :desc, :tags, VALUES(CURRENT_TIMESTAMP))';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':filename' => $filename,
            ':desc' => $desc,
            ':tags' => $tags
        ]);
        return $this->pdo->lastInsertId();
    }    


    public function insertTask($taskName, $startDate, $completedDate, $completed, $projectId) {
        $sql = 'INSERT INTO tasks(task_name,start_date,completed_date,completed,project_id) '
                . 'VALUES(:task_name,:start_date,:completed_date,:completed,:project_id)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':task_name' => $taskName,
            ':start_date' => $startDate,
            ':completed_date' => $completedDate,
            ':completed' => $completed,
            ':project_id' => $projectId,
        ]);

        return $this->pdo->lastInsertId();
    }  


}

}