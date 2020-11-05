<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['SKU'])) {
          //query SQL
          $sku_upd = $_GET['SKU'];
          $query = "SELECT * FROM minimarket WHERE SKU = '$sku_upd'";

          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $SKU = $_POST['SKU'];
      $nama_barang = $_POST['nama_barang'];
      $kategori = $_POST['kategori'];
      $jumlah_stok = $_POST['jumlah_stok'];
      $harga_satuan = $_POST['harga_satuan'];
      //query SQL
      $sql = "UPDATE minimarket SET nama_barang='$nama_barang', kategori='$kategori', jumlah_stok='$jumlah_stok', harga_satuan='$harga_satuan' WHERE SKU='$SKU'";

      //eksekusi query
      $result = mysqli_query(connection(),$sql);
      if ($result) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: index.php?status='.$status);
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <title>Update Stok</title>
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
                <a class="nav-link active" href="<?php echo "index.php"; ?>">Stok Minimarket</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "form.php"; ?>">Tambah Stok</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "cari.php"; ?>">Cari Barang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="<?php echo "filter.php"; ?>">Filter Berdasarkan Range Harga</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


          <h2 style="margin: 30px 0 30px 0;">Update Stok Barang</h2>
          <form action="update.php" method="POST">
            <?php while($data = mysqli_fetch_array($result)): ?>
            <div class="form-group">
              <label>SKU</label>
              <input type="text" class="form-control" placeholder="SKU Barang" name="SKU" value="<?php echo $data['SKU'];  ?>" required="required" readonly>
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" class="form-control" placeholder="nama barang" name="nama_barang" value="<?php echo $data['nama_barang'];  ?>" required="required">
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <select class="custom-select" name="kategori" required="required">
                <option value="">Pilih Salah Satu</option>
                <option value="Makanan" <?php echo $data['kategori']=='Makanan' ? "selected" : "" ?>>Makanan</option>
                <option value="Minuman" <?php echo $data['kategori']=='Minuman' ? "selected" : "" ?>>Minuman</option>
                <option value="atk" <?php echo $data['kategori']=='atk' ? "selected" : "" ?>>ATK</option>
              </select>
            </div>

            <div class="form-group">
              <label>Jml Stok</label>
              <textarea class="form-control" name="jummlah_stok" required="required"><?php echo $data['jumlah_stok'];  ?></textarea>
            </div>
            <div class="form-group">
              <label>Harga Satuan</label>
              <textarea class="form-control" name="harga_satuan" required="required"><?php echo $data['harga_satuan'];  ?></textarea>
            </div>
            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </main>
      </div>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>