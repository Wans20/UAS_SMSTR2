<?php
include_once("produk_Ctrl.php");
if (!isset($_GET['action'])) {
?>
    <h3 class="fontheader">Produk Coffee shop</h3>
	<a href="?modul=mod_produk&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
	<table class="table table-bordered">
		<tr class="table-dark">
			<th>foto</th>
			<th>kode produk</th>
			<th>nama poduk</th>
			<th>id kategori</th>
			<th>kategori produk</th>
			<th>stock</th>
			<th>harga produk</th>
			<th>deskripsi</th>
			<th>Action</th>
		</tr>
		<?php
        $listmhs=mysqli_query($koneksidb,"SELECT a.*,ka.nmkategori from mst_produk a INNER JOIN mst_kategoriproduk ka ON a.idkategori=ka.idkategori");
		while ($list = mysqli_fetch_array($listmhs)) {
		?>
        <tr>
            <td><img src="../assets/img/<?=$list['gambar']; ?>" width="200px"></td>
            <td><?=$list['idproduk']; ?></td>
            <td><?=$list['nmproduk']; ?></td>
            <td><?=$list['idkategori']; ?></td>
            <td><?=$list['nmkategori']; ?></td>
            <td><?=$list['stock']; ?></td>
            <td><?=$list['harga']; ?></td>
            <td><?= substr($list['deskripsi'], 0, 200)?></td>
            <td> 
                <a href="?modul=mod_produk&action=edit&id=<?=$list['idproduk']; ?>" class="btn btn-primary mb-1">
                        <i class="bi bi-pencil-square"></i> edit</a>
                <a href="?modul=mod_produk&action=delete&id=<?=$list['idproduk']; ?>" class="btn btn-danger">
                        <i class="bi bi-trash"></i> delete</a>
            </td>
        </tr>
        <?php } ?>
	</table>
	<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
                $query_cekkode = mysqli_query($koneksidb,
                "select idproduk from mst_produk ORDER BY idproduk DESC LIMIT 0,1");
                   $cekkode = mysqli_fetch_array($query_cekkode);
                   if(mysqli_num_rows($query_cekkode) == 0 ){
                    $kodeakhir="AS";
                }else{
                    $kodeakhir=$cekkode['idproduk'];  
                }
                $no_urutakhir = substr($kodeakhir,6);
                $th_akhir = substr($kodeakhir,2,4);
                $th_sekarang = date("Y");
        
            if($th_akhir == $th_sekarang){
                if ($no_urutakhir ==0||$no_urutakhir < 9) {
                    $nourut_baru = "00" . ($no_urutakhir + 1);
                } else if ($no_urutakhir >9) {
                    $nourut_baru = "0" . ($no_urutakhir + 1);
                } else if ($no_urutakhir < 100) {
                    $nourut_baru = "0" . ($no_urutakhir + 1);
                } else {
                    $nourut_baru = ($no_urutakhir + 1);
                }
                // echo "kodenya:" . $nourut_baru . "<br>";
            } else {
                $nourut_baru =  "001";
            }
            $kodeterbaru = "AS".$th_sekarang . $nourut_baru;
               $qrykategorialat=mysqli_query($koneksidb,"SELECT * FROM mst_kategoriproduk");
        if($proses=="insert"){
    ?>
	<form action="?modul=mod_produk&action=save" method="POST" enctype="multipart/form-data">
        <div class="row mb-1">
			<label class="col-md-3">id produk</label>
				<div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="hidden" name="idkopi" value="<?= $upidalat; ?>">
					<input type="text" name="idproduk" id="produk" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
				</div>
			</div>
        <div class="row mb-1">
			<label class="col-md-3">Nama produk</label>
			<div class="col-md-5">
				<input type="text" name="nmproduk" id="nmproduk" class="form-control" >
			</div>
		</div>
        <div class="row mb-1">
                <label class="col-md-3">Kategori produk</label>
                <div class="col-md-5">
                    <select name="katkopi" id="katkopi" class="form-control" required>
                        <option selected disabled>--Pilih Kategori coffee--</option>
                        <?php
                        foreach ($qrykategorialat as $j) :
                        ?>
                            <option value="<?= $j['idkategori']; ?>"><?= $j['nmkategori']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
		<div class="row mb-1">
			<label class="col-md-3">Stock</label>
			<div class="col-md-5">
				<input type="number" name="stock" id="stock" class="form-control" >
			</div>
		</div>
        <div class="row mb-1">
			<label class="col-md-3">Harga produk</label>
			<div class="col-md-5">
				<input type="text" name="harga" id="harga" class="form-control" >
			</div>
		</div>
        <div class="row mb-1">
			<label class="col-md-3">Deskripsi</label>
			<div class="col-md-5">
				<textarea type="text" name="deskripsi" id="deskripsi" class="form-control"></textarea>
			</div>
		</div>
        <div class="row mb-1">
			<label class="col-md-3">Foto</label>
			<div class="col-md-5">
				<input type="file" name="img" id="img" class="form-control" >
			</div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="submit" id="btnsubmit" class="btn btn-success" data-bs-toggle="modal">Simpan</button>
                    <a href="home.php?modul=mod_produk"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
	</form>
<?php }else{ ?>
    <form action="?modul=mod_produk&action=save" id="formalat" method="POST" enctype="multipart/form-data">
        <?php if($proses=="update"){ ?>
        <div class="row mb-1">
			<label class="col-md-3">id produk</label>
			<div class="col-md-5">
            <input type="hidden" name="proses" value="<?= $proses; ?>">
            <input type="hidden" name="idalat" value="<?= $upidalat; ?>">
				<input type="text" name="idproduk" id="idproduk" class="form-control" value="<?= $upkode;?>" readonly>
			</div>
		</div>
        <?php } ?>
		<div class="row mb-1">
			<label class="col-md-3">Nama  produk</label>
			<div class="col-md-5">
				<input type="text" name="nmproduk" id="nmproduk" class="form-control" value="<?= $upnmalat;?>">
			</div>
		</div>
		<div class="row mb-1">
			<label class="col-md-3">Stock</label>
			<div class="col-md-5">
				<input type="number" name="stock" id="stock" class="form-control" value="<?= $upstock;?>">
			</div>
		</div>
		<div class="row mb-1">
			<label class="col-md-3">Harga</label>
			<div class="col-md-5">
				<input type="text" name="hrgproduk" id="hrgproduk" class="form-control" value="<?= $upharga;?>">
			</div>
		</div>
        <div class="row mb-1">
                <label class="col-md-3">Kategori produk</label>
                <div class="col-md-5">
                    <select name="katkopi" id="katkopi" class="form-control" required>
                        <option selected disabled>--Pilih Kategori produk--</option>
                        <?php
                        foreach ($qrykategorialat as $k) :
                            if ($k['idkategori'] === $dt['idkategori']) {
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                        ?>
                            <option value="<?= $k['idkategori']; ?>" <?= $select;?>><?= $k['nmkategori']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
        <div class="row mb-1">
			<label class="col-md-3">Deskripsi</label>
			<div class="col-md-5">
				<textarea type="text" name="deskripsi" id="deskripsi" class="form-control"><?=$dt['deskripsi']; ?></textarea>
			</div>
		</div>
        <div class="row mb-1">
			<label class="col-md-3">Foto</label>
			<div class="col-md-5">
                <input type="hidden" name="gambarlama" id="gambarlama" value="<?= $dt['gambar'];?>">
                <?php 
                    if($dt['gambar'] == ""){
                ?>
                    <input type="file" name="img" id="img" class="form-control">
                <?php 
                    } else {
                ?>
				<input type="file" name="img" id="img" class="form-control" value="<?= $dt['gambar'];?>">
                <img src="../asset/img/<?= $dt['gambar'];?>" class="img img-thumbnail mt-1" width="200px">
			<?php
                }
            ?>
            </div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" name="btnsubmit" id="btnsubmit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_produk"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
	</form>
<?php } ?>
<!--modal -->
<div class="modal fade" id="btnkonfirm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                apakah anda yakin ingin menyimpan?
            </div>
            <div class="modal-footer">
                <button type="button" name="btnbatal" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" name="btnsimpan" id="btnsimpan" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </div>
        </div>
<?php } ?>