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
        Data Pegawai
        <button class="btn_biru btn_efek btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#TambahPegawai"><i class="fa fa-plus mr-2"></i> Tambah Pegawai</button>
    </h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
<thead>
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Role</th>
    <th>No.Hp</th>
    <th>Alamat</th>
    <th>Password</th>
    <th>Opsi</th>
  </tr>
</thead>
<tbody>
<?php 
    $no = 1;
    $data_pegawai = mysqli_query($conn,"SELECT * FROM login ORDER BY userid ASC");
    while($d = mysqli_fetch_array($data_pegawai)){
        ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $d['username']; ?></td>
    <td><?php echo $d['role']; ?></td>
    <td><?php echo $d['telepon']; ?></td>
    <td><?php echo $d['alamat']; ?></td>
    <td><?php echo $d['password']; ?></td>
    <td>
        <button type="button" class="btn_biru btn_efek mr-1" data-toggle="modal" data-target="#EditPegawai<?php echo $d['userid']; ?>">
        <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
        </button>
        <a class="btn_reset btn_efek btn-xs text-white" href="?hapus=<?php echo $d['userid']; ?>">
        <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
    </td>
  </tr>
  <!-- Modal Edit Produk -->
<div class="modal fade" id="EditPegawai<?php echo $d['userid']; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
        <form method="post">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-white">Edit Pegawai</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label class="samll">Nama Pegawai :</label>
            <input type="hidden" name="userid" value="<?php echo $d['userid']; ?>">
            <input type="text" name="Edit_Nama_Pegawai" value="<?php echo $d['username']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="samll">Role :</label>
            <input type="text" name="Edit_role" value="<?php echo $d['role']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="samll">No.Hp :</label>
            <input type="text" name="Edit_nohp" value="<?php echo $d['telepon']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="samll">Alamat :</label>
            <input type="text" name="Edit_alamat" value="<?php echo $d['alamat']; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="samll">Password :</label>
            <input type="text" name="Edit_password" value="<?php echo $d['alamat']; ?>" class="form-control" required>
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
if(isset($_POST['TambahPegawai']))
{
    $namapegawai = htmlspecialchars($_POST['Tambah_Nama_Pegawai']);
    $role = htmlspecialchars($_POST['Tambah_role']);
    $nohp = htmlspecialchars($_POST['Tambah_nohp']);
    $alamat = htmlspecialchars($_POST['Tambah_alamat']);
    $password = htmlspecialchars($_POST['Tambah_password']);

    $InputPegawai = mysqli_query($conn,"INSERT INTO login (username, role, telepon, alamat, password)
     values ('$namapegawai','$role','$nohp','$alamat','$password')");
    if ($InputPegawai){
        echo '<script>history.go(-1);</script>';
    } else {
        echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }

};
if(isset($_POST['SimpanEdit'])){
    $userid1 = htmlspecialchars($_POST['userid']);
    $namapegawai1 = htmlspecialchars($_POST['Edit_Nama_Pegawai']);
    $role1 = htmlspecialchars($_POST['Edit_role']);
    $nohp1 = htmlspecialchars($_POST['Edit_nohp']);
    $alamat1 = htmlspecialchars($_POST['Edit_alamat']);
    $password1 = htmlspecialchars($_POST['Edit_password']);

    $queryuser = mysqli_query($conn,"SELECT * FROM login WHERE userid='$userid1'");
    $cariuser = mysqli_fetch_assoc($queryuser);

    if($cariuser){
  
        $cekDataUpdate =  mysqli_query($conn, "UPDATE login SET nama_pegawai='$namapegawai1',role='$role1', telepon='$nohp1', alamat='$alamat1', password='$password1'
         WHERE userid='$userid1'") or die(mysqli_connect_error());
        if($cekDataUpdate){
            echo '<script>history.go(-1);</script>';
        } else {
            echo '<script>alert("Gagal Edit Data Pegawai");history.go(-1);</script>';
        }
    }
}; 
	if(!empty($_GET['hapus'])){
		$userid1 = $_GET['hapus'];
		$hapus_data = mysqli_query($conn, "DELETE FROM login WHERE userid='$userid1'");
        if($hapus_data){
            echo '<script>history.go(-1);</script>';
        } else {
            echo '<script>alert("Gagal Hapus Data Pegawai");history.go(-1);</script>';
        }
	};
    ?>
<!-- Modal Tambah Produk -->
<div class="modal fade" id="TambahPegawai" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
        <form method="post">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-white">Tambah Pegawai</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
              <label class="samll">Nama Pegawai :</label>
              <input type="text" name="Tambah_Nama_Pegawai" class="form-control" required>
          </div>
          <div class="form-group">
              <label class="samll">Role :</label>
              <input type="text" name="Tambah_role" class="form-control" required>
          </div>
          <div class="form-group">
              <label class="samll">No.HP:</label>
              <input type="text" name="Tambah_nohp" class="form-control" required>
          </div>
          <div class="form-group">
              <label class="samll">Alamat :</label>
              <input type="text" name="Tambah_alamat" class="form-control" required>
          </div>
          <div class="form-group">
              <label class="samll">Password :</label>
              <input type="text" name="Tambah_password" class="form-control" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn_efek btn_reset" data-dismiss="modal">Batal</button>
        <button type="submit" name="TambahPegawai" class="btn_efek btn_biru">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal Produk -->

<!-- end isinya -->
<?php include 'footer.php'; ?>