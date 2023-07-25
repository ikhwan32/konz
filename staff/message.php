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
                  Message
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
                        <th>Message ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    <?php

                      $sql = "SELECT * FROM contact";
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