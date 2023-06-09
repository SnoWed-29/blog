<?php 
  session_start();
  $connecte = false;
  if(isset($_SESSION['user'])){
    $connecte = true;
  }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Hello, world!</title>
</head>

<?php
    include 'include/navBar.php';
?>
<div class="container d-flex justify-content-center my-5 align-items-center">
    <div class="col-sm-6 my-5 loginForm shadow p-3 mb-5 bg-body-tertiary rounded">
        <h2>User Registration Form</h2>
        <?php 
    if(isset($_POST['submit'])){
        // getting user info 
        $FullName = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['user_login'];
        $password = $_POST['password'];
        if(!empty($FullName) && !empty($email) && !empty($username) && !empty($password)){
            require_once 'include/database.php';
            $sqlquery = $pdo->prepare('INSERT INTO USERS VALUES(null,?,?,?,null,?)');
            $sqlquery->execute([$username,$email,$password,$FullName]);
            ?>
                <div class="alert alert-success" role="alert">
                    Your account has been created.
                </div>
            <?php
            header('location: index.php'); 
        }else{
            
        }
        
    }

?>
        <form method="POST">
            <div class="form-group">
                <label for="last_name">Full Name:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your last name"
                    required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                    required>
            </div>
            <div class="form-group">
                <label for="user_login">Username:</label>
                <input type="text" class="form-control" id="user_login" name="user_login"
                    placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter your password">
            </div>
            <button name="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>