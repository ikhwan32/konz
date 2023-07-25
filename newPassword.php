<?php
session_start();
include("inc/dbconnect.php");

$email = "";
$name = "";
$phoneNum = "";
$password = "";
$confirmPass = "";
$err = "";

$username = $_SESSION['username'];
$sql = "select * from customer where Customer_ID = '$username'";
$q = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($q);

if(isset($_POST['register'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPass = $_POST['confirmPass'];

    if ($oldPassword == '' or $newPassword == '' or $confirmPass == '') {
        $err .= "<li>Please enter your old password, new password and confirm password!</li>";
    }

    if (empty($err)) {
        $sql1 = "select * from customer where Customer_ID = '$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if ($r1['Customer_Password'] != md5($oldPassword)) {
            $err .= "<li>Wrong Old Password!</li>";
        }
    }

    if (empty($err)) {
        if ($newPassword != $confirmPass) {
            $err .= "<li>New Password and Confirm Password does not match!</li>";
        }
    }

    if (empty($err)) {
        $sql = "update customer set Customer_Password = md5('$newPassword') where Customer_ID = '$username'";
        $q = mysqli_query($conn, $sql);
        if ($q) {
            echo "<script>alert('Password updated successfully!')</script>";
            echo "<script>window.location.href='index.php'</script>";
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
                  <h3 class="card-title text-center">Update Password - <?php echo $err?></h3>
                </div>
                <div class="card-body">
  

                <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Old Password</label>
                    <div class="col">
                      <input type="password" class="form-control" placeholder="Password" name="oldPassword">
                      <small class="form-hint">
                        
                      </small>
                    </div>
                  </div>
 

                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">New Password</label>
                    <div class="col">
                      <input type="password" class="form-control" placeholder="Password" name="newPassword">
                      <small class="form-hint">
                        
                      </small>
                    </div>
                  </div>


                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Confirm New Password</label>
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
    
        <div class="text-center text-muted mt-3">
                <a href="./index.php" tabindex="-1">Return to Homepage</a>
              </div>


      
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>