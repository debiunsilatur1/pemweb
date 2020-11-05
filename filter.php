
<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Filter Barang</title>
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
                <a class="nav-link" href="<?php echo "cari.php"; ?>">Cari Barang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo "filter.php"; ?>">Filter Berdasarkan Range Harga</a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              
            <h2 style="margin: 30px 0 30px 0;">Inputkan Range Harga </h2>
            <form action="" method="post">
            <div class="form-group">
                <input type="text" name="harga_satuan1" placeholder="Masukkan Harga Terendah">
                <input type="text" name="harga_satuan2" placeholder="Masukkan Harga Tertinggi">
                <input type="submit" name="tampil" value="TAMPIL">
	        </form>
	
	
	
	<?php

		if(isset($_POST["tampilkan"])){
			$harga1 = $_POST["harga_satuan1"];
			$harga2 = $_POST["harga_satuan2"];
            echo "<b>Hasil Filter : ".$harga_satuan1." - ".$harga_satuan2."</b>";
			$no = 1;
 
			$sql = "SELECT * FROM minimarket WHERE harga_satuan BETWEEN '$harga1' AND '$harga2'";
			$query = mysqli_query($connection(),$query) or die (mysqli_error($connection()));
 
                    while($data = mysqli_fetch_array($query))
                   
                    {?>
						
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $data['SKU'];?></td>
							<td><?php echo $data['nama_barang'];?></td>
                            <td><?php echo $data['kategori'];?></td>
                            <td><?php echo $data['jumlah_stok'];?></td>
                            <td><?php echo $data['harga_satuan'];?></td>
						</tr>
 
						<?php $no++; ?>
 
					<?php }
 
			echo "	</tbody>
				  </table>";
		}	
	?>
  
</body>
</html>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>