<?php

include_once "class/Student.php";


if(isset($_GET['id'])){

			$id = $_GET['id'];

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>School board test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">SCHOOL BOARD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<div class="container mt-4">
  <div class="row">
    <div class="col-lg-12">
    <?php
    $student = new Student();
    $rows = $student->selectID($id);
     if($rows['board_name'] == 'CSM')
  	 {
  	echo json_encode($rows);
     }
  	 elseif($rows['board_name'] == 'CSMB')
  	 {

        $xml = new DOMDocument("1.0");
        $students = $xml->createElement("student");
        $xml->appendChild($students);

        $student=$xml->createElement('student');
        $students->appendChild($student);

        $name=$xml->createElement('name',$rows['name']);
        $student->appendChild($name);

        $average=$xml->createElement('average',$rows['average']);
        $student->appendChild($average);

        echo "<xmp>".$xml->saveXML()."/<xmp>";
        $xml->save("student.xml");

    }else{
    echo "Name: ".$rows['name'];
    echo "</br>";
    echo "Average: ".$rows['average'];
    }
	?>
    </div>
   </div>
</div>


  </body>
</html>
