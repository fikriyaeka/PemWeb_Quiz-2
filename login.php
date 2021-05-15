<?php 

require_once("config.php");

if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM data_akun WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    

    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if($user){

        if(password_verify($password, $user["password"])){

            session_start();
            $_SESSION["user"] = $user;

            header("Location: timeline.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Fikriya</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">

        <p>&larr; <a href="index.php">Home</a>

        <h4>Masuk ke Web Quiz</h4>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

        <form action="" method="POST">

            <div class="form-group">
                <label for="username"><b>USERNAME</b></label>
                <input class="form-control" type="text" name="username" placeholder="Username atau email" required/>
            </div>


            <div class="form-group">
                <label for="password"><b>PASSWORD</b></label>
                <input class="form-control" type="password" name="password" placeholder="Password" required/>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="rm" id="rm">
                <label class="form-check-label" for="exampleCheck1">Ingatkan Saya</label>
            </div>
            <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk" />

        </form>
            
        </div>

        <div class="col-md-6">

        </div>

    </div>
</div>
    
</body>
</html>