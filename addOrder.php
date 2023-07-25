<?php include './inc/dbconnect.php';?>
<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

$sql = "SELECT * FROM customer WHERE Customer_ID = '$_SESSION[username]'";
$sendsql = mysqli_query($conn, $sql);
if ($sendsql) {
    foreach ($sendsql as $row) {
        $customerid = $row['Customer_ID'];
        $name = $row['Customer_Name'];
        $email = $row['Customer_Email'];
        $phone = $row['Customer_ContactNum'];
    }
}

if (isset($_POST['checkout'])) {
    $totalall = $_POST['totalall'];
    $customerid = $_POST['customerid'];
    $addressID = $_POST['addressID'];
    
}
echo $addressID;

if (isset($_POST['pay'])) {
    if ($_POST['paymentOutput'] == "success") {
    $customerid = $_POST['customerid'];
    $addressID = $_POST['addressID'];
    $totalall = $_POST['totalall'];
        $sql = "INSERT INTO orders (Order_Date, Order_Time, Total_Price, Customer_ID, addressID, status) VALUES (NOW(), NOW(), '$totalall', '$customerid', '$addressID', 'Pending')";
        $sendsql = mysqli_query($conn, $sql);
    if ($sendsql) {
        $sql = "SELECT * FROM orders WHERE Customer_ID = '$customerid' ORDER BY Order_ID DESC LIMIT 1";
        $sendsql = mysqli_query($conn, $sql);
        if ($sendsql) {
            foreach ($sendsql as $row) {
                $orderid = $row['Order_ID'];
            }
        }
        $sql = "SELECT * FROM cart WHERE Customer_ID = '$customerid'";
        $sendsql = mysqli_query($conn, $sql);
        if ($sendsql) {
            foreach ($sendsql as $row) {
                $productid = $row['Product_ID'];
                $quantity = $row['quantity'];
                $sql = "INSERT INTO orders_details (Order_ID, Product_ID, Quantity) VALUES ('$orderid', '$productid', '$quantity')";
                $sendsql = mysqli_query($conn, $sql);
  
                if ($sendsql) {
                    $sql = "DELETE FROM cart WHERE Customer_ID = '$customerid'";
                    $sendsql = mysqli_query($conn, $sql);
                    if ($sendsql) {
                        echo "<script>alert('Order placed!');window.location.href='orders.php';</script>";
                    } else {
                        echo "<script>alert('Failed to place order!');window.location.href='index.php';</script>";
                    }
                } else {
                    echo "<script>alert('Failed to place order!');window.location.href='index.php';</script>";
                }
            }
            $sql2 = "SELECT * FROM product WHERE Product_ID = '$productid'";
            $sendsql2 = mysqli_query($conn, $sql2);
            if ($sendsql2) {
                foreach ($sendsql2 as $row2) {
                    $stock = $row2['Stock_Available'];
                    $stock = $stock - $quantity;
                    $sql3 = "UPDATE product SET Stock_Available = '$stock' WHERE Product_ID = '$productid'";
                    $sendsql3 = mysqli_query($conn, $sql3);
                }
            }
        } else {
            echo "<script>alert('Failed to place order!');window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Failed to place order!');window.location.href='index.php';</script>";
    }
    }
    elseif ($_POST['paymentOutput'] == "failed") {
        echo "<script>alert('Payment Failed!');window.location.href='checkout.php';</script>";
    }
    else {
        echo "<script>alert('Payment Failed!');window.location.href='checkout.php';</script>";
    }
}
/*
if (isset($_POST['checkout'])) {
    $totalall = $_POST['totalall'];
    $customerid = $_POST['customerid'];
    $addressID = $_POST['addressID'];
    $sql = "INSERT INTO orders (Order_Date, Order_Time, Total_Price, Customer_ID, addressID, status) VALUES (NOW(), NOW(), '$totalall', '$customerid', '$addressID', 'Unpaid')";
    $sendsql = mysqli_query($conn, $sql);
    if ($sendsql) {
        $sql = "SELECT * FROM orders WHERE Customer_ID = '$customerid' ORDER BY Order_ID DESC LIMIT 1";
        $sendsql = mysqli_query($conn, $sql);
        if ($sendsql) {
            foreach ($sendsql as $row) {
                $orderid = $row['Order_ID'];
            }
        }
        $sql = "SELECT * FROM cart WHERE Customer_ID = '$customerid'";
        $sendsql = mysqli_query($conn, $sql);
        if ($sendsql) {
            foreach ($sendsql as $row) {
                $productid = $row['Product_ID'];
                $quantity = $row['quantity'];
                $sql = "INSERT INTO orders_details (Order_ID, Product_ID, Quantity) VALUES ('$orderid', '$productid', '$quantity')";
                $sendsql = mysqli_query($conn, $sql);
  
                if ($sendsql) {
                    $sql = "DELETE FROM cart WHERE Customer_ID = '$customerid'";
                    $sendsql = mysqli_query($conn, $sql);
                    if ($sendsql) {
                        echo "<script>alert('Order placed!');</script>";
                    } else {
                        echo "<script>alert('Failed to place order!');window.location.href='index.php';</script>";
                    }
                } else {
                    echo "<script>alert('Failed to place order!');window.location.href='index.php';</script>";
                }
            }
            $sql2 = "SELECT * FROM product WHERE Product_ID = '$productid'";
            $sendsql2 = mysqli_query($conn, $sql2);
            if ($sendsql2) {
                foreach ($sendsql2 as $row2) {
                    $stock = $row2['Stock_Available'];
                    $stock = $stock - $quantity;
                    $sql3 = "UPDATE product SET Stock_Available = '$stock' WHERE Product_ID = '$productid'";
                    $sendsql3 = mysqli_query($conn, $sql3);
                }
            }
        } else {
            echo "<script>alert('Failed to place order!');window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Failed to place order!');window.location.href='index.php';</script>";
    }
}*/
?>
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Payment</title>
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
            Payment
        </div>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Payment</h2>
            <form action="" method="post" autocomplete="off" novalidate>
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="" autocomplete="off" value="<?php echo $name?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" placeholder="your@email.com" autocomplete="off" value="<?php echo $phone?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="your@email.com" autocomplete="off" value="<?php echo $email?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Card Number</label>
                <input type="text" name="input-mask" class="form-control" data-mask="0000/0000/0000/0000" data-mask-visible="true" placeholder="0000/0000/0000/0000"autocomplete="off"/>
              </div>
              <div class="mb-3">
                <label class="form-label">CVV</label>
                <input type="text" name="input-mask" class="form-control" data-mask="000" data-mask-visible="true" placeholder="000"autocomplete="off"/>
              </div>
              <div class="mb-3">
                            <label class="form-label">Expired Year</label>
                            <input type="text" name="input-mask" class="form-control" data-mask="00/0000" data-mask-visible="true" placeholder="00/0000"autocomplete="off"/>
                          </div>
              <div class="mb-3">
                <label class="form-label">Amount</label>
                <input type="text" class="form-control" placeholder="your@email.com" autocomplete="off" value="RM  <?php echo $totalall?>" disabled>
              </div> 
              <input type="hidden" name="customerid" value="<?php echo $customerid?>">
                <input type="hidden" name="addressID" value="<?php echo $addressID?>">
                <input type="hidden" name="totalall" value="<?php echo $totalall?>">

              <select class="form-select" name="paymentOutput">
                                  <option value="success" selected="">Payment Success</option>
                                  <option value="failed" selected="">Payment Failed</option>

                                </select>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100" name="pay">Pay Now</button>
              </div>
            </form>
          </div>

        </div>

      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
