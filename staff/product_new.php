<?php include('inc/header.php'); 

$productID ="";
$productName = "";
$productPrice = "";
$productQuantity = "";
$productNetWeight = "";
$err = "";

if (isset($_POST['register'])) {
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantity'];
    $productNetWeight = $_POST['netWeight'];

    



    $sql = "INSERT INTO product (Product_Name, Product_Price, Stock_Available, Product_NetWeight) VALUES ('$productName', '$productPrice', '$productQuantity', '$productNetWeight')";
    $q = mysqli_query($conn, $sql);
    if ($q) {
        $sql2 = "SELECT * FROM product WHERE Product_Name = '$productName'";
        $q2 = mysqli_query($conn, $sql2);
        $productID = mysqli_fetch_array($q2)['Product_ID'];

        $filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.jpg','.jpeg','.gif','image/png');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000))
	{	
		// Rename file
		$newfilename = $productID . $file_ext;
		if (file_exists("../dist/img/products/" . $newfilename))
		{
			// file already exists error
			unlink("../dist/img/products/" . $newfilename);
      move_uploaded_file($_FILES["file"]["tmp_name"], "../dist/img/products/" . $newfilename);
			echo "File uploaded successfully.";		
		}
		else
		{		
			move_uploaded_file($_FILES["file"]["tmp_name"], "../dist/img/products/" . $newfilename);
			echo "File uploaded successfully.";		
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Please select a file to upload.";
	} 
	elseif ($filesize > 5000000)
	{	
		// file size error
		echo "The file you are trying to upload is too large.";
	}
	else
	{
		// file type error
		echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($_FILES["file"]["tmp_name"]);
	}



        echo "<script>window.location.href='products.php';</script>";
    } else {
        $err = "Failed to add product";
    }
}

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
                  Add New Product
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

<form class="card" action="" method="post" enctype="multipart/form-data">
                <div class="card-header">
                  <h3 class="card-title text-center">New Product - <?php echo $err?></h3>
                </div>
                <div class="card-body">
 
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product Name</label>
                    <div class="col">
                      <input type="text" class="form-control"placeholder="Enter name" name="name" value="">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product Net Weight</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter net weight" name="netWeight" value="">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product Price</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="price" name="price" value="">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product Quantity</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="quantity" name="quantity" value="">
                    </div>
                  </div>
                  <div class="mb-3">
                            <div class="form-label">Upload Image</div>
                            <input type="file" name="file" class="form-control" />
                          </div>

                <div class="card-footer text-end">
                <a href="products.php" class="btn btn-primary">Go Back</a>
                  <button type="submit" class="btn btn-primary" name="register">Submit</button>
                </div>
              </form>

<?php include('inc/footer.php'); ?>