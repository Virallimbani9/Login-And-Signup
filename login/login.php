<?php
    $login = false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "par/_dbconnect.php";

        $err = "";
        $username = $_POST["username"];
        $password = $_POST["password"];
           
        $sql = "select * from users where username='$username' AND password = '$password'";

        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);

        if ($num == 1){
          $login = true;
          session_start();
          $_SESSION['login'] = true;
          $_SESSION['username'] = $username;
          header("location: welcome.php");

        }else{
          $showError = "Invalid Credentials";
        }
    }
   
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>


<body
    style="background-image: url('login.jpg');background-repeat: no-repeat; background-attachment:fixed;background-size:cover;">
    <?php require 'par/_nav.php';?>

    <?php
        if($login){
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Successfully </strong> You are Login.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }

        if($showError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Eorro </strong> ' . $showError . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
           }
    ?>

    <section class="ftco-section">
        <div class="container">
            <h1 class="text-center">LOGIN</h1>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="/VIRAL/LOGIN/login.php" class="signup-form" method="POST">
                            <div class="form-group">
                                <input id="username" type="text" class="form-control" for="username" name="username" placeholder="username"  required>
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" placeholder="Password"
                                    name="password" required>
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
                            </div>
                            <div class="form-group d-md-flex">

                                <div class="w-50 text-md-middle">
                                    <a href="#" style="color: #fff">Forgot Password ?</a>
                                </div>
                            </div>
                        </form>
                        <p class="w-100 text-center">&mdash; Or Sign Up With &mdash;</p>
                        <div class="social d-flex text-center">
                            <a href="#" class="px-2 py-2 mr-md-1 rounded"><span
                                    class="ion-logo-facebook mr-2"></span>Facebook</a>
                            <a href="#" class="px-2 py-2 ml-md-1 rounded"><span
                                    class="ion-logo-twitter mr-2"></span>Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>