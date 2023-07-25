<?php
include('inc/header.php');

if (isset($_POST['add'])) {
  $productid = $_POST['productid'];
  $customerid = $_POST['customerid'];

  $checkcart = "SELECT * FROM cart WHERE Product_ID = '$productid' AND Customer_ID = '$customerid'";
  $sendcheckcart = mysqli_query($conn, $checkcart);
  $row = mysqli_fetch_array($sendcheckcart);
  $count = mysqli_num_rows($sendcheckcart);
  if ($count > 0) {
    $addtocart = "UPDATE cart SET quantity = quantity + 1 WHERE Product_ID = '$productid' AND Customer_ID = '$customerid'";
    $sendaddtocart = mysqli_query($conn, $addtocart);
    if ($sendaddtocart) {
      echo "<script>alert('Added to cart!')</script>";
      echo "<script>window.location.href='products.php'</script>";
    } else {
      echo "<script>alert('Failed to add product to cart!')</script>";
    }
  } else {
    $addtocart = "INSERT INTO cart (Product_ID, Customer_ID, quantity) VALUES ('$productid', '$customerid','1')";
    $sendaddtocart = mysqli_query($conn, $addtocart);
    if ($sendaddtocart) {
      echo "<script>alert('Added product to cart!')</script>";
    } else {
      echo "<script>alert('Failed to add product to cart!')</script>";
    }

  }

}

?>


<?php

$sql = "SELECT * FROM product";
$sendsql = mysqli_query($conn, $sql);

if ($sendsql) {
foreach ($sendsql as $row) {
  if (isset($_SESSION['username'])){
  echo "<div class='col-lg-6'>
  <div class='card'>
  <div class='row row-0'>
  <div class='col-3'>
    <!-- Photo -->
    <img src='./dist/img/products/".$row['Product_ID'].".jpg' class='w-100 h-100 object-cover card-img-start'/>
  </div>
        <div class='col'>
          <div class='card-body'>
            <h3 class='card-title'>".$row['Product_Name']."</h3>
            <p class='text-muted'>Product Net Weight : ".$row['Product_NetWeight']." KG</p>
            <p class='text-muted'>Stock Left : ".$row['Stock_Available']." PCS</p>
            <p class='text-muted'>Price : RM ".$row['Product_Price']."</p>
            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
              <form action='' method='post'>
              <input type='hidden' name='customerid' value='".$_SESSION['username']."'>
              <input type='hidden' name='productid' value='".$row['Product_ID']."'>
              <button class='btn btn-primary me-md-2' type='submit' name='add'>Add to Cart</button>
              </form>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>";

    }
    else {
      echo "<div class='col-lg-6'>
  <div class='card'>
  <div class='row row-0'>
  <div class='col-3'>
    <!-- Photo -->
    <img src='./dist/img/products/".$row['Product_ID'].".jpg' class='w-100 h-100 object-cover card-img-start'/>
  </div>
        <div class='col'>
          <div class='card-body'>
            <h3 class='card-title'>".$row['Product_Name']."</h3>
            <p class='text-muted'>Product Net Weight : ".$row['Product_NetWeight']." KG</p>
            <p class='text-muted'>Stock Left : ".$row['Stock_Available']." PCS</p>
            <p class='text-muted'>Price : RM ".$row['Product_Price']."</p>
            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
              <form action='' method='post'>
              <button class='btn btn-primary me-md-2 disabled' type='submit' name='add'>Login First</button>
              </form>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>";
    }
  }
}


?>
               
                
<?php
include('inc/footer.php');
?>