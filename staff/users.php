<?php include('inc/header.php'); ?>

<?php

if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  echo $id;
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
                  Manage User
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="user_new.php" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Add New User
                  </a>
                  <a href="staff_new.php" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Add New Staff
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
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#tabs-customer-5" class="nav-link active" data-bs-toggle="tab">Customer</a>
                      </li>
                      <li class="nav-item">
                        <a href="#tabs-staff-5" class="nav-link" data-bs-toggle="tab">Staff</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active show" id="tabs-customer-5">
                        <h4>Manage Customer</h4>

                  <table id="cust" class="display">
                    <thead>
                      <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    <?php

                      $sql = "SELECT * FROM customer";
                      $sendsql = mysqli_query($conn, $sql);
                      if ($sendsql) {
                      foreach ($sendsql as $row) {
                        echo "<tr>";
                        echo "<td>", $row["Customer_ID"], "</td>";
                        echo "<td>", $row["Customer_Name"], "</td>";
                        echo "<td>", $row["Customer_ContactNum"], "</td>";
                        echo "<td>", $row["Customer_Email"], "</td>";
                        echo "<td><div class='btn-list flex-nowrap'><form action='user_edit.php' method='get'><input type='hidden' name='id' value='".$row['Customer_ID']."'><input type='submit' class='btn btn-info' name='editCust' value='Edit'></form>";
                        echo "<form action='user_delete.php' method='get'><input type='hidden' name='id' value='".$row['Customer_ID']."'><input type='submit' class='btn btn-danger' name='deleteCust' value='Delete'></form></div></td>";

                        echo "</tr>";
                          }
                        }

                      ?>
                    </tbody>
                  </table>

                      </div>
                      <div class="tab-pane" id="tabs-staff-5">
                        <h4>Manage Staff</h4>

                  <table id="staff" class="display">
                  <thead>
                      <tr>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Product ID Managed</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    <?php

                      $sql = "SELECT * FROM staff";
                      $sendsql = mysqli_query($conn, $sql);
                      if ($sendsql) {
                      foreach ($sendsql as $row) {
                        echo "<tr>";
                        echo "<td>", $row["Staff_ID"], "</td>";
                        echo "<td>", $row["Staff_Name"], "</td>";
                        echo "<td>", $row["Staff_ContactNum"], "</td>";
                        echo "<td>", $row["Staff_Email"], "</td>";
                        echo "<td>", $row["Product_ID"], "</td>";
                        echo "<td><div class='btn-list flex-nowrap'><form action='user_edit.php' method='get'><input type='hidden' name='id' value='".$row['Staff_ID']."'><input type='submit' class='btn btn-info' name='editStaff' value='Edit'></form>";
                        echo "<form action='user_delete.php' method='get'><input type='hidden' name='id' value='".$row['Staff_ID']."'><input type='submit' class='btn btn-danger' name='deleteStaff' value='Delete'></form></div></td>";
                        echo "</tr>";
                          }
                        }

                      ?>
                    </tbody>
                  </table>

                    </div>
                    </div>
                  </div>
                </div>
              
<?php include('inc/footer.php'); ?>