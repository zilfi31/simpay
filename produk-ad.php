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



<!-- isinya -->
    <h1 class="h3 font-weight-bold mb-0">
        Data Produk
        <button class="btn_biru btn_efek btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#TambahProduk"><i class="fa fa-plus mr-2"></i> Tambah Produk</button>
    </h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
<thead>
  <tr>
    <th>No</th>
    <th>Kode Produk</th>
    <th>Nama Produk</th>
    <th>Harga</th>
    <th>Tgl Input</th>
    <th>Opsi</th>
  </tr>
</thead>
<tbody>
<?php 
    $no = 1;
    $data_barang = mysqli_query($conn,"SELECT * FROM produk ORDER BY idproduk ASC");
    while($d = mysqli_fetch_array($data_barang)){
        ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $d['kode_produk']; ?></td>
    <td><?php echo $d['nama_produk']; ?></td>
    <td>Rp.<?php echo ribuan($d['harga_jual']); ?></td>
    <td><?php echo $d['tgl_input']; ?></td>
    <td>
        <button type="button" class="btn_biru btn_efek mr-1" data-toggle="modal" data-target="#EditProduk<?php echo $d['idproduk']; ?>">
        <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
        </button>
        <a class="btn_reset btn_efek btn-xs text-white" href="?hapus=<?php echo $d['idproduk']; ?>">
        <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
    </td>
  </tr>
  <!-- Modal Edit Produk -->
<div class="modal fade" id="EditProduk<?php echo $d['idproduk']; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
        <form method="post">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-white">Edit Produk</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label class="samll">Kode Produk :</label>
            <input type="hidden" name="idproduk" value="<?php echo $d['idproduk']; ?>">
            <input type="text" name="Edit_Kode_Produk" value="<?php echo $d['kode_produk']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="samll">Nama Produk :</label>
            <input type="text" name="Edit_Nama_Produk" value="<?php echo $d['nama_produk']; ?>" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label class="samll">Harga :</label>
            <input type="number" placeholder="0" name="Edit_Harga_Jual" value="<?php echo $d['harga_jual']; ?>" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn_reset btn_efek" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn_biru btn_efek" name="SimpanEdit">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal Produk -->
  <?php } ?>
</tbody>
</table>
<?php 
if(isset($_POST['TambahProduk']))
{
    $kodeproduk = htmlspecialchars($_POST['Tambah_Kode_Produk']);
    $namaproduk = htmlspecialchars($_POST['Tambah_Nama_Produk']);
    $harga_jual = htmlspecialchars($_POST['Tambah_Harga_Jual']);

    $cekkode = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM produk WHERE kode_produk='$kodeproduk'"));
    if($cekkode > 0) {
        echo '<script>alert("Maaf! kode produk sudah ada");history.go(-1);</script>';
    } else {
    $InputProduk = mysqli_query($conn,"INSERT INTO produk (kode_produk,nama_produk,harga_jual)
     values ('$kodeproduk','$namaproduk','$harga_jual')");
    if ($InputProduk){
        echo '<script>history.go(-1);</script>';
    } else {
        echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }
}
};
if(isset($_POST['SimpanEdit'])){
    $idproduk1 = htmlspecialchars($_POST['idproduk']);
    $kodeproduk1 = htmlspecialchars($_POST['Edit_Kode_Produk']);
    $namaproduk1 = htmlspecialchars($_POST['Edit_Nama_Produk']);
    $harga_jual1 = htmlspecialchars($_POST['Edit_Harga_Jual']);

    $CariProduk = mysqli_query($conn,"SELECT * FROM produk WHERE kode_produk='$kodeproduk1' and idproduk!='$idproduk1'");
    $HasilData = mysqli_num_rows($CariProduk);

    if($HasilData > 0){
        echo '<script>alert("Maaf! kode produk sudah ada");history.go(-1);</script>';
    } else{
        $cekDataUpdate =  mysqli_query($conn, "UPDATE produk SET kode_produk='$kodeproduk1',
        nama_produk='$namaproduk1',harga_jual='$harga_jual1'
         WHERE idproduk='$idproduk1'") or die(mysqli_connect_error());
        if($cekDataUpdate){
            echo '<script>history.go(-1);</script>';
        } else {
            echo '<script>alert("Gagal Edit Data Produk");history.go(-1);</script>';
        }
    }
}; 
	if(!empty($_GET['hapus'])){
		$idproduk1 = $_GET['hapus'];
		$hapus_data = mysqli_query($conn, "DELETE FROM produk WHERE idproduk='$idproduk1'");
        if($hapus_data){
            echo '<script>history.go(-1);</script>';
        } else {
            echo '<script>alert("Gagal Hapus Data Produk");history.go(-1);</script>';
        }
	};
    ?>
<!-- Modal Tambah Produk -->
<div class="modal fade" id="TambahProduk" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
        <form method="post">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-white">Tambah Produk</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label class="samll">Kode Produk :</label>
            <input type="text" name="Tambah_Kode_Produk" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="samll">Nama Produk :</label>
            <input type="text" name="Tambah_Nama_Produk" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label class="samll">Harga :</label>
            <input type="number" placeholder="0" name="Tambah_Harga_Jual" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn_efek btn_reset" data-dismiss="modal">Batal</button>
        <button type="submit" name="TambahProduk" class="btn_efek btn_biru">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal Produk -->

<!-- end isinya -->
<?php include 'footer.php'; ?>