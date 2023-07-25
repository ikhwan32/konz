<?php include('inc/header.php'); 
$totalall ="";
$shipping = 10.00;

if (isset($_POST['increase'])) {
    $productid = $_POST['productid'];
    $customerid = $_POST['customerid'];
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE Product_ID = '$productid' AND Customer_ID = '$customerid'";
    $sendsql = mysqli_query($conn, $sql);
    if ($sendsql) {
        echo "<script>alert('Added to cart!')</script>";
        echo "<script>window.location.href='cart.php'</script>";
    }
}

if (isset($_POST['decrease'])) {
    $productid = $_POST['productid'];
    $customerid = $_POST['customerid'];
    $sql = "UPDATE cart SET quantity = quantity - 1 WHERE Product_ID = '$productid' AND Customer_ID = '$customerid'";
    
    $sendsql = mysqli_query($conn, $sql);

    if ($sendsql) {
        echo "<script>alert('Removed from cart!')</script>";
        echo "<script>window.location.href='cart.php'</script>";
    }
    $quantity = "SELECT quantity FROM cart WHERE Product_ID = '$productid' AND Customer_ID = '$customerid'";
    $sendquantity = mysqli_query($conn, $quantity);
    $row = mysqli_fetch_array($sendquantity);
    $qty = $row['quantity'];
    if ($qty == 0) {
        $sql = "DELETE FROM cart WHERE Product_ID = '$productid' AND Customer_ID = '$customerid'";
        $sendsql = mysqli_query($conn, $sql);
        if ($sendsql) {
            echo "<script>alert('Removed fully from cart!')</script>";
            echo "<script>window.location.href='cart.php'</script>";
        }
    }
}

?>


                <div class="card card-lg">
                <div class="card-body">
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
                        echo "<td class='text-center'><a href='removeCart.php?productid=".$row['Product_ID']."&customerid=".$_SESSION['username']."'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-x' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path>
                        <path d='M18 6l-12 12'></path>
                        <path d='M6 6l12 12'></path></a>
                     </svg></td>";
                        echo "<td> <p class='strong mb-1'>", $row["Product_Name"], "</p><div class='text-muted'>", $row["Product_NetWeight"], "KG</div></td>";
                        echo "<td class = 'text-center'> 
                                <form action='' method='post'>
                                <input type='hidden' name='productid' value='", $row["Product_ID"], "'>
                                <input type='hidden' name='customerid' value='", $row["Customer_ID"], "'>
                                <div class='input-group mb-2'>
                                <button class='btn' type='submit' name='decrease'>-</button>
                                <input type='text' class='form-control' value='", $quantity = $row["quantity"], "'>
                                <button class='btn' type='submit' name='increase'>+</button>
                              </div>
                              </form>";
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
                    <form action="checkout.php" method="post">
                    <input type="hidden" name="totalall" value="<?php echo $totalall + $shipping ?>">
                    <input type="hidden" name="customerid" value="<?php echo $_SESSION['username'] ?>">
                    <a href="index.php" class="btn btn-link text-muted">Cancel</a>
                    <a href="checkout.php" type="submit" class="btn btn-primary" name="checkout">Checkout</a>
                    </form>
                </div>
                <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                  you again!</p>
              </div>
            </div>  
 

<?php include('inc/footer.php'); ?>
