
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$currentEmail = $_SESSION['email'];
$userQuery = "SELECT * FROM `data` WHERE email='$currentEmail'";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);

if (isset($_POST['update'])) {
    $newName = mysqli_real_escape_string($conn, $_POST['new_name']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['new_email']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $sql = "UPDATE `data` SET name='$newName', email='$newEmail', password='$hashedPassword' WHERE email='$currentEmail'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        session_destroy();
        echo "<script>alert('Profile updated successfully. Please log in again.'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Update failed');</script>";
    }
}

if (isset($_POST['delete'])) {
    $deleteSql = "DELETE FROM `data` WHERE email='$currentEmail'";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        session_destroy();
        echo "<script>alert('Account deleted successfully'); window.location.href='signup.php';</script>";
        exit();
    } else {
        echo "<script>alert('Deletion failed');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrack EditProfile</title>
    <link rel="stylesheet" href="edit.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"  rel="stylesheet">
</head>
<body>
    <!--div class="pic">
</div-->
    <div class="profile">
    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="new_name" value="<?php echo $user['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="new_email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="new_password" placeholder="Enter new password" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" name="update" class="btn btn-success">Update Profile</button>
            <button type="submit" name="delete" class="btn btn-danger">Delete Profile</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
