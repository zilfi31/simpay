<?php include 'sidebar.php'; ?>
<!-- isinya -->
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
    <!-- <th>Opsi</th> -->
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
    <!-- <td>
        <a href="?id=<?php echo $d['idlaporan']; ?>"  class="btn_reset btn_efek btn-xs"                                 
        onclick="javascript:return confirm('Hapus Data Produk ?');">
          <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>  
    </td>    -->
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