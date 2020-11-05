
<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Cari Barang</title>
    <!-- load css boostrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Barokah Minimarket</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column" style="margin-top:100px;">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "index.php"; ?>">Barokah Minimarket</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form.php"; ?>">Tambah Data</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo "cari.php"; ?>">Cari Barang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="<?php echo "filter.php"; ?>">Filter Berdasarkan Range Harga</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              
       
        <h2 style="margin: 30px 0 30px 0;">Cari Barang</h2>
         <form action="cari.php" method="get">
          <div class="form-group">
              <input type="text" class="form-control" placeholder="Masukkan SKU" name="cari">
              <input type="submit" value="cari">
            </div>
            </form>
        <?php 
        if(isset($_GET['cari'])){
            $cari = $_GET['cari'];
            echo "<b>Hasil pencarian : ".$cari."</b>";
        }
        ?>
          <table class="table table-striped table-sm">
                <tr>
                  <th>SKU</th>
                  <th>Nama Barang</th>
                  <th>Kategori</th>
                  <th>Jumlah Stok</th>
                  <th>Harga Satuan</th>
                </tr>
            <?php 
            //jika kita klik cari, maka yang tampil query cari ini
            if(isset($_GET['cari'])){
                //menampung variabel kata_cari dari form pencarian
                $cari = $_GET['cari'];

                //jika hanya ingin mencari berdasarkan SKU
                $data = mysqli_query("select * from minimarket where SKU like '%".$cari."%' ORDER BY nama_barang ASC");				
            }else{
                //jika tidak ada pencarian, default yang dijalankan query ini
                $data = mysqli_query("select * from minimarket ORDER BY nama_barang ASC");		
            }
            //kalau ini melakukan foreach atau perulangan
            $no = 1;
            while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['SKU']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td><?php echo $d['kategori']; ?></td>
                <td><?php echo $d['jumlah_stok']; ?></td>
                <td><?php echo $d['harga_barang']; ?></td>
            </tr>
            <?php } ?>
        </table>

        </main>
      </div>
    </div>

            <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
