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
                  Home
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
                
              <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php 

                              $sql = "SELECT SUM(TOTAL_PRICE) FROM orders";
                              $sendsql = mysqli_query($conn, $sql);
                              if ($sendsql) {
                                  foreach ($sendsql as $row) {
                                      $total = $row['SUM(TOTAL_PRICE)'];
                                      echo "RM " . $total;
                                  }
                              }

                              ?>
                            </div>
                            <div class="text-muted">
                              for past 30 days
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php

                              $sql = "SELECT COUNT(Order_ID) FROM orders";
                              $sendsql = mysqli_query($conn, $sql);
                              if ($sendsql) {
                                  foreach ($sendsql as $row) {
                                      $total = $row['COUNT(Order_ID)'];
                                      echo $total;
                                  }
                              }


                              ?>
                              Orders
                            </div>
                            <div class="text-muted">
                              <?php

                              $sql = "SELECT COUNT(status) FROM orders WHERE status != 'Delivering' AND status != 'Completed'";
                              $sendsql = mysqli_query($conn, $sql);
                              if ($sendsql) {
                                  foreach ($sendsql as $row) {
                                      $total = $row['COUNT(status)'];
                                      echo $total;
                                  }
                              }

                              ?>

                              Processing
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg> </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php

                              $sql = "SELECT COUNT(Customer_ID) FROM customer";
                              $sendsql = mysqli_query($conn, $sql);
                              if ($sendsql) {
                                  foreach ($sendsql as $row) {
                                      $total = $row['COUNT(Customer_ID)'];
                                      echo $total;
                                  }
                              }

                              ?>
                              Customer  
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              

              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h1>Latest Order</h1>
                            </div>
              <div class="card-body">
                
           
              <table id="orderHome" class="display">
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

                      $sql = "SELECT * FROM orders WHERE status != 'Delivering' AND status != 'Completed' ORDER BY Order_ID DESC LIMIT 5";
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
            <div class="card">
              <div class="card-header">
                <h1>Latest Message</h1>
                            </div>
              <div class="card-body">
                
           
              <table id="cust" class="display">
                    <thead>
                      <tr>
                        <th>Message ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    <?php

                      $sql = "SELECT * FROM contact ";
                      $sendsql = mysqli_query($conn, $sql);
                      if ($sendsql) {
                      foreach ($sendsql as $row) {
                        echo "<tr>";
                        echo "<td>", $row["id"], "</td>";
                        echo "<td>", $row["name"], "</td>";
                        echo "<td>", $row["email"], "</td>";
                        echo "<td>", $row["subject"], "</td>";
                        echo "<td>", $row["message"], "</td>";
                       
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