<?php
session_start();
session_destroy();
include "functionCtrl.php";
?>
    <!-- MENUKIRI -->
    <div class="container-fluid row">
      <div class="col-md-3 pt-4 ">
        <div class="bg-secondary" id="MenuBuku">
          <h1 class="text-center">kategori produk</h1>
		  <div class="subkategori ">
			<?php
            $qry_listkat= mysqli_query($koneksidb,"select * from mst_kategoriproduk order by idkategori DESC")or die("gagal akses tabel kategoriproduk".mysqli_error($koneksidb));
            while($row = mysqli_fetch_array($qry_listkat)){
            ?>
            <div class="subkategori" id=""> 
            <ul>
                <li> 
                <a href="?page=mod_kategoriproduk&id=<?php echo $row['idkategori'];?>"><?php echo $row['nmkategori'];?></a>
                </li>
            </ul>
			</div>
            <?php
            }
            ?>
			</div>
        </div>
      </div>
       
    <!-- MENUKANAN -->
      <div class="col-8">
        <div class="row">
		<?php
                    $qlist_produk = mysqli_query($koneksidb, "SELECT mp.nmproduk, mp.harga, mp.gambar, mp.idproduk
						FROM mst_produk mp  ORDER BY mp.idproduk DESC LIMIT 3;");
                    foreach($qlist_produk as $lp) :
                ?>
          <div class="row-cols-auto">
            <div class="card-group">

              <div class="col-1"></div>
              <div class="col-lg-3 text-center">
                <div class="card">
                  <img src="assets/img/latte.jpg" class="card-img-top" alt="img"/>
                  <hr/>
                  <div class="card-body">
                    <h5 class="card-title text-center">Coffee Lattee</h5>
					<br>
                    <h6 class="harga"><?= "Rp ".fnumber($lp['harga']);?></h6>
                    <a href="detail_1.html" target="_blank">
					<button style="color: dodgerblue; bottom: 2px"><a href="?page=detailproduk&id=<?= $lp['idproduk'];?>" target="_blank" class="text-black">Detail</a></button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  <?php endforeach;?>
        </div>
      </div>
    </div>
<div class="container pb-5">
	<div class="row">
		<!-- <div class="col-md-3 pt-4">
			<div class="kategori-title">Kategori Produk</div>
			<div class="subkategori">
			<?php
            //$qry_listkat= mysqli_query($koneksidb,"select * from mst_kategoriproduk order by idkategori DESC")or die("gagal akses tabel kategoriproduk".mysqli_error($koneksidb));
            //while($row = mysqli_fetch_array($qry_listkat)){
            ?>
            <div class="subkategori" id=""> 
            <ul>
                <li> 
                <a href="?page=mod_kategoriproduk&id=<?php //echo $row['idkategori'];?>"><?php //echo $row['nmkategori'];?></a>
                </li>
            </ul>
			</div>
            <?php
            //}
            ?>
			</div>
		</div> -->
		<!-- <div class="col-md-9 pt-4">
			<div class="row">
				<?php
                    $qlist_produk = mysqli_query($koneksidb, "SELECT mp.nmproduk, mp.harga, mp.gambar, mp.idproduk
						FROM mst_produk mp  ORDER BY mp.idproduk DESC LIMIT 3;");
                    foreach($qlist_produk as $lp) :
                ?>
				<div class="col-md-4">
					<div class="card">
						<img src="assets/img/<?= $lp['gambar'];?>" class="card-img-top" alt="..." />
						<div class="card-body text-center bgcardbody">
							<h5 class="card-title"><?= $lp['nmproduk'];?></h5>
							<h6 class="harga"><?= "Rp ".fnumber($lp['harga']);?></h6>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item btndetail">
								<a href="?page=detailproduk&id=<?= $lp['idproduk'];?>" target="_blank" class="text-white">Detail</a>
							</li>
						</ul>
					</div>
				</div>
				<?php endforeach;?>
			</div>
		</div> -->
	</div>
</div>