<?php
include_once("contohCtrl.php");
if (!isset($_GET['action'])) {
?>
<hr>
<a href="?modul=mod_contoh&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
<table class="table table-bordered">
	<tr>
		<th width="70%">nama menu</th>
		<th>Action</th>
	</tr>
	<?php
		while ($d = mysqli_fetch_array($data_menu)) {
			echo '
			<tr>
				<td>' . $d['nmmenu'] . '</td>
				<td><a href="?modul=mod_contoh&action=edit&id=' . $d['idmenu'] . '"> Edit</a></td>
			</tr>
		';
		}

		?>

</table>
<hr>
<form action="" id="formcontoh">
	<div class="row">
		<label class="col-md-2">Kode </label>
		<div class="col-md-5">
			<input type="text" name="exkode" id="exkode" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
		</div>
	</div>
	<div class="row">
		<label class="col-md-2">Produk</label>
		<div class="col-md-5">
			<select name="exproduk" id="exproduk" class="form-control">
				<option value="">-Pilih Produk--</option>
				<?php
					while ($p = mysqli_fetch_array($data_produk)) {
						echo '<option value="' . $p['idproduk'] . '" 
					data-hargaaaa="' . $p['harga'] . '" data-stok="' . $p['stock'] . '">' . $p['nmproduk'] . '</option>';
					}
					?>
			</select>
		</div>
	</div>
	<div class="row">
		<label class="col-md-2">Harga </label>
		<div class="col-md-5">
			<input type="text" name="exharga" id="exharga" class="form-control" readonly>
		</div>
	</div>
	<div class="row">
		<label class="col-md-2">Qty </label>
		<div class="col-md-5">
			<input type="text" name="exqty" id="exqty" class="form-control">
		</div>
	</div>
	<div class="row">
		<label class="col-md-2">Total </label>
		<div class="col-md-5">
			<input type="text" name="extotal" id="extotal" class="form-control" readonly>
		</div>
	</div>
</form>

<hr class="mb-5">
<?php } else if (isset($_GET['action']) && 
($_GET['action'] == "add" || $_GET['action'] == "edit" || $_GET['action'] == "findtransaksi")) {
?>
<form action="?modul=mod_menu&action=save" method="POST">
	<hr>
	<h4>Contoh Case menampilkan data transaksi berdasarkan member</h4>
	<select name="ex_member" id="ex_member" class="form-control">
		<option value="">-Pilih Member--</option>
		<?php
		while ($p = mysqli_fetch_array($data_member)) {
			echo '<option value="' . $p['idmember'] . '">' . $p['nm_member'] . '</option>';
		}
	?>
	</select>
	<hr>
	<input type="hidden" name="idmenu" value="<?= $idmenu; ?>">
	<input type="text" name="proses" value="<?= $proses; ?>">
	<input type="text" name="txtmenu" value="<?= $nmmenu; ?>">
	<textarea name="xx" id="deskripsis" cols="30" rows="10"></textarea>
	<button type="submit">ok</button>
</form>
<?php
}
?>