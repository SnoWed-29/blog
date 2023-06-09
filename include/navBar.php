<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">
        <a class="navbar-brand" href="index.php">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <?php   
                    if($connecte){
                        ?>

                <li class="nav-item">
                    <a class="nav-link" href="./add_blog.php">Add Post</a>
                </li>
                <?php
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Item 2</a>
                </li>
            </ul>
            <?php 
                    if($connecte == false){
                        ?>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login / Create Account</a>
                </li>
            </ul>
            <?php
                    }else{
                        ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php?id=<?php echo $_SESSION['user']['user_id']?>"><?php echo $_SESSION['user']['name']?></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php">Logout</a>
                </li>
            </ul>
            <?php
                    }
                ?>
        </div>
    </div>
</nav>