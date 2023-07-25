<?php include'inc/header.php'; 
$totalall ="";
$shipping = 10.00;

?>

<div class="card card-lg">
  <form action="addOrder.php" method="post">
                <div class="card-body">
                <div class="col-6">
                    <p class="h3">Address</p>
                    <select class="form-select" name="addressID">
                                  <option value="addressID" selected="">Choose Existing Address</option>
                                  <?php

                                    $sql = "select * from address where Customer_ID = '$_SESSION[username]'";
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
                  <div class="col-12 my-5">
                    <h1>Confirm Payment</h1>
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

                      $sql = "SELECT * FROM cart, product  WHERE cart.Customer_ID = '$_SESSION[username]' AND cart.Product_ID = product.Product_ID";
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

                    <input type="hidden" name="totalall" value="<?php echo $totalall + $shipping ?>">
                    <input type="hidden" name="customerid" value="<?php echo $_SESSION['username'] ?>">
                    <a href="index.php" class="btn btn-link text-muted">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="checkout">Confirm</button>
                    </form>
                </div>
                <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                  you again!</p>
              </div>
            </div>  


<?php include'inc/footer.php'; ?>