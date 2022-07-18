<?php 
security_login();

if(!isset($_GET['action'])){
	$data_member = mysqli_query($koneksidb,"select * from daftarmember ");

	//untuk contoh generate kode
// 	$query_cekkode = mysqli_query($koneksidb,
// 			"select kode_menu from mst_menu ORDER BY kode_menu DESC LIMIT 0,1");
// 	$cekkode = mysqli_fetch_array($query_cekkode);		
// 	$kodeakhir = $cekkode['kode_menu'];
// 	echo $kodeakhir."<br>";
// 	$no_urutakhir = substr($kodeakhir,5);
// 	echo $no_urutakhir."<br>";
// 	$th_akhir = substr($kodeakhir,1,4);
// 	$th_sekarang = date("Y");
// 	echo $th_akhir." : ".$th_sekarang."<br>";
// 	if($th_akhir == $th_sekarang){
// 		//$nourut_baru = $no_urutakhir + 1;
		
// 		if($no_urutakhir < 10){
// 			$nourut_baru = "00".($no_urutakhir + 1);
// 		}
// 		else if($no_urutakhir < 100){
// 			$nourut_baru = "0".($no_urutakhir + 1);
// 		}
// 		else{
// 			$nourut_baru = ($no_urutakhir + 1);
// 		}
// 		echo "kodenya:".$nourut_baru."<br>";
// 	}
// 	else{
// 		$nourut_baru =  "0001";
// 	}
// 	$kodeterbaru = "M".$th_sekarang.$nourut_baru;
// 	echo "kode: ".$kodeterbaru;
// 	//untuk contoh combo
// 	$data_produk = mysqli_query($koneksidb,"select * from mst_produk ");
// }
// else if(isset($_GET['action']) && $_GET['action'] == "add"){
// 	$nmmenu = "";
// 	$proses = "insert";
// 	$idmenu = 0 ;
// }
// else if(isset($_GET['action']) && $_GET['action'] == "edit"){
// 	$qry = mysqli_query($koneksidb,"select * from mst_menu where idmenu=".$_GET['id']." LIMIT 0,1");
// 	$dt = mysqli_fetch_array($qry);
// 	$idmenu = $dt['idmenu'];
// 	$nmmenu = $dt['nmmenu'];
// 	$proses = "update";
// }
// else if(isset($_GET['action']) && $_GET['action'] == "save"){
// 	$idmenu = $_POST['idmenu'];
// 	$nmmenu = $_POST['txtmenu'];
// 	$proses = $_POST['proses'];
// 	if($proses == "insert"){
// 		mysqli_query($koneksidb,"insert into mst_menu(nmmenu)values('$nmmenu')")or die(mysqli_error($koneksidb));
// 		echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_menu">';
// 	}
// 	else if($proses == "update"){
// 		mysqli_query($koneksidb,"update mst_menu set nmmenu='$nmmenu' where idmenu = $idmenu ")or die(mysqli_error($koneksidb));
// 		echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_menu">';
// 	}
}
?>