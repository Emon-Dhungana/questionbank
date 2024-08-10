<?php 
    $db_connect=mysqli_connect("localhost","root","","question");
    if(isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];
        $delete_query="delete from qdemo where id=$id";
        $delete=mysqli_query($db_connect,$delete_query);
        if($delete){
            echo "Deleted $id successfully";
                header('location:qretrieve.php');
        }else{
            die(mysqli_error($db_connect));
        }
    }
?>