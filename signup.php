<?php
include 'db.php';
$message="";
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $enrollment=$_POST['enrollment'];
     $email=$_POST['email'];
    $password=$_POST['password'];
    $checkEmail = "SELECT * FROM `data` where email='$email'";
    $checkResult= mysqli_query($conn,$checkEmail);

    if(mysqli_num_rows($checkResult)>0){

          $message='<div class="alert alert-danger" role="alert">Email already exist!! Try another</div>';
    }else{
    $sql= "INSERT INTO `data` (name,enrollment,email,password) values ('$name','$enrollment','$email','$password')";
    $result = mysqli_query($conn,$sql);
    if($result){
        session_start();
        $_SESSION['email'] = $email;
        header("Location: dashboard.php"); 
        exit();
    } else {
        die(mysqli_error($conn));
    }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrack</title>
    <link rel="stylesheet" href="edit.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"  rel="stylesheet">
<body>
    <div class="contain my-3">
      <?php if (!empty($message)) { echo $message; } ?>
    </div>
    <div class="bg-image d-flex justify-content-center align-items-center vh-100">
    <div class="text-center mb-4 text-white">
        <h1 class="fw-bold">EduTrack</h1>
        <p class="lead">Empowering minds, tracking progress</p>
    </div>
    <div class="container">
    <form method="post" action=''>
         <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
  </div>
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Enrollment</label>
    <input type="text" class="form-control" name="enrollment" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Signup</button>
 
<a href="index.php" class="btn btn-primary">Login</a>
</form>
</div>
</body>
</html>
