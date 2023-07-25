<?php include './inc/header.php';?>

<div class="card">
              
                <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                  <div class="card-body">
                    <h4 class="subheader">Account settings</h4>
                    <div class="list-group list-group-transparent">
                      <a href="./profile.php" class="list-group-item list-group-item-action d-flex align-items-center">My Account</a>
                      <a href="./orders.php" class="list-group-item list-group-item-action d-flex align-items-center active">My Orders</a>
                      <a href="./address.php" class="list-group-item list-group-item-action d-flex align-items-center">Address Book</a>
                    </div>
                    <h4 class="subheader mt-4">MISC</h4>
                    <div class="list-group list-group-transparent">
                      <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column">
                <div class="card-body">
              <table id="order" class="display">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    <?php

                      $sql = "SELECT * FROM orders WHERE Customer_ID = '$_SESSION[username]' ORDER BY Order_ID DESC";
                      $sendsql = mysqli_query($conn, $sql);
                      if ($sendsql) {
                      foreach ($sendsql as $row) {
                        echo "<tr>";
                        echo "<td>", $row["Order_ID"], "</td>";
                        echo "<td>", $row["Order_Date"], "</td>";
                        echo "<td>", $row["Order_Time"], "</td>";
                        echo "<td>", $row["Total_Price"], "</td>";
                        echo "<td>", $row["status"], "</td>";
                        echo "<td><div class='btn-list flex-nowrap'><form action='vieworder.php' method='get'><input type='hidden' name='id' value='".$row['Order_ID']."'><input type='submit' class='btn btn-primary' name='viewOrder' value='View'></form><form action='order_update.php' method='get'><input type='hidden' name='id' value='".$row['Order_ID']."'></form>";
                        echo "</div></td>";

                        echo "</tr>";
                          }
                        }

                      ?>
                    </tbody>
                  </table>
                  </div>
              </div>
            </div>

<?php include './inc/footer.php';?>