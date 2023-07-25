<?php include('inc/header.php'); 

$username = "";
$email = "";
$name = "";
$phoneNum = "";
$password = "";
$confirmPass = "";
$err = "";

$username = $_GET['id'];

if (isset($_GET['editCust'])) {
    $sql = "select * from customer where Customer_ID = '$username'";
    $q = mysqli_query($conn, $sql);
    $r = mysqli_fetch_array($q);
    $username = $r['Customer_ID'];
    $oldusername = $r['Customer_ID'];
    $email = $r['Customer_Email'];
    $name = $r['Customer_Name'];
    $phoneNum = $r['Customer_ContactNum'];
    $oldNum = $r['Customer_ContactNum'];
    $password = $r['Customer_Password'];
    $confirmPass = $r['Customer_Password'];
}

if (isset($_GET['editStaff'])) {
    $sql = "select * from staff where Staff_ID = '$username'";
    $q = mysqli_query($conn, $sql);
    $r = mysqli_fetch_array($q);
    $username = $r['Staff_ID'];
    $oldusername = $r['Staff_ID'];
    $email = $r['Staff_Email'];
    $name = $r['Staff_Name'];
    $phoneNum = $r['Staff_ContactNum'];
    $oldNum = $r['Staff_ContactNum'];
    $password = $r['Staff_Password'];
    $confirmPass = $r['Staff_Password'];
    $productID = $r['Product_ID'];
}


if (isset($_POST['update'])) {
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $name       = $_POST['name'];
    $phoneNum   = $_POST['phoneNum'];
    $password   = $_POST['password'];
    $confirmPass= $_POST['confirmPass'];
    if ($username == '' or $email == '' or $name == '' or $phoneNum == '') {
        $err .= "<li>Please fill in all the required fields!</li>";
    }
    if (empty($err)) {
        $sql1 = "select * from customer where Customer_ID = '$oldusername' and Customer_ContactNum != '$oldNum'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1['Customer_ID'])) {
            $err .= "<li>Username already exists!</li>";
        }
    }
    if (empty($err)) {
        $sql1 = "select * from customer where Customer_Email = '$email' and Customer_ID != '$oldusername'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1['Customer_Email'])) {
            $err .= "<li>Email already exists!</li>";
        }
    }
    if (empty($err)) {
        $sql1 = "select * from customer where Customer_ContactNum = '$phoneNum' and Customer_ID != '$oldusername'";
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
    echo $username;
    if (empty($err)){
    if(isset($_GET['editCust'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phoneNum = $_POST['phoneNum'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirmPass'];
        if ($password != "" && $confirmPass != "") {
            $sql = "UPDATE `customer` SET 'Customer_ID'='$username', `Customer_Email`='$email',`Customer_Name`='$name',`Customer_ContactNum`='$phoneNum',`Customer_Password`=md5('$password') WHERE `Customer_ID`='$oldusername'";
            $q = mysqli_query($conn, $sql);
            if ($q) {
                echo "<script>alert('Customer updated successfully!');window.location.href='users.php';</script>";
            } else {
                echo "<script>alert('Failed to update customer!');window.location.href='users.php';</script>";
            }
        }
        else{
            $sql = "UPDATE `customer` SET `Customer_ID`='$username', `Customer_Email`='$email',`Customer_Name`='$name',`Customer_ContactNum`='$phoneNum' WHERE `Customer_ID`='$username'";
            $q = mysqli_query($conn, $sql);
            if ($q) {
                echo "<script>alert('Customer updated successfully!');window.location.href='users.php';</script>";
            } else {
                echo "<script>alert('Failed to update customer!');window.location.href='users.php';</script>";
            }
        }

    }
    if (isset($_GET['editStaff'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phoneNum = $_POST['phoneNum'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirmPass'];
        $productID = $_POST['productID'];
        if ($password != "" && $confirmPass != "") {
            $sql = "UPDATE `staff` SET `Staff_Email`='$email',`Staff_Name`='$name',`Staff_ContactNum`='$phoneNum',`Staff_Password`=md5('$password'),`Product_ID`='$productID' WHERE `Staff_ID`='$username'";
            $q = mysqli_query($conn, $sql);
            if ($q) {
                echo "<script>alert('Staff updated successfully!');window.location.href='users.php';</script>";
            } else {
                echo "<script>alert('Failed to update staff!');window.location.href='users.php';</script>";
            }
        }
        else{
            $sql = "UPDATE `staff` SET `Staff_Email`='$email',`Staff_Name`='$name',`Staff_ContactNum`='$phoneNum',`Product_ID`='$productID' WHERE `Staff_ID`='$username'";
            $q = mysqli_query($conn, $sql);
            if ($q) {
                echo "<script>alert('Staff updated successfully!');window.location.href='users.php';</script>";
            } else {
                echo "<script>alert('Failed to update staff!');window.location.href='users.php';</script>";
            }
        }
    }
}}

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
                  Edit Existing User
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
                  <h3 class="card-title text-center">Register - <?php echo $err?></h3>
                </div>
                <div class="card-body">
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Username</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter username" name="username" value="<?php echo $username;?>">
                      <small class="form-hint">A username that will be used to login to our system.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Name</label>
                    <div class="col">
                      <input type="text" class="form-control"placeholder="Enter name" name="name" value="<?php echo $name;?>">
                      <small class="form-hint">Your full name.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Phone Number</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter phone number" name="phoneNum" value="<?php echo $phoneNum;?>">
                      <small class="form-hint">Phone number for verifcation. We'll never share your phone number with anyone else.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Email address</label>
                    <div class="col">
                      <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo $email;?>">
                      <small class="form-hint">We'll never share your email with anyone else.</small>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Password</label>
                    <div class="col">
                      <input type="password" class="form-control" placeholder="Password" name="password" >
     
                      </small>
                    </div>
                  </div>


                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Confirm Password</label>
                    <div class="col">
                      <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPass" >
                      <small class="form-hint">
                        Reenter your password.
                      </small>
                    </div>
                  </div>  
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label">Select Product Managed by Staff (FOR STAFF ONLY)</label>
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
                  <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
              </form>

<?php include('inc/footer.php'); ?>