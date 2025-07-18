<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
session_start();

$message = "";
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql = "SELECT * FROM `data` WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
       $_SESSION['email'] = $email;
        header("Location: dashboard.php"); 
        exit();
    }else{
       $message = '<div class="alert alert-danger" role="alert">Wrong email or password. Please check and try again.</div>';
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrack</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"  rel="stylesheet">
<body>
  <div class="container my-3">
      <?php if (!empty($message)) { echo $message; } ?>
</div>
    <div class="bg-image d-flex justify-content-center align-items-center vh-100">
    <div class="head text-center mb-4 white-text">
        <h1 class="fw-bold">EduTrack</h1>
        <p class="lead">Empowering minds, tracking progress</p>
    </div>
    <div class="container">
    <form method="Post" action=''>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
</body>
</html>
