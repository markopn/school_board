<?php function __autoload($class) {
  require_once "classes/$class.php";
}
include "create.php";
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
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<div class="container mt-4">
  <div class="row">
    <div class="col-lg-12">
    <?php if (isset($_SESSION['error']))  { ?>
      <div class="alert alert-danger" role="alert">
   <?php echo $_SESSION['error'] ;?>
  </div>
    <?php }?>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Grades</th>
            <th scope="col">Average</th>
            <th scope="col">Board</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
              $student = new Student();
              $rows = $student->select();

              foreach ($rows as $row) {
             ?>
            <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><a href="select.php?id=<?php echo $row['id'] ?>"><?php echo $row['name']; ?></a></td>
            <td>
            <?php
              $grades = new Student();
              $grade = $grades->selectGrade($row['id']);

              foreach ($grade as $g) {
             ?>
              <?php echo $g['grade']; ?>

             <?php } ?>
            </td>
            <td><?php echo $row['average']; ?></td>
            <td>
            <?php
           
              $boards = new Student();
              $board = $boards->selectBoard($row['id']);
           
              foreach ($board as $b) {
              
             ?>
              <?php echo $b['board_name']; ?>

             <?php } ?>
            </td>
            <td><?php if($row['id_board'] == 3 ) echo "Fail"; else echo "Pass";?></td>
            </tr>
            <? } ?>
        </tbody>
        </table>
    </div>
   </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="jumbotron">
        <h4 class="mb-4">Add students</h4>
        <form method="post" action="index.php">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name">
          </div>
          <div class="form-group">
          <label for="name">Grades:</label>
            <div class="row">
                <div class="col">
                <input type="text" class="form-control" name="grade[]" placeholder="Enter first grade">
                </div>
                <div class="col">
                <input type="text" class="form-control" name="grade[]" placeholder="Enter second grade">
                </div>
                <div class="col">
                <input type="text" class="form-control" name="grade[]" placeholder="Enter third grade">
                </div>
                <div class="col">
                <input type="text" class="form-control" name="grade[]" placeholder="Enter fourth grade">
                </div>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

  </body>
</html>
