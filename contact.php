<?php
include('inc/header.php');
if (isset($_SESSION['username'])) {
  $id = $_SESSION['username'];
  $sql = "SELECT * FROM customer WHERE Customer_ID = '$id'";
  $sendsql = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($sendsql);
  $customerName = $row['Customer_Name'];
  $customerEmail = $row['Customer_Email'];
}




if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    echo $username;
    echo $email;


    $sql = "INSERT INTO contact (email, name, subject, message) VALUES ('$email', '$username', '$subject', '$message')";
    $q = mysqli_query($conn, $sql);
    if ($q) {
        echo "<script>alert('Your message has been sent.');</script>";
    } else {
        echo "<script>alert('Your message has not been sent.');</script>";
    }
}

?>

              <?php

if (isset($_SESSION['username'])) {
  echo "
                <div class='card-body'>

              <form class='card' action='' method='post'>
                <div class='card-header'>
                  <h3 class='card-title'>Contact form</h3>
                </div>
                <div class='card-body'>
                  <div class='mb-3 row'>
                    <label class='col-3 col-form-label required'>Name</label>
                    <div class='col'>
                      <input type='text' class='form-control' value='"; 
                      echo $customerName; 
                      echo "' placeholder='Enter email' name='username'>
                    </div>
                  </div>
                  <div class='mb-3 row'>
                    <label class='col-3 col-form-label required'>Email</label>
                    <div class='col'>
                      <input type='email' class='form-control' value='";
                      echo $customerEmail; 
                      echo "' placeholder='Enter email' name='email'>
                    </div>
                  </div>
                    <div class='mb-3 row'>
                        <label class='col-3 col-form-label required'>Subject</label>
                        <div class='col'>
                        <input type='text' class='form-control' placeholder='Subject'  name='subject'>
                        </div>
                    </div>
                    <div class='mb-3 row'>
                        <label class='col-3 col-form-label required'>Message</label>
                        <div class='col'>
                        <textarea class='form-control' rows='3' placeholder='Message'  name='message'></textarea>
                        </div>

                        </div>
                <div class='card-footer text-end'>
                  <button type='submit' class='btn btn-primary' name='submit'>Submit</button>
                </div>

              </form>
            </div>


  ";
} else {
  echo "
  <div class='page page-center'>
      <div class='container-tight py-4'>
        <div class='empty'>
          <div class='empty-header'>404</div>
          <p class='empty-title'>Oops… You are not logged in yet</p>
          <p class='empty-subtitle text-muted'>
            We are sorry but the page you are looking for required you to login first
          </p>
          <div class='empty-action'>
            <a href='./index.php' class='btn btn-primary'>
              <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
              <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M5 12l14 0' /><path d='M5 12l6 6' /><path d='M5 12l6 -6' /></svg>
              Take me home
            </a>
          </div>
        </div>
      </div>
    </div>
  ";
}
?>
<?php
include('inc/footer.php');
?>