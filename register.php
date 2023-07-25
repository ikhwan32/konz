<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:index.php");
}

include("inc/dbconnect.php");

$username = "";
$email = "";
$name = "";
$phoneNum = "";
$password = "";
$confirmPass = "";
$err = "";

if(isset($_POST['register'])) {
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $name       = $_POST['name'];
    $phoneNum   = $_POST['phoneNum'];
    $password   = $_POST['password'];
    $confirmPass= $_POST['confirmPass'];
    if ($username == '' or $email == '' or $name == '' or $phoneNum == '' or $password == '' or $confirmPass == '') {
        $err .= "<li>Please fill in all the required fields!</li>";
    }
    if (empty($err)) {
        $sql1 = "select * from customer where Customer_ID = '$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1['Customer_ID'])) {
            $err .= "<li>Username already exists!</li>";
        }
    }
    if (empty($err)) {
        $sql1 = "select * from customer where Customer_Email = '$email'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1['Customer_Email'])) {
            $err .= "<li>Email already exists!</li>";
        }
    }
    if (empty($err)) {
        $sql1 = "select * from customer where Customer_ContactNum = '$phoneNum'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1['Customer_PhoneNum'])) {
            $err .= "<li>Phone number already exists!</li>";
        }
    }
    if (empty($err)) {
        if ($password != $confirmPass) {
            $err .= "<li>Passwords do not match!</li>";
        }
    }
    if (empty($err)) {
        $sql1 = "insert into customer (Customer_ID, Customer_Email, Customer_Name, Customer_ContactNum, Customer_Password) values ('$username', '$email', '$name', '$phoneNum', md5('$password'))";
        $q1 = mysqli_query($conn, $sql1);
        if ($q1) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Registered successfully!');</script>";
            echo "<script>window.location.href='index.php';</script>";
            exit();
        }
    }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign up</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
              Kuih Raya Onz
            </h1>
        </div>
              <form class="card" action="" method="post">
                <div class="card-header">
                  <h3 class="card-title text-center">Register - <?php echo $err?></h3>
                </div>
                <div class="card-body">
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Username</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter username" name="username">
                      <small class="form-hint">A username that will be used to login to our system.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Name</label>
                    <div class="col">
                      <input type="text" class="form-control"placeholder="Enter name" name="name">
                      <small class="form-hint">Preferably your full name, that will be used for postage. We'll never share your name with anyone else.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Phone Number</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter phone number" name="phoneNum">
                      <small class="form-hint">Phone number for verifcation. We'll never share your phone number with anyone else.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Email address</label>
                    <div class="col">
                      <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                      <small class="form-hint">We'll never share your email with anyone else.</small>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Password</label>
                    <div class="col">
                      <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                  </div>


                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Confirm Password</label>
                    <div class="col">
                      <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPass">
                      <small class="form-hint">
                        Reenter your password.
                      </small>
                    </div>
                  </div>  
                </div>

                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary" name="register">Submit</button>
                </div>
              </form>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="./login.php" tabindex="-1">Sign in</a>
        </div>
      </div>

      
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>