<?php include './inc/header.php'; 

$id = "";
$fname = "";
$lname = "";
$address = "";
$city = "";
$zipCode = "";
$states = "";
$deliveryInstruction = "";
$customerID = $_SESSION['username'];
$err = "";

if (isset($_POST['add'])) {
    $id = $_POST['addressID'];
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipCode = $_POST['zipCode'];
    $states = $_POST['states'];
    $deliveryInstruction = $_POST['deliveryInstruction'];

    if ($fname == '' or $lname == '' or $address == '' or $city == '' or $zipCode == '' or $states == '') {
        $err .= "<li>Please fill in all the required fields!</li>";
    }
      
    if (empty($err)) {
        $sql1 = "select * from address where id = '$id'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if (!empty($r1['id'])) {
            $err .= "<li>Address already exists!</li>";
        }
    }

    if (empty($err)) {
        $sql1 = "insert into address (Customer_ID, fName, lastName, address1, city, postalCode, states, deliveryInstruction) values ('$customerID', '$fname', '$lname', '$address', '$city', '$zipCode', '$states', '$deliveryInstruction')";
        $q1 = mysqli_query($conn, $sql1);
        if ($q1) {
            echo "<script>alert('Address added!');window.location.href='address.php';</script>";
        } else {
            echo "<script>alert('Failed to add address!');window.location.href='address.php';</script>";
        }
    }


}

if (isset($_POST['show'])) {
    $id = $_POST['addressID'];
    $sql = "select * from address where id = '$id'";
    $q = mysqli_query($conn, $sql);
    $r = mysqli_fetch_array($q);
    $fname = $r['fName'];
    $lname = $r['lastName'];
    $address = $r['address1'];
    $city = $r['city'];
    $zipCode = $r['postalCode'];
    $states = $r['states'];
    $deliveryInstruction = $r['deliveryInstruction'];
}

if (isset($_POST['update'])) {
    $id = $_POST['addressID'];
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipCode = $_POST['zipCode'];
    $states = $_POST['states'];
    $deliveryInstruction = $_POST['deliveryInstruction'];
    $sql1 = "update address set fName = '$fname', lastName = '$lname', address1 = '$address', city = '$city', postalCode = '$zipCode', states = '$states', deliveryInstruction = '$deliveryInstruction' where id = '$id'";
    $q1 = mysqli_query($conn, $sql1);
    if ($q1) {
        echo "<script>alert('Address updated!');window.location.href='address.php';</script>";
    } else {
        echo "<script>alert('Failed to update address!');window.location.href='address.php';</script>";
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['addressID'];
    $sql1 = "delete from address where id = '$id'";
    $q1 = mysqli_query($conn, $sql1);
    if ($q1) {
        echo "<script>alert('Address deleted!');window.location.href='address.php';</script>";
    } else {
        echo "<script>alert('Failed to delete address!');window.location.href='address.php';</script>";
    }
}



?>
<div class="card">
              
                <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                  <div class="card-body">
                    <h4 class="subheader">Account settings</h4>
                    <div class="list-group list-group-transparent">
                      <a href="./profile.php" class="list-group-item list-group-item-action d-flex align-items-center">My Account</a>
                      <a href="./orders.php" class="list-group-item list-group-item-action d-flex align-items-center ">My Orders</a>
                      <a href="./address.php" class="list-group-item list-group-item-action d-flex align-items-center active">Address Book</a>
                    </div>
                    <h4 class="subheader mt-4">MISC</h4>
                    <div class="list-group list-group-transparent">
                      <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column">
                <form class="card" action="" method="post">
                    <div class="card-body">
                    <h2 class="mb-4">My Account</h2>
                    <h3 class="card-title">Address Book</h3>
                      <div class="row row-cards">
                      <input type="hidden" name="addressID" value="<?php echo $id?>">

                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" value="<?php echo $fname?>" name="fName">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $lname?>" name="lName">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" placeholder="Home Address" name="address"
									       value="<?php echo $address?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $city?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Postal Code</label>
                            <input type="test" class="form-control" placeholder="ZIP Code" name="zipCode" value="<?php echo $zipCode?>">
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label" >States</label>
                            <select class="form-control form-select" name="states">
                            <option value="Johor">Johor</option>
      <option value="Kedah">Kedah</option>
      <option value="Kelantan">Kelantan</option>
      <option value="Kuala Lumpur">Kuala Lumpur</option>
      <option value="Labuan">Labuan</option>
      <option value="Melaka">Melaka</option>
      <option value="Negeri Sembilan">Negeri Sembilan</option>
      <option value="Pahang">Pahang</option>
      <option value="Penang">Penang</option>
      <option value="Perak">Perak</option>
      <option value="Perlis">Perlis</option>
      <option value="Putrajaya">Putrajaya</option>
      <option value="Sabah">Sabah</option>
      <option value="Sarawak">Sarawak</option>
      <option value="Selangor">Selangor</option>
      <option value="Terengganu">Terengganu</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3 mb-0">
                            <label class="form-label">Delivery Instruction</label>
                            <textarea rows="5" class="form-control" placeholder="Here can be your description"
									          value="<?php echo $deliveryInstruction?>" name="deliveryInstruction"></textarea>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>  
                        <button type="submit" class="btn btn-primary" name="add">Add</button>
                      <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </div>
</form>
                <form action="" method="post">
                    <div class="col-md-12">
                          <div class="mb-3">
                          <select class="form-select" name="addressID">
                                  <option value="addressID" selected="">Choose Existing Address</option>
                                  <?php

                                    $sql = "select * from address where Customer_ID = '$customerID'";
                                    $q = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($q)) {
                                        $addressID = $row['id'];
                                        $fName = $row['fName'];
                                        $lName = $row['lastName'];
                                        $address = $row['address1'];
                                        $city = $row['city'];
                                        $zipCode = $row['postalCode'];
                                        $states = $row['states'];
                                        $deliveryInstruction = $row['deliveryInstruction'];
                                        echo "<option value='$addressID'>$fName $lName, $address, $city, $zipCode, $states, $deliveryInstruction</option>";
                                    }


                                  ?>

                                </select>
                                
                          </div>
                            
                          <button type="submit" class="btn btn-primary" name="show">Show</button>
                        </div>
                        </div>
                    </div>
                                  </form>
                    <div class="card-footer text-end">
                        
                    </div>
                                </form>
                  
                </div>
                </div>
            </div>

<?php include './inc/footer.php'; ?>
```