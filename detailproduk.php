<?php 
function rupiah($angka){
	$hasil_rupiah = "Rp." . number_format($angka,2,',', '.');
	return $hasil_rupiah;
}
?>
<div class="container pb-5">
	<div class="row">
		<div class="col-md-3 pt-4">
			<div class="kategori-title">Kategori Produk</div>
			<div class="subkategori" id="subkategori"></div>
		</div>
		<div class="col-md-9 pt-4">
		<?php
				$dtlproduk = mysqli_query($koneksidb,"select*from mst_produk ")
					or die("gagal akses table mst_menu ".mysqli_error($koneksidb));
				//looping 
				while($p = mysqli_fetch_array($dtlproduk)){	
					if(isset($_GET['id']) == ($_GET['id']==$p['idproduk'])){
			?>
			<div class="row">
				<div class="col-md-6 pe-0">
					<img src="assets/img/<?= $p['gambar'];?>" class="card-img-top" alt="..." />
				</div>
				<div class="col-md-6 ps-0">
					<div class="card">
						<div class="card-body subkategori p-2">
							<h4><?= $p['nmproduk'];?></h4>
							<h5 class="harga">Harga : <?= rupiah($p['harga']); ?></h5>
							<p style="color: black; font-family: Arial, Helvetica, sans-serif; font-size: 14px">
								Kondisi : <?= $p['kondisi'];?> <br />
								Berat : <?= $p['berat'];?> <br />
								Stok : <?= $p['stock'];?> <br />
								Deskripsi : <?= $p['deskripsi'];?> <br />
							</p>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item btndetail">
								<a href="http://wa.me/6281339364971?text=Saya mau beli Sweater 001- white , Harga Rp. 100,000 "
									target="_blank" class="text-white">Beli Yuk</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	}
	?>
</div>