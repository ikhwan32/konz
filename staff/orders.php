<?php
include('inc/header.php');
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
                  Order
                </h2>
              </div>
              <!-- Page title actions -->
            
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
        <div class="container-xl">
            <div class="card">
              <div class="card-body">
                
              <table id="cust" class="display">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Customer ID</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    <?php

                      $sql = "SELECT * FROM orders";
                      $sendsql = mysqli_query($conn, $sql);
                      if ($sendsql) {
                      foreach ($sendsql as $row) {
                        echo "<tr>";
                        echo "<td>", $row["Order_ID"], "</td>";
                        echo "<td>", $row["Order_Date"], "</td>";
                        echo "<td>", $row["Order_Time"], "</td>";
                        echo "<td>", $row["Total_Price"], "</td>";
                        echo "<td>", $row["Customer_ID"], "</td>";
                        echo "<td>", $row["status"], "</td>";
                        echo "<td><div class='btn-list flex-nowrap'><form action='order_view.php' method='get'><input type='hidden' name='id' value='".$row['Order_ID']."'><input type='submit' class='btn btn-primary' name='viewOrder' value='View'></form><form action='order_update.php' method='get'><input type='hidden' name='id' value='".$row['Order_ID']."'><input type='submit' class='btn btn-info' name='editOrder' value='Update'></form>";
                        echo "<form action='order_delete.php' method='get'><input type='hidden' name='id' value='".$row['Order_ID']."'><input type='submit' class='btn btn-danger' name='deleteOrder' value='Delete'></form></div></td>";

                        echo "</tr>";
                          }
                        }

                      ?>
                    </tbody>
                  </table>
              </div>
            </div>

<?php
include('inc/footer.php');
?>