<?php
include_once("loginctrl.php");
if (!isset($_GET['action'])) {
?>
	<a href="?modul=mod_userlogin&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
	<table class="table table-bordered">
		<tr>
			<th>id  user</th>
			<th>username</th>
			<th>nama  lengkap</th>
			<th>password</th>
			<th>is active</th>
			<th>Action</th>
		</tr>
		<?php
        $listuser=mysqli_query($koneksidb,"SELECT  * from mst_userlogin");
		while ($list = mysqli_fetch_array($listuser)) {
		?>
        <tr>
            <td><?=$list['iduser']; ?></td>
            <td><?=$list['username']; ?></td>
            <td><?=$list['nama_lengkap']; ?></td>
            <td><?=$list['password']; ?></td>
            <td><?=$list['is_active']; ?></td>
            <td> 
                <a href="?modul=mod_userlogin&action=edit&id=<?=$list['iduser']; ?>" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>edit</a>
                <a href="?modul=mod_userlogin&action=delete&id=<?=$list['iduser']; ?>" class="btn btn-danger">
                        <i class="bi bi-trash"></i>delete</a>
            </td>
        </tr>
        <?php } ?>
	</table>
	<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
        if($proses=="insert"){
    ?>
	<form action="?modul=mod_userlogin&action=save" id="formuser" method="POST">
        <div class="row">
			<label class="col-md-3">username</label>
			<div class="col-md-5">
            <input type="hidden" name="proses" value="<?= $proses; ?>">
            <input type="hidden" name="iduser" value="<?= $upiduser; ?>">
				<input type="text" name="user" id="user" class="form-control" >
			</div>
		</div>
		<div class="row">
			<label class="col-md-3">Nama Lengkap</label>
			<div class="col-md-5">
				<input type="text" name="nama" id="nama" class="form-control" >
			</div>
		</div>
		<div class="row">
			<label class="col-md-3">Password</label>
			<div class="col-md-5">
				<input type="password" name="pass" id="pass" class="form-control" >
			</div>
		</div>
        <div class="row">
			<label class="col-md-3">Confirm Password</label>
			<div class="col-md-5">
				<input type="password" name="passkonfirm" id="passkonfirm" class="form-control" >
			</div>
		</div>
		<div class="row">
			<label class="col-md-3">Is Active</label>
			<div class="col-md-5">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isactive" id="isactive" value="1">
                    <label class="form-check-label">
                        Aktif
                    </label>
                    </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isactive" id="isactive" value="0" >
                    <label class="form-check-label" >
                        Not Active
                    </label>
                    </div>
                </div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" id="btnsubmit" class="btn btn-primary" data-bs-toggle="modal">Simpan</button>
                    <a href="home.php?modul=mod_userlogin"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
	</form>
<?php }else{ ?>
    <form action="?modul=mod_userlogin&action=save" id="formuser" method="POST">
        <?php if($proses=="update"){ ?>
        <div class="row">
			<label class="col-md-3">username</label>
			<div class="col-md-5">
            <input type="hidden" name="proses" value="<?= $proses; ?>">
            <input type="hidden" name="iduser" value="<?= $upiduser; ?>">
				<input type="text" name="user" id="user" class="form-control" value="<?= $upuser?>" readonly>
			</div>
		</div>
        <?php } ?>
		<div class="row">
			<label class="col-md-3">nama  lengkap</label>
			<div class="col-md-5">
				<input type="text" name="nama" id="nama" class="form-control" value="<?= $upnama?>">
			</div>
		</div>
		<div class="row">
			<label class="col-md-3">password</label>
			<div class="col-md-5">
				<input type="password" name="pass" id="pass" class="form-control" value="<?= $uppass?>">
			</div>
		</div>
		<div class="row">
			<label class="col-md-3">confirm password</label>
			<div class="col-md-5">
				<input type="password" name="passkonfirm" id="pass" class="form-control" value="<?= $uppass?>">
			</div>
		</div>
		<div class="row">
			<label class="col-md-3">is active</label>
			<div class="col-md-5">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isactive" id="isactive" value="1" <?=($dt['is_active'] == 1)?"checked" : "";?>>
                    <label class="form-check-label">
                        aktif
                    </label>
                    </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isactive" id="isactive" value="0" <?=($dt['is_active'] == 0)?"checked" : "";?>>
                    <label class="form-check-label" >
                        tidak aktif
                    </label>
                    </div>
                </div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_userlogin"><button type="button" class="btn btn-warning">Kembali</button></a>
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
                <button type="button" name="btnbatal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" name="btnsimpan" id="btnsimpan" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </div>
        </div>
<?php } ?>
