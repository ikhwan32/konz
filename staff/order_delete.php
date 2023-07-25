<?php include"../inc/dbconnect.php"; 

if (isset($_GET['deleteOrder'])) {
    $id = $_GET['id'];
    $sql = "delete from orders where Order_ID = '$id'";
    $q = mysqli_query($conn, $sql);
    if ($q) {
        echo "<script>alert('Order deleted!');window.location.href='orders.php';</script>";
    } else {
        echo "<script>alert('Failed to delete order!');window.location.href='orders.php';</script>";
    }
}

?>