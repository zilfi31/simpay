<?php
include "config.php";
session_start();
	if($_SESSION['role']==""){
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
            <a href="admin.php">
              <i class="fa fa-table"></i>
              <span>Laporan</span>
            </a>
          </li>
          <li>
            <a href="produk-ad.php">
            <i class="fas fa-archive"></i>
              <span>Produk</span>
            </a>
          </li>
          <li>
            <a href="pegawai.php">
              <i class="fas fa-id-badge"></i>
              <span>Pegawai</span>
            </a>
          </li>
          <li>
            <a href="pengaturan-ad.php">
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



<!-- laporan -->
<?php
$i1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(qty) as totqty FROM laporan"));
$i4 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(subtotal) as isub FROM laporan"));
?>
    <h1 class="h3 font-weight-bold mb-3">Data Laporan</h1>
    <hr>
        <div class="row mb-4 justify-content-center d-flex">
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 m-pr-1 m-mb-1">
                <div class="box-laporan">
                  <div class="tools">
                    <div class="circle">
                      <span class="red box"></span>
                    </div>
                    <div class="circle">
                      <span class="yellow box"></span>
                    </div>
                    <div class="circle">
                      <span class="yellow box"></span>
                    </div>
                  </div>
                  <div class="card-content">
                    <p class="small mb-0">Terjual</p>
                    <h5 class="mb-2"><?php echo ribuan($i1['totqty']); ?></h5>
                  </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-4 m-pl-1">
                <div class="box-laporan">
                  <div class="tools">
                        <div class="circle">
                          <span class="red box"></span>
                        </div>
                        <div class="circle">
                          <span class="yellow box"></span>
                        </div>
                        <div class="circle">
                          <span class="yellow box"></span>
                        </div>
                  </div>
                      <div class="card-content">
                        <p class="small mb-0">Total</p>
                        <h5 class="mb-2">Rp.<?php echo ribuan($i4['isub']); ?></h5>
                      </div>
                </div>
            </div>

        </div>

<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
<thead>
  <tr>
    <th>No</th>
    <th>Invoice</th>
    <th>Nama Barang</th>
    <th>Jumlah</th>
    <th>SubTotal</th>
    <th>Pembayaran</th>
    <th>Kembalian</th>
    <th>Tanggal</th>
    <th>Opsi</th>
  </tr>
</thead>
<tbody>
<?php 
    $no = 1;
    $data_laporan = mysqli_query($conn,"SELECT * FROM laporan ORDER BY tgl_input DESC");
    while($d = mysqli_fetch_array($data_laporan)){
        ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $d['invoice']; ?></td>
    <td><?php echo $d['nama_produk']; ?></td>
    <td><?php echo $d['qty']; ?></td>
    <td><?php echo $d['subtotal']; ?></td>
    <td><?php echo $d['bayar']; ?></td>
    <td><?php echo $d['kembalian']; ?></td>
    <td><?php echo $d['tgl_input']; ?></td>
    <td>
        <a href="?id=<?php echo $d['idlaporan']; ?>"  class="btn_reset btn_efek btn-xs"                                 
        onclick="javascript:return confirm('Hapus Data Produk ?');">
          <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>  
    </td>   
  </tr>
  <?php } ?>
</tbody>
</table>

<?php 
	include 'config.php';
	if(!empty($_GET['id'])){
		$id= $_GET['id'];
		$hapus_data = mysqli_query($conn, "DELETE FROM laporan WHERE idlaporan ='$id'");
		echo '<script>window.location="laporan.php"</script>';
	}
?>

<!-- end isinya -->
<?php include 'footer.php'; ?>