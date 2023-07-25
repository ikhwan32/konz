<?php include('inc/header.php'); ?>
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Product
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="product_new.php" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Add New Product
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
        <div class="container-xl">
        <div class="card">
              <div class="card-body">
                
              <table id="product" class="display">
                    <thead>
                      <tr>
                        <td>Product ID</td>
                        <td>Product Name</td>
                        <td>Product Price</td>
                        <td>Product Quantity</td>
                        <td>Product Net Weight</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    <?php

                      $sql = "SELECT * FROM product";
                      $sendsql = mysqli_query($conn, $sql);
                      if ($sendsql) {
                      foreach ($sendsql as $row) {
                        echo "<tr>";
                        echo "<td>", $row["Product_ID"], "</td>";
                        echo "<td>", $row["Product_Name"], "</td>";
                        echo "<td>RM ", $row["Product_Price"], "</td>";
                        echo "<td>", $row["Stock_Available"], " PCS</td>";
                        echo "<td>", $row["Product_NetWeight"], " KG</td>";
                        echo "<td><div class='btn-list flex-nowrap'><form action='product_update.php' method='get'><input type='hidden' name='id' value='".$row['Product_ID']."'><input type='submit' class='btn btn-info' name='editProduct' value='Update'></form>";
                        echo "<form action='product_delete.php' method='get'><input type='hidden' name='id' value='".$row['Product_ID']."'><input type='submit' class='btn btn-danger' name='deleteProduct' value='Delete'></form></div></td>";
                        echo "</tr>";
                          }
                        }

                      ?>
                    </tbody>
                  </table>
              </div>
            </div>
<?php include('inc/footer.php'); ?>