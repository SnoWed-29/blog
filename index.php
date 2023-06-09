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
    <?php 
        include 'include/navBar.php';
    ?>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="headerDesc shadow p-3 mb-5 bg-body-tertiary rounded">
                        <h1 class=".text-primary">Blog</h1>
                        <p class=".text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus,
                            tempora? Ut pariatur nulla quos ducimus accusantium, totam, nesciunt cupiditate repellendus
                            suscipit culpa, magnam architecto facere modi quasi perspiciatis labore nisi?</p>
                    </div>
                </div>
                <?php 
                        if($connecte == false){
                            ?>
                <div class="card float-right" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Connecte to start sharing Your Thoughts</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus
                            doloremque ipsum reiciendis necessitatibus eum.</p>
                        <a href="login.php" class="card-link">login</a>
                        <a href="create_account.php" class="card-link">Create account</a>
                    </div>
                </div>

                <?php
                        }else{
                            ?>
                <h1>Welcome <span class=".text-success"><?php echo $_SESSION['user']['name'];?></span></h1>
                <?php
                        }
                    ?>
            </div>
        </div>
    </header>
    <section class="homeBlogs my-3">
        <div class="container">
            <?php
                include 'include/database.php';
                $showBlogQuery = $pdo->prepare('SELECT * FROM posts');
                $showBlogQuery->execute();
                $blogs = $showBlogQuery->fetchALL(PDO::FETCH_OBJ);
            ?>
            <div class="row">
                <?php
                foreach($blogs as $blog){
                    ?>
                <div class="col-sm-6 my-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $blog->title ?></h5>
                            <p class="card-text"><?php echo $blog->title ?></p>
                            <a href="blog_page.php?id=<?php echo $blog->post_id?>" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <?php
                }
            ?>
            </div>
        </div>
    </section>
    <?php 
        include 'include/footer.php'
    ?>

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