<?php include('inc/header.php'); 

$order = "";
$date = "";
$time = "";
$price = "";
$custID = "";
$status = "";
$err = "";


$order = $_GET['id'];

if (isset($_GET['editOrder'])) {
    $sql = "select * from orders where Order_ID = '$order'";
    $q = mysqli_query($conn, $sql);
    $r = mysqli_fetch_array($q);
    $order = $r['Order_ID'];
    $date = $r['Order_Date'];
    $time = $r['Order_Time'];
    $price = $r['Total_Price'];
    $custID = $r['Customer_ID'];
    $status = $r['status'];
}



if (isset($_POST['update'])) {
    $status = $_POST['status'];
    
    if (empty($err)){
    if(isset($_GET['editOrder'])){
        $sql = "UPDATE orders SET status = '$status' WHERE Order_ID = '$order'";
        $q = mysqli_query($conn, $sql);
        if ($q) {
            echo "<script>alert('Order updated!');window.location.href='orders.php';</script>";
        } else {
            echo "<script>alert('Failed to update order!');window.location.href='orders.php';</script>";
    }
    }}}

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
                  Update Order
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
                  <h3 class="card-title text-center">Update - <?php echo $err?></h3>
                </div>
                <div class="card-body">
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Username</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter username" name="username" disabled="" value="<?php echo $order;?>">
                      <small class="form-hint">A username that will be used to login to our system.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Name</label>
                    <div class="col">
                      <input type="text" class="form-control"placeholder="Enter name" name="name" disabled=""  value="<?php echo $date;?>">
                      <small class="form-hint">Preferably your full name, that will be used for postage. We'll never share your name with anyone else.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Phone Number</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter phone number" name="phoneNum" disabled=""  value="<?php echo $time;?>">
                      <small class="form-hint">Phone number for verifcation. We'll never share your phone number with anyone else.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Email address</label>
                    <div class="col">
                      <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email" disabled=""  value="<?php echo $price;?>">
                      <small class="form-hint">We'll never share your email with anyone else.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Email address</label>
                    <div class="col">
                      <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email" disabled=""  value="<?php echo $custID;?>">
                      <small class="form-hint">We'll never share your email with anyone else.</small>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label">Select Product</label>
                    <div class="col">
                        <select class="form-select" name="status">
                            <option value="Pending" <?php if($status == "Pending"){echo "selected";} ?>>Pending</option>
                            <option value="Processing" <?php if($status == "Processing"){echo "selected";} ?>>Processing</option>
                            <option value="Delivering" <?php if($status == "Delivering"){echo "selected";} ?>>Delivering</option>
                            <option value="Completed" <?php if($status == "Completed"){echo "selected";} ?>>Completed</option>
                            <option value="Cancelled" <?php if($status == "Cancelled"){echo "selected";} ?>>Cancelled</option>
                        </select>
                        <small class="form-hint">Select the status of the order.</small>
                </div>
                </div>

                <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
              </form>

<?php include('inc/footer.php'); ?>