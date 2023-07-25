<?php include'./inc/dbconnect.php'; 
if (isset($_SESSION['username'])) {
    header("location:index.php");
}
?>

<?php include'./inc/header.php'; 

$username = "";
$email = "";
$name = "";
$phoneNum = "";
$password = "";
$confirmPass = "";
$err = "";
$oldusername = $_SESSION['username'];

$username = $_SESSION['username'];
$sql = "select * from customer where Customer_ID = '$username'";
$q = mysqli_query($conn, $sql);
$r = mysqli_fetch_array($q);
$email = $r['Customer_Email'];
$name = $r['Customer_Name'];
$phoneNum = $r['Customer_ContactNum'];
$oldNum = $r['Customer_ContactNum'];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phoneNum = $_POST['phoneNum'];

    if (empty($username) || empty($email) || empty($name) || empty($phoneNum)) {
        $err = "Please fill in all the fields.";
    }

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $err = "Invalid username.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Invalid email.";
    }



    if (!preg_match("/^[0-9]*$/", $phoneNum)) {
        $err = "Invalid phone number.";
    }

    if ($err == "") {
        $sql = "select * from customer where Customer_ID = '$oldusername' and Customer_ContactNum != '$oldNum'";
        $q = mysqli_query($conn, $sql);
        $r = mysqli_fetch_array($q);
        if ($r) {
            $err = "Username already exists.";
            echo $r['Customer_ID'];
        }
    }

    if ($err == "") {
        $sql = "select * from customer where Customer_Email = '$email' and Customer_ID != '$oldusername'";
        $q = mysqli_query($conn, $sql);
        $r = mysqli_fetch_array($q);
        if ($r) {
            $err = "Email already exists.";
            echo $r['Customer_Email'];
            echo $oldusername;
        }
    }

    if ($err == "") {
        $sql = "select * from customer where Customer_ContactNum = '$phoneNum' and Customer_ID != '$oldusername'";
        $q = mysqli_query($conn, $sql);
        $r = mysqli_fetch_array($q);
        if ($r) {
            $err = "Phone number already exists.";
        }
    }

    if ($err == "") {
        $sql = "update customer set Customer_ID = '$username', Customer_Email = '$email', Customer_Name = '$name', Customer_ContactNum = '$phoneNum' where Customer_ID = '$oldusername'";
        $q = mysqli_query($conn, $sql);
        if ($q) {
            echo "<script>alert('Profile updated successfully. Login again');window.location.href='logout.php';</script>";
        }
    }



    
}

?>

<div class="container-xl">
            <div class="card">
              <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                  <div class="card-body">
                    <h4 class="subheader">Account settings</h4>
                    <div class="list-group list-group-transparent">
                      <a href="./profile.php" class="list-group-item list-group-item-action d-flex align-items-center active">My Account</a>
                      <a href="./orders.php" class="list-group-item list-group-item-action d-flex align-items-center">My Orders</a>
                      <a href="./address.php" class="list-group-item list-group-item-action d-flex align-items-center">Address Book</a>
                    </div>
                    <h4 class="subheader mt-4">MISC</h4>
                    <div class="list-group list-group-transparent">
                      <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column">
                  <div class="card-body">
                    <h2 class="mb-4">My Account</h2>
                    <h3 class="card-title">Profile Details</h3>
                    <h3 class="card-title mt-4">Your Profile</h3>
                    <p class="card-subtitle"><?php echo $err ?></p>
                    <div class="row g-3">
                      <div class="col-md">
                        <form action="" method="post">
                        <div class="form-label">Full Name</div>
                        <input type="text" class="form-control" value="<?php echo $name?>" name="name">
                      </div>
                      <div class="col-md">
                        <div class="form-label">Username</div>
                        <input type="text" class="form-control" value="<?php echo $username?>" name ="username">
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Phone Number</h3>
                    <p class="card-subtitle">This contact will be used for delivery, so choose it carefully.</p>
                    <div>
                      <div class="row g-2">
                        <div class="col-auto">
                          <input type="text" class="form-control w-auto" value="<?php echo $phoneNum?>" name="phoneNum">
                        </div>

                      </div>
                    </div>
                    <h3 class="card-title mt-4">Email</h3>
                    <p class="card-subtitle">This contact will be used for delivery, so choose it carefully.</p>
                    <div>
                      <div class="row g-2">
                        <div class="col-auto">
                          <input type="text" class="form-control w-auto" value="<?php echo $email ?>" name="email">
                        </div>

                      </div>
                    </div>
                    <h3 class="card-title mt-4">Password</h3>
                    <p class="card-subtitle">You can change your password.</p>
                    <div>
                      <a href="./newPassword.php" class="btn">
                        Set new password
                      </a>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                      <a href="#" class="btn">
                        Cancel
                      </a>
                      <button type='submit' class='btn btn-primary' name='submit'>Submit</button>
                    </div>
</form>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php include'./inc/footer.php'; ?>