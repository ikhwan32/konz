<?php include('inc/header.php'); 

$productID = $_GET['id'];
$productName = "";
$productPrice = "";
$productQuantity = "";
$productNetWeight = "";
$err = "";




if (isset($_GET['editProduct'])) {
    $sql = "select * from product where Product_ID = '$productID'";
    $q = mysqli_query($conn, $sql);
    $r = mysqli_fetch_array($q);
    $productID = $r['Product_ID'];
    $productName = $r['Product_Name'];
    $productPrice = $r['Product_Price'];
    $productQuantity = $r['Stock_Available'];
    $productNetWeight = $r['Product_NetWeight'];
}


if (isset($_POST['update'])) {
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantity'];
    $productNetWeight = $_POST['netWeight'];

  $filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
  $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	$allowed_file_types = array('.jpg','.jpeg','.gif','.png', '.JPG', '.JPEG', '.GIF', '.PNG');	
//in_array($file_ext,$allowed_file_types) && ($filesize < 200000)
	if ($filesize < 5000000)
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
	elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" )
	{
		// file type error
		echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($_FILES["file"]["tmp_name"]);
	}

    $sql = "UPDATE product SET Product_Name = '$productName', Product_Price = '$productPrice', Stock_Available = '$productQuantity', Product_NetWeight = '$productNetWeight' WHERE Product_ID = '$productID'";
    $q = mysqli_query($conn, $sql);
    if ($q) {
      echo "<script>window.location.href='products.php';</script>";
    } else {
        $err = "Failed to update product";
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
                  Edit Existing Product
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

<form class="card" action="" method="post"  enctype="multipart/form-data">
                <div class="card-header">
                  <h3 class="card-title text-center">Update - <?php echo $err?></h3>
                </div>
                <div class="card-body">
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product ID</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter username" name="prodID" value="<?php echo $productID;?>" disabled>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product Name</label>
                    <div class="col">
                      <input type="text" class="form-control"placeholder="Enter name" name="name" value="<?php echo $productName;?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product Net Weight</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Enter net weight" name="netWeight" value="<?php echo $productNetWeight;?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product Price</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="price" name="price" value="<?php echo $productPrice;?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Product Quantity</label>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="quantity" name="quantity" value="<?php echo $productQuantity;?>">
                    </div>
                  </div>
                  <div class="mb-3">
                            <div class="form-label">Upload Image</div>
                            <input type="file" name="file" class="form-control" />
                          </div>

                <div class="card-footer text-end">
                <a href="products.php" class="btn btn-primary">Go Back</a>
                  <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
              </form>

<?php include('inc/footer.php'); ?>