<?php
if(isset($_GET['act']) && ($_GET['act']== "add")){
	//jika ada send variabel act=add, tampil form input/tambah
	$judul = "Form Input Data";
	//ini untk isi combo
	$listkategori = mysqli_query($connect_db,"select * from mst_kategoriproduk")or die("gagal akses table mst_kategoriproduk ".mysqli_error($connect_db));
	$idproduk = 0;
	$nmproduk= "";		
	$idkategori = 0;
    $harga = 0;
    $stock = 0;
    $kondisi = "";
    $deskripsi = "";
    $berat ="";
	$action = "insert";
	$gambar = "";
}
else if(isset($_GET['act']) && ($_GET['act']== "edit")){
	//jika ada send variabel act=add, tampil form input/tambah
	$judul = "Form Edit Data";
	$idkey = $_GET['id']; //dapat dari URL
	$listkategori = mysqli_query($connect_db,
			"select * from mst_kategoriblog where is_active = 1 order by id_kategori DESC")
			or die("gagal akses table mst_menu ".mysqli_error($connect_db));
	$qdata = mysqli_query($connect_db,"select m.*, k.nm_kategori from mst_blog m 
				inner join mst_kategoriblog k on m.id_kategori=k.id_kategori where id_blog=$idkey")
			or die(mysqli_error($connect_db));
	$data = mysqli_fetch_array($qdata);
	$idblog = $data['id_blog'];
	$judulblog= $data['judul'];		
	$idkategori = $data['id_kategori'];
	$isi = $data['isi'];
	$tanggal = $data['date_input'];
	$action = "update";
	$gambar = $data['gambar'];
}
else if(isset($_GET['act']) && ($_GET['act']== "save")){
	//jika ada send variabel act=save, ketika proses simpan(insert)
	/*cek upload file terlebih dahulu */
	if(!empty($_FILES['filegambar'])){
		$file = $_FILES['filegambar']; 
		$target_dir = "../../assets/img/";
		$target_file =  $target_dir.basename($file['name']);
		$type_file =strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
		echo $type_file."<br/>";
		$is_upload = 1;
		/* cek batas limit file maks.3MB*/
		if($file['size'] > 5000000){
			$is_upload = 0;
			pesan("File lebih dari 5MB!!");		
		}
		/**cek tipe file */
		if($type_file != "jpg" && $type_file != "png"){
			$is_upload = 0;
			pesan("Tipe file bukan file gambar!!");	
		}
		$namafile = "";
		/**proses upload */
		if($is_upload == 1){
			if(move_uploaded_file($file['tmp_name'], $target_file)){
				$namafile = $file['name'];
			}
			else{
				pesan("GAGAL upload file gambar!!");	
			}
		}
	}else{
		if($_POST['action'] == "update"){
			$namafile = $_POST['gambar'];
		}else{
			$namafile = "";
		}
		
	}

	$idblog = $_POST['idblog'];		
	$idkategori = $_POST['kategori'];
	$judul = $_POST['judul'];
	$isi = $_POST['isi'];
	$tanggal = $_POST['tanggal'];
	$tglblog = date("Y-m-d", strtotime($tanggal));  
	$author = $_POST['author'];

	//query untuk simpan
	if($_POST['action'] == "insert" ){
		$qinsert = mysqli_query($connect_db, 
			"INSERT into mst_blog(judul,id_kategori,isi,author,date_input,gambar) 
			VALUES('$judul','$idkategori','$isi','$author','$tglblog','$namafile')")
			or die (mysqli_error($connect_db));
		if($qinsert){
			//ketik proses simpan berhasil
			header("Location: http://localhost/latihan_webphp/admin/home.php?modul=mod_blog");
		}
	}
	else{
		$qupdate = mysqli_query($connect_db, 
			"UPDATE mst_blog SET judul='$judul' ,id_kategori='$idkategori', isi='$isi', 
			author='$author', date_input='$tglblog', gambar='$namafile' WHERE id_blog='$idblog'")
			or die (mysqli_error($connect_db));
		if($qupdate){
			//ketik proses simpan berhasil
			header("Location: http://localhost/latihan_webphp/admin/home.php?modul=mod_blog");
		}
	}
}