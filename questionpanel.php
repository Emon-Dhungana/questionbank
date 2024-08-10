<?php
    $con = mysqli_connect('localhost', 'root', '', 'question');
    if(isset($_POST['semester']) && isset($_POST['chapter']) && isset($_POST['difficulty']) && isset($_POST['question'])) {
        $semester = $_POST['semester'];
        $subject=$_POST['subject'];
        $chapter = $_POST['chapter'];
        $difficulty = $_POST['difficulty'];
        $question = $_POST['question'];
        
        // Server-side validation
        if(empty($semester) ||empty($subject) || empty($chapter) || empty($difficulty) || empty($question)) {
            echo '<p style="color: red;">All fields are required.</p>';
        } else {
            $query = "INSERT INTO qdemo (semester, subject, chapter, difficulty, question) VALUES ('$semester','$subject', '$chapter', '$difficulty', '$question')";
            $run = mysqli_query($con, $query);
            if($run) {
                echo 'Question Added';
                
            } else {
                echo 'Error';
            }
        }
    }
     else {
        echo 'All fields are required.';
    }

?>
