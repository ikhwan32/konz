<?php include"../inc/dbconnect.php"; 


if (isset($_GET['deleteCust'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM customer WHERE Customer_ID = '$id'";
    $send = mysqli_query($conn, $sql);
    if ($send) {
        echo "<script>alert('Customer deleted successfully!')</script>";
        echo "<script>window.location.href='users.php'</script>";
    } else {
        echo "<script>alert('Failed to delete customer!')</script>";
        echo "<script>window.location.href='users.php'</script>";
    }
}

if (isset($_GET['deleteStaff'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM staff WHERE Staff_ID = '$id'";
    $send = mysqli_query($conn, $sql);
    if ($send) {
        echo "<script>alert('Staff deleted successfully!')</script>";
        echo "<script>window.location.href='users.php'</script>";
    } else {
        echo "<script>alert('Failed to delete staff!')</script>";
        echo "<script>window.location.href='users.php'</script>";
    }
}

?>