<?php 
include './inc/dbconnect.php';

$productid = $_GET['productid'];
$customerid = $_GET['customerid'];
$sql = "DELETE FROM cart WHERE Product_ID = '$productid' AND Customer_ID = '$customerid'";
$sendsql = mysqli_query($conn, $sql);
if ($sendsql) {
    echo "<script>alert('Item removed from cart!');window.location.href='cart.php';</script>";
} else {
    echo "<script>alert('Failed to remove item from cart!');window.location.href='cart.php';</script>";
}

?>