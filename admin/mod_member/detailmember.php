<?php
include_once("daftarCtrl.php");
if (isset($_GET['profile'])) {
?>
<?php
	    while ($d = mysqli_fetch_array($data_member)) {
            if(isset($_GET['id']) && ($_GET['id']==$d['idmember'])){
                // $tgl=date_create($d['tgl_lhr']);
    ?>

<div class="container">
	<div class="row mb-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 400;">
		<div class="col-md-4">
			<img src="../assets/img/<?=$d['foto'] ?>" class="rounded" width="200px" height="250vh">
		</div>
		<div class="col-md-8">
			<ul class="list-group">
				<li class="list-group-item"><?=$d['kode_member'];?> (kode member)</li>
				<li class="list-group-item">Nama : <?=$d['nm_member'];?></li>
				<li class="list-group-item">Email :<?=$d['email'];?></li>
				<li class="list-group-item">Password : <?=$d['password'];?></li>
				<li class="list-group-item">Tanggal daftar : <?=date_format(new DateTime($d['tgl_daftar']), 'd-m-Y');?>
				</li>
				<li class="list-group-item">Tanggal Lahir : <?=$d['tgl_lhr'];?></li>
				<li class="list-group-item">No.Telp : <?=$d['no_telp'];?></li>
				<li class="list-group-item">Alamat : <?=$d['alamat'];?></li>
				<li class="list-group-item">Jenis Kelamin : <?=$d['jk'];?></li>
			</ul>
		</div>
	</div>
	<?php 
            }
        }
    }else if(isset($_GET['history'])){
        while ($d = mysqli_fetch_array($data_member)) {
        if(isset($_GET['id']) && ($_GET['id']==$d['idmember'])){
                ?>
	<div class="row">
		<div class="col-md-10">
			<h3>History transaksi</h3>
			<table class="table table-bordered">
				<tr>
					<th>tanggal transaksi</th>
					<th>no Invoice</th>
					<th>Total</th>
					<th>status bayar</th>
					<th>status transaksi</th>
				</tr>
				<?php
                                    $idk=$_GET['id'];
                                        $historytsk =  mysqli_query($koneksidb,"select a.tgl_transaksi,a.no_invoice, a.total, a.is_bayar, a.is_closed from tst_penjualan a inner join daftarmember b on a.idmember=b.idmember where a.idmember='$idk'") or die(mysqli_error($koneksidb));
                                        while($hst=mysqli_fetch_array($historytsk)){
                                    ?>
				<tr>
					<td><?= $hst['tgl_transaksi'];?></td>
					<td><?= $hst['no_invoice'];?></td>
					<td>Rp.<?= number_format($hst['total'],2,',','.');?></td>
					<td><?=($hst['is_bayar'] == 1)?"lunas" : "belum lunas";?></td>
					<td><?=($hst['is_closed'] == 1)?"selesai" : "proses";?></td>
				</tr>
			</table>
			<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
<?php }?>
<?php }?>