<?php
session_start();
include("./inc/dbconnect.php");

$totalItemInCart = "";

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $sql = "SELECT SUM(quantity) AS totalItemInCart FROM cart WHERE Customer_ID = '$username'";
  $q = mysqli_query($conn, $sql);
  $totalItemInCart = mysqli_fetch_array($q)['totalItemInCart'];
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Kuih Raya Onz - </title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <script src="./dist/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body class=" layout-boxed">
  <?php $page= substr($_SERVER['SCRIPT_NAME'], strpos($_SERVER['SCRIPT_NAME'],"/")+1); ?>
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      <div class="sticky-top">
        <header class="navbar navbar-expand-md sticky-top d-print-none" >
          <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
              Kuih Raya Onz
            </h1>
            <div class="navbar-nav flex-row order-md-last">
            
              <?php
                if (isset($_SESSION['username'])) {

                echo "<div class='nav-item'>
                
                <a class='nav-link' href='cart.php' >";
                  
                  if ($totalItemInCart > 0) {
                    echo "<span class='badge bg-red'>".$totalItemInCart. "</span>";
                  }

                echo "<span class='nav-link-icon d-md-none d-lg-inline-block'><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                  <svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-shopping-cart' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0'></path><path d='M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0'></path><path d='M17 17h-11v-14h-2'></path><path d='M6 5l14 1l-1 7h-13'></path></svg>
                  </span>
                </a></div>";
                  

                echo "<div class='nav-item dropdown'>
                  <a href='#' class='nav-link d-flex lh-1 text-reset p-0' data-bs-toggle='dropdown' aria-label='Open user menu'>
                    <span class='avatar avatar-sm' style='background-image: url(./static/avatars/000m.jpg)'></span>
                    <div class='d-none d-xl-block ps-2'>
                      <div>
                      ";
                      
                      $query = mysqli_query($conn, "SELECT * FROM `customer` WHERE `Customer_ID`='$_SESSION[username]'") or die(mysqli_error());
                      $fetch = mysqli_fetch_array($query);
                      
                      echo $fetch['Customer_Name'];
                echo "      </div>
                      <div class='mt-1 small text-muted'>@
                      ";
                echo $fetch['Customer_ID'];
                
                echo "</div>
                      </div>
                      </a>
                      <div class='dropdown-menu dropdown-menu-end dropdown-menu-arrow'>
                      <a href='./profile.php' class='dropdown-item'>Profile</a>
                      <a href='./logout.php' class='dropdown-item'>Logout</a>
                    </div>
                  </div>";
              }

              else {
                echo "<div class='nav-item'>
                <a class='nav-link' href='./login.php' >
                  <span class='nav-link-icon d-md-none d-lg-inline-block'><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                  <svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-login' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2'></path><path d='M20 12h-13l3 -3m0 6l-3 -3'></path></svg>
                  </span>
                  <span class='nav-link-title'>
                    Login
                  </span>
                </a>
                </div>";
              }
            ?>
            </div>
          <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">

                <ul class="navbar-nav">
                  <li class="nav-item <?php if ($page == 'konz/index.php') {echo 'active';}?>">
                    <a class="nav-link" href="./index.php" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                      </span>
                      <span class="nav-link-title">
                        Home
                      </span>
                    </a>
                  </li>
                  <li class="nav-item <?php if ($page == 'konz/products.php') {echo 'active';}?>">
                    <a class="nav-link" href="./products.php" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l3 3l8 -8" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                      </span>
                      <span class="nav-link-title">
                        Browse Product
                      </span>
                    </a>
                  </li>
                  <li class="nav-item <?php if ($page == 'konz/about.php') {echo 'active';}?>">
                    <a class="nav-link" href="./about.php" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l3 3l8 -8" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                      </span>
                      <span class="nav-link-title">
                        About Us
                      </span>
                    </a>
                  </li>
                  <li class="nav-item <?php if ($page == 'konz/contact.php') {echo 'active';}?>">
                    <a class="nav-link" href="./contact.php" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l3 3l8 -8" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                      </span>
                      <span class="nav-link-title">
                        Contact Us
                      </span>
                    </a>
                  </li>

                </ul>

            </div>
          </div>
        </header>
      </div>
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">