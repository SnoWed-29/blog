<?php 
session_start();
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $pwd = $_POST['password'];

        if(!empty($username) && !empty($pwd)){
            
            require_once 'include/database.php';
            $query = $pdo->prepare('SELECT * FROM users where username=? and password=?');
            $query->execute([$username, $pwd]);


            if($query->rowCount() >= 1){                    
                $_SESSION['user'] = $query->fetch(PDO::FETCH_ASSOC);
            }else{
                echo "probleme here";
            }
            header('location: index.php');
    }else{
        header('location: login.php');
    }
}
?>