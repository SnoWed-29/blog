<?php 
  session_start();
  $connecte = false;
  if(isset($_SESSION['user'])){
    $connecte = true;
  }
  $userId = $_GET['id'];
  if(empty($userId)){
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

<body>
    <?php 
        include 'include/navBar.php';
    ?>

    <?php
    require_once 'include/database.php';
    $statement = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
    $statement->execute([$userId]);
    $profile = $statement->fetchAll(PDO::FETCH_ASSOC);

    $blogStatement = $pdo->prepare('SELECT * FROM posts where user_id = ?');
    $blogStatement->execute([$userId]);
    $blogs = $blogStatement->fetchALL(PDO::FETCH_OBJ);
    
?>

    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-sm-3 border">
                <div class="text-center">
                    <img src="media/avatar.jpeg" class="img-fluid rounded-circle border" alt="profilePic">
                </div>
                <h3 class="text-center border-bottom"><?php echo $profile[0]['name'] ?></h3>
                <p>Joined at : </p><span class="border-bottom"><?php echo $profile[0]['created_at']?></span>
            </div>
            <div class="col-sm-8 border">
                <div class="row d-flex justify-content-around">
                    <?php 
                        foreach($blogs as $blog){
                            ?>

                    <div class="card my-2" style="width: 18rem;">
                        <img class="card-img-top" src="./media/header.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $blog->title ?></h5>
                            <p class="card-text"><?php echo $blog->content ?></p>
                            <a href="./blog_page.php?id=<?php echo $blog->post_id?>" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>