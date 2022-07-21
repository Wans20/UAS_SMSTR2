<?php 
security_login();

if(!isset($_GET['action'])){
	$data_alat = mysqli_query($koneksidb,"select * from mst_produk");
	//untuk contoh generate kode		
}
else if(isset($_GET['action']) && $_GET['action'] == "add"){
	$proses = "insert";
}
else if(isset($_GET['action']) && $_GET['action'] == "edit"){
    $ids=$_GET['id'];
	$qry = mysqli_query($koneksidb,"select * from mst_produk where idproduk='$ids'");
	$dt = mysqli_fetch_array($qry);
    $id=$dt['idproduk'];
	$upidalat = $dt['idproduk'];
	$idproduk = $dt['idproduk'];
	$upnmalat = $dt['nmproduk'];
	// $upkatalat = $dt['id_katalat'];
	$upstock = $dt['stock'];
	$upharga = $dt['harga'];

	    $proses = "update";
}
else if(isset($_GET['action']) && $_GET['action'] == "save"){
	$proses = $_POST['proses'];
if($proses=="insert"){
    $idproduk = $_POST['idproduk'];
	$nmproduk = $_POST['nmproduk'];
	$idkategori = $_POST['katkopi'];
	$stock = $_POST['stock'];
	$hrg = $_POST['harga'];
	$desk = $_POST['deskripsi'];
    $file = $_FILES['img'];
		$target_dir = "../assets/img/";
		$target_file =  $target_dir.basename($file['name']);
		$type_file = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
		// echo $type_file."<br/>";
		$is_upload = 1;
		/* cek batas limit file maks.3MB*/
		if($file['size'] > 2000000){
			$is_upload = 0;
			pesan("File lebih dari 2MB!!");		
		}
		/**cek tipe file */
		if($type_file != "jpg" && $type_file != "png" ){
			$is_upload = 0;
			pesan("hanya tipe file jpg yang diperbolehkan!!");	
		}
		$namafile = "";
		/**proses upload */
		if($is_upload == 1){
			if(move_uploaded_file($file['tmp_name'], $target_file)){
				$namafile = $file['name'];
                mysqli_query($koneksidb,"INSERT INTO mst_produk (idproduk,nmproduk,gambar,idkategori,harga,stock,deskripsi) values ('$idproduk','$nmproduk','$namafile','$idkategori','$hrg','$stock','$desk')")or die(mysqli_error($koneksidb));
	            echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_produk">';
             
            }
			else if($is_upload == 0){
				pesan("GAGAL upload file gambar!!");
			}
        }
    }
	else if($proses == "update"){
        if ($_FILES['img']['name'] == "") {
            $id = $_POST['idproduk'];
            $nmalat = $_POST['nmalat'];
            $stock = $_POST['stock'];
            $hargasewa = $_POST['hargasewa'];
            $katalat = $_POST['katalat'];
            $namafile = $_POST['gambarlama'];
            $desk = $_POST['deskripsi'];
            mysqli_query($koneksidb, "UPDATE mst_alatsewa SET nm_alat='$nmalat',stock='$stock',hrg_alat='$hargasewa',id_katalat='$katalat',deskripsi='$desk',gambar='$namafile' WHERE id_alat = '$id' ") or die(mysqli_error($koneksidb));
            echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_produk">';
        } else {
            $file = $_FILES['img'];
            $target_dir = "../assets/img/";
            $target_file =  $target_dir . basename($file['name']);
            $type_file = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            // echo $type_file . "<br/>";
            $is_upload = 1;
            /* cek batas limit file maks.3MB*/
            if ($file['size'] > 3000000) {
                $is_upload = 0;
                pesan("File lebih dari 3MB!!");
            }
            /**cek tipe file */
            if ($type_file != "jpg" && $type_file != "png") {
                $is_upload = 0;
                pesan("hanya tipe file jpg/png yang diperbolehkan!!");
            }
            $namafile = "";
            /**proses upload */
            if ($is_upload == 1) {
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    $namafile = $file['name'];
                    $id = $_POST['idalat'];
                    $nmalat = $_POST['nmalat'];
                    $stock = $_POST['stock'];
                    $hargasewa = $_POST['hargasewa'];
                    $katalat = $_POST['katalat'];
                    $desk = $_POST['deskripsi'];
                    if ($namafile == $_POST['gambarlama']) {
                        $edit = mysqli_query($koneksidb, "UPDATE mst_alatsewa SET nm_alat='$nmalat',stock='$stock',hrg_alat='$hargasewa',id_katalat='$katalat',deskripsi='$desk',gambar='$namafile' WHERE id_alat = '$id' ") or die(mysqli_error($koneksidb));
                    } else {
                        $old = $_POST['gambarlama'];
                        $edit = mysqli_query($koneksidb, "UPDATE mst_alatsewa SET nm_alat='$nmalat',stock='$stock',hrg_alat='$hargasewa',id_katalat='$katalat',deskripsi='$desk',gambar='$namafile' WHERE id_alat = '$id' ") or die(mysqli_error($koneksidb));
                        unlink("../asset/img/$old");
                    }
                    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_produk">';
                } else {
                    pesan("GAGAL upload file gambar!!");
                }
            }
        }
    }
	
}else if(isset($_GET['action']) && $_GET['action'] == "delete"){
    $id=$_GET['id'];
    $qalat = mysqli_query($koneksidb,"SELECT gambar FROM mst_alatsewa WHERE id_alat='$id'");
    $qa = mysqli_fetch_array($qalat);
    $gambar=$qa['gambar'];
    mysqli_query($koneksidb,"DELETE FROM mst_alatsewa where id_alat='$id'");
    unlink("../asset/img/$gambar");
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_produk">';

}
function pesan($alert)
{
    echo '<script language="javascript">';
    echo 'alert("' . $alert . '")';  //not showing an alert box.
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_produk">';
}
?>