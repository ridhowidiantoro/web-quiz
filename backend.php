<?php
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'test';

  $error = '';
  $isError = false;

  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
  } 

  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'quiz';

  $conn = new mysqli($host, $username, $password, $database);
  if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
  } 

  if(isset($_POST['nama']) && $_POST['nama'] !== '') {
    if(isset($_POST['nim']) && $_POST['nim'] !== '') {
        if(isset($_POST['total_score']) && $_POST['total_score'] !== '') {
            $nama = $_POST['nama'];
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if($isError): ?>
    <p><?= $error ?></p> 
  <?php endif; ?>
  <?php if($_POST['nama']): ?>
    <h1><?= $_POST['nama'] ?></h1>
  <?php endif ?>
  <form action="" method='post'>
    <div>
      <label for="nama">Nama: </label>
      <input id="nama" name="nama" />
    </div>
    <div>
      <label for="nim">Nim: </label>
      <input id="nim" name="nim" />
    </div>
    <button type="submit">submit</button>
  </form>
</body>
</html>