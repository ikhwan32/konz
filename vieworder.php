<?php include './inc/header.php';

$orderID = $_GET['id'];
$totalall ="";
$shipping = "";
$addressID = "";

$sql = "SELECT * FROM orders WHERE Order_ID = '$orderID'";
$sendsql = mysqli_query($conn, $sql);
if ($sendsql) {
    foreach ($sendsql as $row) {
        $date = $row['Order_Date'];
        $addressID = $row['addressID'];
    }
    
}

$phoneNum = "";
$sql3 = "SELECT * FROM customer WHERE Customer_ID = '$_SESSION[username]'";
$sendsql3 = mysqli_query($conn, $sql3);
if ($sendsql3) {
    foreach ($sendsql3 as $row) {
        $phoneNum = $row['Customer_ContactNum'];
    }
}


$fname = "";
$lname = "";
$address = "";
$city = "";
$state = "";
$zip = "";
$deliveryInstruction = "";

$sql2 = "SELECT * FROM address WHERE id = '$addressID'";
$sendsql2 = mysqli_query($conn, $sql2);
if ($sendsql2) {
    foreach ($sendsql2 as $row) {
        $fname = $row['fName'];
        $lname = $row['lastName'];
        $address = $row['address1'];
        $city = $row['city'];
        $state = $row['states'];
        $zip = $row['postalCode'];
        $deliveryInstruction = $row['deliveryInstruction'];
    }
}

?>
<div class="col-auto ms-auto d-print-none">
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                  <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                  Print Invoice
                </button>
              </div>

<div class="card card-lg">
                <div class="card-body">
                <div class="col-6">
                    <p class="h3"><?php echo $fname ." ". $lname; ?></p>
                    <address>
                      <?php echo $address?><br>
                      <?php echo $city . ", " .$state?><br>
                      <?php echo $zip . ", " .$city?><br>
                      <?php echo $phoneNum?><br>
                    </address>
                  </div>
                  <div class="col-12 my-5">
                    <h3>Date : <?php echo $date?></h1>
                  </div>
                  <div class="col-12 my-5">
                    <h1>Receipt KR-<?php echo $orderID?></h1>
                  </div>
                
                <table class="table table-transparent table-responsive">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 1%"></th>
                      <th>Product</th>
                      <th class="text-center" style="width: 13%">Quantity</th>
                      <th class="text-end" style="width: 2%">Price (RM)</th>
                      <th class="text-end" style="width: 4%">Amount (RM)</th>    
                    </tr>
                  </thead>
                    <tr>
                    <?php

                      $sql = "SELECT * FROM orders_details, product  WHERE orders_details.Order_ID = '$orderID' AND orders_details.Product_ID = product.Product_ID";
                      $sendsql = mysqli_query($conn, $sql);
                      if ($sendsql) {
                      foreach ($sendsql as $row) {
                        echo "<tr>";
                        echo "<td class='text-center'></td>";
                        echo "<td> <p class='strong mb-1'>", $row["Product_Name"], "</p><div class='text-muted'>", $row["Product_NetWeight"], "KG</div></td>";
                        echo "<td class = 'text-center'>", $quantity = $row["quantity"], "</td>";
                        echo "<td class = 'text-end'>", $price = $row["Product_Price"], "</td>";
                        echo "<td class = 'text-end'>", number_format($price * $quantity, 2, ".", ","), "</td>";
                        $totalall = (float)$totalall + $price * $quantity;
                        echo "</tr>";
                          }
                        }

                      ?>
                    </tr>
            
                  <tr>
                    <td colspan="4" class="strong text-end">Subtotal</td>
                    <td class="text-end"><?php echo number_format((float)$totalall, 2, ".", ",")?></td>
                  </tr>
                  <tr>
                    <td colspan="4" class="strong text-end">Shipping</td>
                    <td class="text-end"><?php echo number_format((float)$shipping, 2, ".", ",")?></td>
                  </tr>
                  <tr>
                    <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                    <td colspan="5" class="font-weight-bold text-end"><?php echo number_format((float)$totalall + (float)$shipping,2, ".", ",")?></td>
                  </tr>

                </table>
                <div class="text-end">
                    <a href="orders.php" class="btn btn-link text-muted">Go Back</a>
                </div>
                <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                  you again!</p>
              </div>
            </div> 

<?php include './inc/footer.php';?>