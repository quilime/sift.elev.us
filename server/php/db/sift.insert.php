<?php

// CREATE TABLE images (
//     id INTEGER PRIMARY KEY,
//     filename TEXT,
//     desc TEXT,
//     tags TEXT,
//     uploadedat TEXT
// );

namespace Sift;

class SQLiteInsert {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
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