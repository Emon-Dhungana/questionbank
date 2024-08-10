<?php
$username = "root";
$password = "";
$database = "question";
$mysqli = new mysqli("localhost", $username, $password, $database);
$semester=$_POST['semester'];
$chapter=$_POST['chapter'];
$difficulty=$_POST['difficulty'];

$query = "SELECT * FROM qdemo where semester='$semester' AND chapter='$chapter' AND difficulty='$difficulty'";;
echo "<b> <center>Database Output</center> </b> <br> <br>";

if ($result = $mysqli->query($query)) {
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CDN link of bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="col-auto">
    <button type="button" class="btn btn-primary mx-3"><a href="form.html" class="text-light">Add User</a></button>
    </div>
    <!-- code copied from bootstrap -->
        <table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Question</th>
      
        </tr>
    </thead>
    <tbody>
        <!-- to collect data from DB -->
        <?php 
            $table_data=mysqli_query($mysqli,"select * from qdemo");
            while ($row = $result->fetch_assoc()) {
                # code...
                $id=$row["id"];
                $question=$row["question"];
               
                echo '<tr>
                <td>'.$id.'</td>
                <td>'.$question.'</td>
              
                <td>
                <button type="button" class="btn btn-success">
                <a href="update.php?updateid='.$id.'" class="text-light">Update</a>
                </button>
                <button type="button" class="btn btn-danger">
                <a href="qdelete.php?deleteid='.$id.'" class="text-light">Delete</a>
                </button>
                </td>
                </tr>
                ';
            }
        ?>
    </tbody>
</table>
</body>
</html>
  <?php
       
$result->free();
}
?>