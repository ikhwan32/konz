<?php include"../inc/dbconnect.php"; 

$productID = $_GET['id'];
$sql = "DELETE FROM product WHERE Product_ID = '$productID'";
$send = mysqli_query($conn, $sql);
if ($send) {
    echo "<script>alert('Product deleted successfully!')</script>";
    echo "<script>window.location.href='products.php'</script>";
} else {
    echo "<script>alert('Failed to delete product!')</script>";
    echo "<script>window.location.href='products.php'</script>";
}

?>