<?php
// Database connection
$mysqli = mysqli_connect("localhost", "root", "", "question");

// Check for update action
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $semester = $_POST["semester"];
    $chapter = $_POST["chapter"];
    $difficulty = $_POST["difficulty"];
    $question = $_POST["question"];
    $subject = $_POST["subject"];

    $query = "UPDATE qdemo SET semester='$semester', chapter='$chapter', difficulty='$difficulty', question='$question', subject='$subject' WHERE id=$id";

    if (mysqli_query($mysqli, $query)) {
        echo "<br>Your data successfully updated";
        header('Location: qretrieve.php');
        exit;
    } else {
        echo "<br>Error while updating your data: " . mysqli_error($mysqli);
    }
}

// Retrieve question details
$id = $_GET["updateid"];
$query = "SELECT * FROM qdemo WHERE id=$id";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Question Panel</title>
    <style>
        .main{
	background-image: linear-gradient(150deg, #9ccbff 10%,#FFFFFF 90%);}
       .forcenter {
            margin-top: 70px;
        }
       /* Button styles */
        .bubble-btn {
            display: inline-block;
            font: normal normal 300 1.3em 'Open Sans';
            text-decoration: none; 
            color: #ffffff;
            background-color: transparent;
            border: 1px solid #ffffff;
            border-radius: 100px;
            padding: .3em 1.2em;
            margin: 5px;
        }
        /* Hover effect for button */
        .bubble-btn:hover {
            animation: bubble 0.4s ease-out;
            background-color: #00a64d;
            border-color: #00a64d;
            cursor: pointer;
        } 
        /* Animation keyframes for button */
        @keyframes bubble {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body class="main">
    <div class="forcenter">
        <form action="" method="post">
            <fieldset class="box">
                <label for="question" style="font-weight: bold;" class="design">Enter Question & Difficulty Level</label><br>
                <div class="semester">
                    <label for="semester">Semester</label>
                    <label for="slct" class="select">
                        <select id="semester" name="semester" required onchange="updateSubject()">
                            <option value="" disabled>Select option</option>
                            <option value="one" <?php if($row["semester"] == "one") echo "selected"; ?>>Semester 1</option>
                            <option value="two" <?php if($row["semester"] == "two") echo "selected"; ?>>Semester 2</option>
                            <option value="three" <?php if($row["semester"] == "three") echo "selected"; ?>>Semester 3</option>
                            <option value="four" <?php if($row["semester"] == "four") echo "selected"; ?>>Semester 4</option>
                            <option value="five" <?php if($row["semester"] == "five") echo "selected"; ?>>Semester 5</option>
                            <option value="six" <?php if($row["semester"] == "six") echo "selected"; ?>>Semester 6</option>
                            <option value="seven" <?php if($row["semester"] == "seven") echo "selected"; ?>>Semester 7</option>
                            <option value="eight" <?php if($row["semester"] == "eight") echo "selected"; ?>>Semester 8</option>
                        </select>
                    </label>
                </div>
                <div class="subject">
                    <label for="subject">Subject:</label>
                    <label for="slct" class="select"></label>
                    <select id="subject" name="subject" required>
                        <option value="" disabled selected>Select</option>
                    </select>
                </div>
                <textarea type="text" placeholder="Enter your question" name="question" rows="2" cols="50" required><?php echo $row["question"]; ?></textarea>
                <div class="chapter">
                    <label for="chapter">Chapter</label><br>
                    <label for="slct" class="select">
                        <select id="chapter" name="chapter" required>
                            <option value="" disabled>Select option</option>
                            <option value="one" <?php if($row["chapter"] == "one") echo "selected"; ?>>Chapter 1</option>
                            <option value="two" <?php if($row["chapter"] == "two") echo "selected"; ?>>Chapter 2</option>
                            <!-- Add options for other chapters -->
                        </select>
                    </label>
                </div>
                <div class="difficult">
                    <label for="difficulty">Difficulty</label><br>
                    <label for="difficulty" class="select">
                        <select id="difficulty" name="difficulty" required>
                            <option value="" disabled>Select option</option>
                            <option value="easy" <?php if($row["difficulty"] == "easy") echo "selected"; ?>>Easy</option>
                            <option value="intermediate" <?php if($row["difficulty"] == "intermediate") echo "selected"; ?>>Intermediate</option>
                            <!-- Add options for other difficulty levels -->
                        </select>
                    </label>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="wrap">
                    <button class="bubble-btn" name="update" type="submit">Update</button>
                </div>
            </fieldset>
        </form>
    </div>
    <script>
        // Function to update the subject options based on selected semester
        function updateSubject() {
            var semester = document.getElementById("semester").value;
            var subject = document.getElementById("subject");
            var selectedSubject = "<?php echo $row['subject']; ?>"; // Fetch the initially selected subject from PHP

            subject.innerHTML = "<option value='' disabled>Select</option>"; // Clear previous options

            if (semester === "one") {
                subject.innerHTML += "<option value='Computer Fundamental'>Computer Fundamental</option>";
                subject.innerHTML += "<option value='Digital Logic'>Digital Logic</option>";
                subject.innerHTML += "<option value='MathsI'>MathsI</option>";
                subject.innerHTML += "<option value='EnglishI'>EnglishI</option>";
                subject.innerHTML += "<option value='Society and Technology'>Society and Technology</option>";
            } else if (semester === "two") {
                subject.innerHTML += "<option value='MathsII'>MathsII</option>";
                subject.innerHTML += "<option value='Microprocessor'>Microprocessor</option>";
                subject.innerHTML += "<option value='EnglishII'>EnglishII</option>";
                subject.innerHTML += "<option value='Account'>Account</option>";
                subject.innerHTML += "<option value='C Programming'>C Programming</option>";
            } else if (semester === "three") {
                subject.innerHTML += "<option value='Web Technology'>Web Technology</option>";
                subject.innerHTML += "<option value='Java'>Java</option>";
                subject.innerHTML += "<option value='Statistics'>Statistics</option>";
                subject.innerHTML += "<option value='DSA'>DSA</option>";
                subject.innerHTML += "<option value='SAD'>SAD</option>";
            }
            // Re-select the previous subject if it matches the current semester
            var options = subject.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === selectedSubject) {
                    options[i].selected = true;
                    break;
                }
            }
        }

        // Call updateSubject() on page load and whenever the semester dropdown changes
        window.onload = updateSubject;
        document.getElementById("semester").addEventListener("change", updateSubject);
    </script>
</body>
</html>

