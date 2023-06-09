<?php 
  session_start();
  $connecte = false;
  if(isset($_SESSION['user'])){
    $connecte = true;
  }

  if($connecte){
    header('location: index.php');
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


<div class="container my-5  d-flex justify-content-center align-items-center">
    <div class="col-sm-6 headerLogin shadow p-3 mb-5 bg-body-tertiary rounded">
        <form method="POST" action="cnx.php">
            <h1>Login</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">UserName :</label>
                <input type="text" name="username" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password :</label>
                <input type="password" name="password" class="form-control" >
            </div>
            <button type="submit" name="login" class="btn btn-primary">Submit</button>
            <a href="create_account.php" style="float: right" class="badge badge-success mt-3">New User ??</a>
        </form>
    </div>
</div>