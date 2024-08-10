<?php
$username = "root";
$password = "";
$database = "question";
$mysqli = new mysqli("localhost", $username, $password, $database);

// Check if the required GET parameters are set
if (isset($_GET['semester']) && isset($_GET['subject']) && isset($_GET['chapter']) && isset($_GET['difficulty'])) {
    $semester = $_GET['semester'];
    $subject = $_GET['subject'];
    $chapter = $_GET['chapter'];
    $difficulty = $_GET['difficulty'];

    $query = "SELECT * FROM qdemo WHERE 1=1";

    // Check if any parameter is set to 'all' and add conditions accordingly
    if ($semester !== 'all') {
        $query .= " AND semester='$semester'";
    }
    if ($subject !== 'all') {
        $query .= " AND subject ='$subject'";
    }
    if ($chapter !== 'all') {
        $query .= " AND chapter='$chapter'";
    }
    if ($difficulty !== 'all') {
        $query .= " AND difficulty='$difficulty'";
    }

    echo "<b><center>Stored Questions</center></b>";

    // Execute the query
    $result = $mysqli->query($query);

    if ($result) {
        // Check if there are any results
        if ($result->num_rows > 0) {
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
                    a {
                        text-decoration: none;
                    }
                </style>
            </head>
            <body>
            <!-- code copied from bootstrap -->
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" width="50px">S.N</th>
                    <th scope="col" width="800px">Question</th>
                    <th scope="col" width="250px">Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- to collect data from DB -->
                <?php
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    $sn = $count;
                    $id = $row["id"];
                    $question = $row["question"];
                    echo '<tr>
                            <td>' . $sn . '</td>
                            <td>' . $question . '</td>
                            <td>
                                <a href="qupdate.php?updateid=' . $id . '" class="btn btn-outline-success">Update</a>
                                <a href="qdelete.php?deleteid=' . $id . '" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>';
                    $count++;
                }
                ?>
                </tbody>
            </table>
            </body>
            </html>
            <?php
        } else {
            // No questions found
            echo "<h3><p style='color:#392bff; text-align:center;'>No questions in the database. Add <a href ='questionpanel.html' target='self'> here </a></p></h3>";
        }
        $result->free();
    } else {
        echo "Error executing query: " . $mysqli->error;
    }
} else {
    echo '<h3><p style="color:#392bff; text-align:center;">Executed Successfully!</p></h3>';
}
?>