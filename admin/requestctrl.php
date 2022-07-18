<?php
if (isset($_GET['act']) && ($_GET['act']== "update" || $_GET['act']== "save")){
require_once('../config/koneksidb.php') ;
require_once('../config/config.php') ;
}else{
    require_once('../config/koneksidb.php') ;
    require_once('../config/config.php') ;
}
if (isset($_GET['act']) && ($_GET['act']== "edit")){
    $judul = "Konfirmasi Request Ganti Password" ;
    $idkey = $_GET['id'];
    $qdata = mysqli_query($koneksidb,"select * from tst_request where id_request=$idkey") or die(mysqli_error($koneksidb));
    $data = mysqli_fetch_array($qdata);
}else if(isset($_GET['act']) && ($_GET['act']== "update")){
        $idrequest= $_POST['id_request'];
        $username = $_POST['username'];
        $pass = $_POST['password_baru'];
        $quser = mysqli_query($koneksidb,"SELECT username FROM mst_userlogin WHERE username='".$_POST['username']."'");
		$row = mysqli_fetch_array($quser);
			if($username != $row['username']){
				header("Location: http://localhost/latihanweb_ecomm/admin/home.php");
        	}else{
				$qinsert = mysqli_query($koneksidb,"UPDATE mst_userlogin SET password='$pass' WHERE username='$username'")
                 or die (mysqli_error($koneksidb));
                 if($qinsert){
                      $qdelete = mysqli_query($koneksidb,"DELETE from tst_request where id_request=$idrequest")or die(mysqli_error($connect_db));
                 header("Location: http://localhost/latihanweb_ecomm/admin/home.php");
              }
			}
        //$qinsert = mysqli_query($koneksidb,"UPDATE mst_userlogin SET password='$pass' WHERE username='$username'")
      //  or die (mysqli_error($koneksidb));    
    }
    ?>