<?php include('inc/header.php'); 

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
    $productID  = $_POST['productID'];
    if ($username == '' or $email == '' or $name == '' or $phoneNum == '' or $password == '' or $confirmPass == '') {
        $err .= "<li>Please fill in all the required fields!</li>";
    }
    if (empty($err)) {
        $sql1 = "select * from staff where Staff_ID = '$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1['Customer_ID'])) {
            $err .= "<li>Username already exists!</li>";
        }
    }
    if (empty($err)) {
        $sql1 = "select * from staff where Staff_Email = '$email'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1['Customer_Email'])) {
            $err .= "<li>Email already exists!</li>";
        }
    }
    if (empty($err)) {
        $sql1 = "select * from staff where Staff_ContactNum = '$phoneNum'";
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
        $sql1 = "insert into staff (Staff_ID, Staff_Email, Staff_Name, Staff_ContactNum, Staff_Password, Product_ID) values ('$username', '$email', '$name', '$phoneNum', md5('$password'), '$productID')";
        $q1 = mysqli_query($conn, $sql1);
        if ($q1) {
            echo "<script>window.location.href='users.php';</script>";
        } else {
            echo "<script>alert('Failed to add staff!');window.location.href='users.php';</script>";
        }

    }

}

?>

<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Add New Staff
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">

              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
        <div class="container-xl">

                <form class="card" action="" method="post">
                <div class="card-header">
                  <h3 class="card-title text-center">Register</h3>
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

                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Phone Number</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter phone number" name="phoneNum">

                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Email address</label>
                    <div class="col">
                      <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email">

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
               

                <div class="mb-3 row">
                    <label class="col-3 col-form-label">Select Product Managed by Staff </label>
                    <div class="col">
                      <select class="form-select" name ='productID'>
                        <?php
                        $sql = "select * from product";
                        $q = mysqli_query($conn, $sql);
                        while ($r = mysqli_fetch_array($q)) {
                            echo "<option  value='$r[Product_ID]'>$r[Product_ID] : $r[Product_Name]</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  </div>
                <div class="card-footer text-end">
                  <a href="users.php" class="btn btn-link">Cancel</a>
                  <button type="submit" class="btn btn-primary" name="register">Submit</button>
                </div>
              </form>

<?php include('inc/footer.php'); ?>