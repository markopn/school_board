<?php

include_once "class/student.php";
$student = new Student();

if(isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $grade = $_POST['grade'];

    $minGrade = min($grade);
    $maxGrade = max($grade);

    $countGrades = count($grade);
    $sum = 0;

    //regular expression for name
    $regName = "/^[A-Z][a-z]{2,30}$/";

    if(!preg_match($regName, $name)){
		$_SESSION['error'] = "Check name or grade";
	}
    if(!array_filter($grade)) {
        $_SESSION['error'] = "Check name or grade";
    }
    foreach($grade as $g)
	{
	 if($g < 6 || $g > 10)
	 {
        $_SESSION['error'] = "Check name or grade";
	 }
	}

if(!isset($_SESSION['error'])){

    foreach($grade as $g)
        {
            $sum += $g;
        }
    $average = ($sum / $countGrades);
    if($average >= 7)
		{
			$id_board = 1;
		}
        elseif ($countGrades > 2 && $maxGrade > 8 ) {
            $arr = array_diff($grade, array($minGrade));
            $id_board = 2;
        }
        else {
            $id_board = 3;
        }
    $student = new Student();

    $student->createStudent($name,$grade,$average,$id_board);

    } else {}


}



 ?>
