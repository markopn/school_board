<?php

require_once "database.php";
class Student extends Database {

  public function select() {
    $sql = "SELECT * FROM students";
    $result = $this->connect()->query($sql);

    if($result->rowCount() > 0){
  while($row = $result->fetch()){
    $data[] = $row;
  }
  return $data;
    }
  }

  public function selectID($id) {
    $sql = "SELECT s.id as id_student,s.name,s.average,s.id_board,b.id,b.name as board_name FROM students s INNER JOIN boards b on s.id_board = b.id  where s.id = $id LIMIT 1";
    $result = $this->connect()->query($sql);

    if($result->rowCount() > 0){
    while($row = $result->fetch()){
    $data = $row;
  }
  return $data;
}
  }

  public function selectBoard($id) {
    $sql = "SELECT b.id,b.name as board_name, s.id,s.id_board FROM boards b INNER JOIN students s on b.id = s.id_board WHERE s.id = $id";
    $result = $this->connect()->query($sql);

    if($result->rowCount() > 0){
  while($row = $result->fetch()){
    $data[] = $row;
  }
  return $data;
    }
  }
  public function selectGrade($id) {
    $sql = "SELECT * FROM students s INNER JOIN grades g on s.id = g.id_student WHERE s.id = $id";
    $result = $this->connect()->query($sql);

    if($result->rowCount() > 0){
  while($row = $result->fetch()){
    $data[] = $row;
  }
  return $data;
    }
  }

  public function createStudent($name,$grade,$average,$id_board) {
    $stmt = $this->connect()->prepare("INSERT INTO students (name,average,id_board) VALUES (:name,:average,:id_board);");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':average', $average);
    $stmt->bindParam(':id_board', $id_board);
    $stmt->execute();
    
  foreach($grade as $gr){
    $stmt = $this->connect()->prepare("INSERT INTO grades (id_student,grade) VALUES (:id_student,:grade);");
    $id = $this->connect()->prepare("SELECT id from students ORDER BY id DESC LIMIT 1");
    $id->execute();
    $last_id = $id->fetchColumn();
    $stmt->bindParam(':id_student', $last_id);
    $stmt->bindParam(':grade', $gr);
    $stmt->execute(); 
  }

  }

}


 ?>
