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

<body>
    <?php include 'include/navBar.php';?>
    <div class="container">
        <?php 
            $blogId = $_GET['id'];
            require_once 'include/database.php';
            $blogQuery = $pdo->prepare('SELECT * FROM posts WHERE post_id = ?');
            $blogQuery->execute([$blogId]);
            $blogs = $blogQuery->fetchALL(PDO::FETCH_OBJ);

            $authorID = $blogs[0]->user_id;
            $authorQuery = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
            $authorQuery->execute([$authorID]);
            $author = $authorQuery->fetchALL(PDO::FETCH_OBJ);
        ?>
        <pre>

        </pre>
        <div class="row d-flex justify-content-around">
            <div class="col-sm-3 border-right">
                <div class="row">
                    <h3>Writen by : <?php echo $author[0]->name?></h3>
                    <h4>Add on : <?php echo $blogs[0]->created_at?></h4>
                </div>
            </div>
            <div class="col-sm-8">
                <h2><?php echo $blogs[0]->title?></h2>
                <p><?php echo $blogs[0]->content?></p>
            </div>
        </div>
    </div>
    <?php

  if(isset($_POST['subComment'])){
    $userCid = $_SESSION['user']['user_id'];
    $comment = $_POST['comment'];
    if(!empty($comment)){
        require_once 'include/database.php';
        $cmt = $pdo->prepare('INSERT INTO comments value(null,?,?,?,null)');
        $cmt->execute([$comment,$userCid,$blogId]);
    }

  }
  ?>

    <div class="container border mt-4">
        <h3>Post Title</h3>
        <p>Post content goes here.</p>

        <!-- Comment Form -->
        <form method="post">
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Enter your comment"
                    required></textarea>
            </div>
            <button type="submit" name="subComment" class="btn btn-primary">Submit</button>
        </form>

        <hr>
        <?php
    require_once 'include/database.php';
    $showComment = $pdo->prepare('SELECT * from comments WHERE post_id=? ');
    $showComment->execute([$blogId]);
    $blogComments = $showComment->fetchAll(PDO::FETCH_OBJ);
?>
        <!-- Comment Section -->

        <div id="commentSection border">
            <?php
                foreach($blogComments as $blogComment){
                    ?>
            <div class="userComment">
                <div class="comment">
                    <div class="comment-header">
                        <span class="comment-name"><?php echo $blogComment->user_id?></span>
                        <span class="comment-timestamp"><?php echo $blogComment->created_at?></span>
                    </div>
                    <div class="comment-body">
                            <?php echo $blogComment->content?>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
            <!-- -->
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