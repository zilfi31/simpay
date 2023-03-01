<?php
include "config.php";
session_start();
	if($_SESSION['log']!="login"){
		header("location:login.php");
	}
  function ribuan ($nilai){
    return number_format ($nilai, 0, ',', '.');
}
$uid = $_SESSION['userid'];
$DataLogin = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM login WHERE userid='$uid'"));
$username = $DataLogin['username'];
$toko = $DataLogin['toko'];
$alamat = $DataLogin['alamat'];
$telepon = $DataLogin['telepon'];
$logo = $DataLogin['logo'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $toko; ?></title>
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">  
</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-primary border-0" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="./"><i class="fas fa-shopping-cart mr-1"></i><?php echo $toko; ?></a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="card-sidebar align-items-center d-flex">
          <div class="user-pic" style="height:70px;width:70px;">
            <img class="img-responsive img-rounded" src="assets/images/<?php echo $logo ?>"
              alt="User picture">
          </div>
          <div class="user-info text-center">
            <span class="user-name ">Halo, <span class="halo"><?php echo $username; ?></span> 
            </span>
            
          </div>
        </div>
      </div>
      <!-- sidebar-header  -->

      <div class="sidebar-menu">
        <ul>
          <li>
            <a href="index.php">
              <i class="fas fa-shopping-basket"></i>
              <span>Transaksi</span>
            </a>
          </li>
          <li>
            <a href="produk.php">
            <i class="fas fa-archive"></i>
              <span>Produk</span>
            </a>
          </li>
          <li>
            <a href="laporan.php">
              <i class="fa fa-table"></i>
              <span>Laporan</span>
            </a>
          </li>
          <li>
            <a href="pengaturan.php">
              <i class="fa fa-cog"></i>
              <span>Pengaturan</span>
            </a>
          </li>
         
          <li>
            <a href="#Exit" data-toggle="modal">
              <i class="fas fa-sign-out-alt fa-rotate-180"></i>
              <span>Keluar</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">

    <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>