<?php include 'sidebar.php'; ?>
<?php $dataselect = mysqli_query($conn, "SELECT * FROM produk");
$jsArray = "var nama_produk = new Array();";
$jsArray1 = "var harga_jual = new Array();";


 ?>
<!-- isinya -->
<h1 class="h3 font-weight-bold mb-3">Transaksi</h1>
<hr>
<div class="row">
  <!-- tes card -->
  <div class="col-md-12 mt-3 mb-2">
    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body py-4">
            <form action="" method="post">
              <div class="form-group row mb-0">
                <label class="col-sm-4 col-form-label col-form-label-sm" for="">
                  Kode produk
                </label>
                <div class="col-sm-8 mb-2 ">
                  <div class="input-group">
                    <input type="text" name="kode_produk" class="form-control form-control-sm" list="datalist1" onchange="changeValue(this.value)" aria-describedby="basic-addon2"required >
                    <datalist id="datalist1">
                        <?php if(mysqli_num_rows($dataselect)) {?>
                            <?php while($row_brg= mysqli_fetch_array($dataselect)) {?>
                                <option value="<?php echo $row_brg["kode_produk"]?>"> <?php echo $row_brg["kode_produk"]?>
                            <?php $jsArray .= "nama_produk['" . $row_brg['kode_produk'] . "'] = {nama_produk:'" . addslashes($row_brg['nama_produk']) . "'};";
                            $jsArray1 .= "harga_jual['" . $row_brg['kode_produk'] . "'] = {harga_jual:'" . addslashes($row_brg['harga_jual']) . "'};";} ?>
                        <?php } ?>
                    </datalist>
                  </div>
                </div>
                <label class="col-sm-4 col-form-label col-form-label-sm">
                  Nama product
                </label>
                <div class="col-sm-8 mb-2">
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-sm" readonly> 
                </div>
                <label class="col-sm-4 col-form-label col-form-label-sm ">
                  Harga
                </label>
                <div class="col-sm-8 mb-2">
                    <input type="number" name="harga" placeholder="0" id="harga_jual" onchange="InputSub()" class="form-control form-control-sm" readonly> 
                </div>
                <label class="col-sm-4 col-form-label col-form-label-sm ">
                  Jumlah
                </label>
                <div class="col-sm-8 mb-2">
                    <input type="number" name="qty" id="Iqty" onchange="InputSub()" placeholder="0" class="form-control form-control-sm" required> 
                </div>
                <label class="col-sm-4 col-form-label col-form-label-sm ">
                  Subtotal
                </label>
                <div class="col-sm-8">
                  <div class="input-group">
                    <input type="number" name="subtotal" placeholder="0" id="Isubtotal" onchange="InputSub()" class="form-control form-control-sm" readonly>
                    <div class="input-group-append">
                      <button type="submit" name="InputCart" class="btn btn_biru btn-sm" value="simpan">
                        <i class="fa fa-plus mr-2"></i>Tambah
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <hr>

            <?php
            if(isset($_POST['InputCart'])) {
          
    $Input1 = htmlspecialchars($_POST['kode_produk']);
    $Input2 = htmlspecialchars($_POST['nama_produk']);
    $Input3 = htmlspecialchars($_POST['harga']);
    $Input5 = htmlspecialchars($_POST['subtotal']);

    $cekDulu = mysqli_query($conn,"SELECT * FROM cart ");
    $liat = mysqli_num_rows($cekDulu);
    $f = mysqli_fetch_array($cekDulu);
    $inv_c = $f['invoice'];
    $ii = htmlspecialchars($_POST['qty']);

    if($liat>0){
      $cekbrg = mysqli_query($conn,"SELECT * FROM cart WHERE kode_produk='$Input1' and invoice='$inv_c'");
      $liatlg = mysqli_num_rows($cekbrg);
      $brpbanyak = mysqli_fetch_array($cekbrg);
      $jmlh = $brpbanyak['qty'];
      $jmlh1 = $brpbanyak['harga'];

      
      if($liatlg>0){
        $i = htmlspecialchars($_POST['qty']);
        $baru = $jmlh + $i;
        $baru1 = $jmlh1 * $baru;

        $updateaja = mysqli_query($conn,"UPDATE cart SET qty='$baru', subtotal='$baru1' WHERE invoice='$inv_c' and kode_produk='$Input1'");
        if($updateaja){
          // echo "sukses";
           echo '<script>window.location="index.php"</script>';
        } else {
          // echo "error";
           echo '<script>window.location="index.php"</script>';
        }
      } else {

      $tambahdata = mysqli_query($conn,"INSERT INTO cart (invoice,kode_produk,nama_produk,harga,qty,subtotal)
       values('$inv_c','$Input1','$Input2','$Input3','$ii','$Input5')");
      if ($tambahdata){
          echo '<script>window.location="index.php"</script>';
  
      } else { 
          echo '<script>window.location="index.php"</script>';
      }
      };
} else {
  
  $queryStar = mysqli_query($conn, "SELECT max(invoice) as kodeTerbesar FROM inv");
  $data = mysqli_fetch_array($queryStar);
  $kodeInfo = $data['kodeTerbesar'];
  $urutan = (int) substr($kodeInfo, 8, 2);
  $urutan++;
  $huruf = "AD";
  $oi = $huruf . date("jnyGi") . sprintf("%02s", $urutan);
    
    $bikincart = mysqli_query($conn,"INSERT INTO inv (invoice,pembayaran,kembalian,status) values('$oi','','','proses')");
      $tambahuser = mysqli_query($conn,"INSERT INTO cart (invoice,kode_produk,nama_produk,harga,qty,subtotal)
      values('$oi','$Input1','$Input2','$Input3','$ii','$Input5')");
    if($bikincart){
      $tambahuser = mysqli_query($conn,"INSERT INTO cart (invoice,kode_produk,nama_produk,harga,qty,subtotal)
      values('$oi','$Input1','$Input2','$Input3','$ii','$Input5')");
      if ($tambahuser){
        echo '<script>window.location="index.php"</script>';
      } else { echo '<script>window.location="index.php"</script>';
      }
    } else {
      
    }
}
};
$DataInv = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM cart LIMIT 1"));
$noinv = $DataInv['invoice'];
?> 

<?php 
if(!empty($_GET['hapus'])){
  $idcart = $_GET['hapus'];
  $hapus_data_Cart = mysqli_query($conn, "DELETE FROM cart WHERE idcart='$idcart'");
  echo '<script>window.location="index.php"</script>';

};
  

    function format_ribuan ($nilai){
      return number_format ($nilai, 0, ',', '.');
  }
    
    $itungtrans = mysqli_query($conn,"SELECT * FROM cart");
    $itungtrans21 = 0;
    $itungtrans3 = 0;
    $no = 1;
    while ($itungtrans2 = $itungtrans ->fetch_assoc()){
      $itungtrans21 = $itungtrans2['harga'] * $itungtrans2['qty'];
      $itungtrans3 += $itungtrans21;
      $pembayaran = $itungtrans2['pembayaran'];
      $kembalian = $itungtrans2['kembalian']; 

    }
   
  ?>            
            <form method="post" action="">
              <div class="form-group row mb-0">
                <input type="hidden" class="form-control" name="invoice" value="<?php echo $noinv ?>" >
                <input type="hidden" class="form-control" value="<?php echo $itungtrans3; ?>" id="totalCart">
                <label for="pembayaran" class="col-sm-4 col-form-label col-form-label-sm">
                  Bayar
                </label>
                <div class="col-sm-8 mb-2">
                  <input type="text" class="form-control form-control-sm" name="pembayaran" onchange="procesBayar()" id="pembayaran" placeholder="0" required>
                </div>
                <label class="col-sm-4 col-form-label col-form-label-sm" for="kembalian">
                  Kembalian
                </label>
                <div class="col-sm-8 mb-2">
                  <input type="text" class="form-control form-control-sm" name="kembalian" id="kembalian" placeholder="0" readonly>
                </div>
              </div>
              <div class="text-right">
              <?php 
                  $on = mysqli_query($conn,"SELECT * FROM cart");
                  $x1 = mysqli_num_rows($on);
                  if($x1>0){
                    ?>              
                    <button type="submit" name="save1" class=" btn_biru btn_efek btn-sm px-3" >
                    <i class="fa fa-shopping-cart mr-2"></i>Bayar
                  <?php } else { ?>
                      <button class=" btn_biru btn_efek btn-sm px-3" disabled>
                      <i class="fa fa-shopping-cart mr-2"></i>Bayar
                  <?php  } ?>
      
              </div>
            </form>
            <?php
            if(isset($_POST['save1'])){
                $notrans = $_POST['invoice'];
                $pembayaran = $_POST['pembayaran'];
                $kembalian = $_POST['kembalian'];

                $sql = "UPDATE cart SET invoice='$notrans',pembayaran='$pembayaran',kembalian='$kembalian' ";
                $query = mysqli_query($conn, $sql) or die (mysqli_error());
                echo '<script>window.location="index.php"</script>';

            }?>  
          
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-3">
        <form action="" method="post">
        <div id="print" class="card" >
          <div class="card-header bg-white border-0 pb-0 pt-4">
          <?php 
            $toko = mysqli_query($conn,"SELECT * FROM login ORDER BY toko ASC");
            
            while($dat = mysqli_fetch_array($toko)){
              $user = $dat['username'];
              $nama_toko = $dat['toko'];
            }
            echo "<h5 class='card-tittle mb-0 text-center'><b>$nama_toko</b></h5>";
          ?>
            <p class='m-0 small text-center'>Gowa - Sulawesi selatan</p>
            <div class="row">
              <div class="col-8 col-sm-9 pr-0">
                <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                    <li>NOTA : <?php 
                        $notrans = mysqli_query($conn,"SELECT * FROM cart ORDER BY invoice ASC LIMIT 1");
                        while($dat2 = mysqli_fetch_array($notrans)){
                        $notransaksi = $dat2['invoice'];
                    echo "$notransaksi";
                        }
                    ?></li>
                    <li>KASIR : <?php echo $user ?></li>
                </ul>
              </div>
              <div class="col-4 col-sm-3 pl-0">
              <ul class="pl-0 small" style="list-style: none;">
                    <li>TGL : <?php echo  date("j-m-Y");?></li>
                    <li>JAM : <?php echo  date("G:i:s");?></li>
                </ul>
              </div>
          </div>
          </div>
          <div class="card-body small pt-0">
            <hr class="mt-0">
            <div class="row">
              <div class="col-5 pr-0">
                <span><b>Nama Produk</b></span>
              </div>
              <div class="col-1 px-0 text-center">
                <span><b>Jmlh</b></span>
              </div>
              <div class="col-3 px-0 text-right">
                <span><b>Harga</b></span>
              </div>
              <div class="col-3 pl-0 text-right">
               <span><b>Subtotal</b></span>
              </div>
              <div class="col-12">
                <hr class="mt-2">
              </div>

              <?php               
                $data_cart = mysqli_query($conn,"SELECT * FROM cart");               
                while($d = mysqli_fetch_array($data_cart)){
                    ?>

              <div class="col-5 pr-0">
                  <a href="?hapus=<?php echo $d['idcart']; ?>" onclick="javascript:return confirm('Hapus Data Produk ?');" style="text-decoration:none;">
                      <i class="fa fa-times fa-xs text-danger mr-1"></i>
                      <span class="text-dark"><?php echo $d['nama_produk']; ?></span>
                  </a>
              </div>
              <div class="col-1 px-0 text-center">
                  <span><?php echo $d['qty']; ?></span>
              </div>
              <div class="col-3 px-0 text-right">
                  <span><?php echo format_ribuan($d['harga']); ?></span>
              </div>
              <div class="col-3 pl-0 text-right">
                  <span><?php echo format_ribuan($d['subtotal']); ?></span>
              </div>
              <?php }?>
              <div class="col-12">
                <hr class="mt-2">
                <ul class="list-group border-0">
                  <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                    <b>Total</b>
                    <span><b><?php echo format_ribuan($itungtrans3); ?></b></span>
                  </li>
                  <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                    <b>Bayar</b>
                    <span><b><?php echo format_ribuan($pembayaran); ?></b></span>
                  </li>
                  <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                    <b>Kembalian</b>
                    <span><b><?php echo format_ribuan($kembalian) ?></b></span>
                  </li>
                </ul>
              </div>
              <div class="col-sm-12 mt-5 text-center">
                <p>* TERIMA KASIH TELAH BERBELANJA TOKO KAMI *</p>
              </div>
            </div>
          </div>
          </div>
          <div class="text-right mt-3">

          <form method="POST" >
           
          <?php
            if(format_ribuan($pembayaran)==0){
              ?>
            <button class="btn_biru btn_efek btn-sm"  type="submit" disabled>  
                <i class="fa fa-check mr-1"></i>Selesai
              </button>
              <?php
            } else {
              ?>
              <button class="btn_reset btn_efek btn-sm mr-2" onclick="printContent('print')"><i class="fa fa-print mr-1"></i> Print</button>
              <button class="btn_biru btn_efek btn-sm" name="kirimdata" type="submit">  
                <i class="fa fa-check mr-1"></i>Selesai</button>
              <?php
            }
          ?>         
          </form>
        </div>
        <?php
               if(isset($_POST['kirimdata'])){
  
                $ambildata = mysqli_query($conn,"INSERT INTO laporan (invoice,bayar,kembalian, kode_produk, nama_produk, harga, qty, subtotal, tgl_input)
                SELECT invoice,pembayaran,kembalian,kode_produk, nama_produk, harga, qty, subtotal, tgl_input
                FROM cart ") or die (mysqli_error($conn)); 
                $hapusdata = mysqli_query($conn,"DELETE FROM cart");
                if($hapusdata){

                  echo '<script>window.location="index.php"</script>';
                } else{
                  echo mysqli_error($conn);
                }
                }
                ?>  
      </div>
    </form>
    </div>
  </div>
<!-- end test -->
  
</div>
<!-- end row -->

</div><!-- end container-fluid" -->
  </main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <div class="modal-body text-center">
      <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
        <h3 class="mb-4">Apakah anda yakin ingin keluar ?</h3>
        <button type="button" class="btn btn-secondary  px-4 mr-2" data-dismiss="modal">Batal</button>
        <a href="logout.php" class="btn btn-primary px-4">Keluar</a>
    </div>
  </div>
</div>
<!-- end Modal Exit -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/sidebar.js"></script>
    <script src="assets/vendor/datatables/jquery-3.5.1.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $('#cart').dataTable({searching: false, paging: false, info: false});
    </script>
    <script type="text/javascript">
      <?php echo $jsArray;?>
      <?php echo $jsArray1; ?>
        function changeValue(kode_produk) {
          document.getElementById("nama_produk").value = nama_produk[kode_produk].nama_produk;
          document.getElementById("harga_jual").value = harga_jual[kode_produk].harga_jual;
        };
        function InputSub() {
        var harga_jual =  parseInt(document.getElementById('harga_jual').value);
        var jumlah_beli =  parseInt(document.getElementById('Iqty').value);
        var jumlah_harga = harga_jual * jumlah_beli;
          document.getElementById('Isubtotal').value = jumlah_harga;
      };
      function procesBayar() {
      var harga_Cart =  parseInt(document.getElementById('totalCart').value);
      var pembayaran_Cart =  parseInt(document.getElementById('pembayaran').value);
      var kembali_Cart = pembayaran_Cart - harga_Cart;
        document.getElementById('kembalian').value = kembali_Cart;
      };
     

      function printContent(print){
			var restorepage = document.body.innerHTML;
			var printcontent = document.getElementById(print).innerHTML;
			document.body.innerHTML = printcontent;
      window.print();
			document.body.innerHTML = restorepage;
		}

  </script>
</body>
</html>