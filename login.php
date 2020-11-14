<!DOCTYPE html>
<?php
include('db.php');
include('session.php');
$status = '';
?>

<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = ($_POST['password']);
    $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        //get the number of results based n the sql statement
        $numrows = mysqli_num_rows($result);

        //check the number of result, if equal to one
        //IF theres a result
        if ($numrows == 1) {
            //store the result to a array and passed to variable found_user
            while ($row = mysqli_fetch_assoc($result)) {
                // $found_user  = mysqli_fetch_array($result);

                //fill the result to session variable
                $_SESSION['MEMBER_ID']  = $row['id'];
                $_SESSION['fullName'] = $row['fullName'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
            } ?>

<script type="text/javascript">
//then it will be redirected to index.php
window.location = "home.php";
</script>
<?php

        } else {
            //IF theres no result
        ?> <script type="text/javascript">
alert("Username or Password Not Registered! Contact Your administrator.");
window.location = "login.php";
</script>
<?php

        }
    }
}
?>


<?php
if (isset($_POST['signup'])) {
    echo $username = $_POST['username'];
    echo $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO `user`(`fullName`, `email`, `password`) VALUES ('$username','$email','$password')";
    if (mysqli_query($conn, $sql)) {
        $status = "user created";
    }
}
?>



<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <!--==== 🚀 Log In Form 🚀 ==== -->
            <div class="signin-signup">
                <form action="#" method="POST" class="sign-in-form">
                    <div class="alert alert-primary" role="alert">
                        <?php echo $status; ?>
                    </div>
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" placeholder="email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" name="login" value="Login" class="btn solid" />
                    <p class="social-text">Or Sign in with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <!-- End Of Log In    -->
                <!--====✍ Register Form ✍====-->
                <form action="#" method="post" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" name="signup" class="btn" value="Sign up" />
                    <!-- <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> -->
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Sign Up</h3>
                    <p>
                        Create a new account
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Sign in</h3>
                    <p>
                        I have an account
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>

</html>