<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Quiz App</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<?php
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'test';

  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
  } 

  if(isset($_POST['name']) && $_POST['name'] !== '') {
    if(isset($_POST['nim']) && $_POST['nim'] !== '') {
        if(isset($_POST['total_score']) && $_POST['total_score'] !== '') {
            $nama = $_POST['name'];
            $nim = $_POST['nim'];
            $total_score = $_POST['total_score'];
            $query="INSERT INTO nilai (nama,nim,total_score) VALUES ('$nama','$nim','$total_score');";
            if ($conn->query($query)) {
                // echo "<script>resetQuiz();</script>";
                echo "<script>alert('berhasil');</script>";
            }


        }
    }
    
  }
?>


<body>
    <header>
        <div class="logo">
            <img src="logo (1).png" alt="Quiz Logo">
            <span>Quiz App</span>
        </div>

        
        <nav>
            <a href="#" onclick="showPage('home')">Home</a>
            <a href="#" onclick="startQuiz()">Start Quiz</a>
            <a href="#" onclick="showPage('inputData')">Enter Data</a>
        </nav>
    </header> 

    <section id="content">
    <div id="home" class="container active">
        <h1>Welcome to the Ultimate Quiz</h1>
        <p>Test your knowledge and have fun!</p>
        <button onclick="startQuiz()">Start Quiz</button>
    </div>

    
    <div id="inputData" class="container hidden">
        <h2>Enter Your Data!!</h2>
        <input name ="name" type="text" id="name" placeholder="Name">
        <input name = "nim" type="text" id="nim" placeholder="NIM"><br>
        <button onclick="submitPlayerData()">Submit</button>
    </div>

    <div id="quizPage" class="container hidden">
        <div class="quiz-header">
            <div id="timer">Time: 30s</div>
            <div id="questionNav"></div>
        </div>
        
        <div id="questionContainer" class="question-box"></div>
        <div class="nav-buttons">
            <button onclick="prevQuestion()">Previous</button>
            <button onclick="nextQuestion()">Next</button>
        </div>
        <div id="status">Question <span id="currentQuestion">1</span> of <span id="totalQuestions">5</span></div>
    </div>

    <div id="resultPage" class="container hidden">
        <h2>Quiz Results</h2>
        <p>Name: <span id="resultName"></span></p>
        <p>NIM: <span id="resultNIM"></span></p>
        <p>Total Score: <span id="resultScore"></span></p>

        <form action="backend.php" method='post'>
            <input id="Nama" type="hidden" name="nama">
            <input id="Nim" type="hidden" name="nim">
            <input id="Total_score" type="hidden" name="total_score">
            <button type="submit">Back to Home</button>
        </form>

       
    </div>
</section>
<script src="script.js"></script>
</body>
</html>