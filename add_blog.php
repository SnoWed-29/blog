<?php 
  session_start();
  $connecte = false;
  if(isset($_SESSION['user'])){
    $connecte = true;
  }
  
  if($connecte == false){
        header('location: login.php');
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

<body>
    <div class="container">
        <?php
            if(isset($_POST['postBlog'])){
                $title = $_POST['title'];
                $text = $_POST['text'];
                $userID = $_SESSION['user']['user_id'];
                if(!empty($title) && !empty($text)){
                    require_once 'include/database.php';
                    $sqlstate = $pdo->prepare('INSERT INTO posts VALUES(null,?,?,?,null)');
                    $sqlstate->execute([$title,$text,$userID]);
                }else{
                    ?>
        <div class="alert alert-danger" role="alert">
            Title  or Content is Empty !
        </div>
        <?php
                }
            }

        ?>
        <form method="POST">
            <h1 class="text-center">Add a Blog</h1>
            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" name="title" id="form6Example4" class="form-control" />
                <label class="form-label" for="form6Example4">title</label>
            </div>

            <!-- Message input -->
            <div class="form-outline mb-4">
                <textarea class="form-control" name="text" id="form6Example7" rows="4"></textarea>
                <label class="form-label" for="form6Example7">Your Content</label>
            </div>

            <!-- Submit button -->
            <button type="submit" name="postBlog" class="btn btn-primary btn-block mb-4">
                Place order
            </button>
        </form>
    </div>

</body>