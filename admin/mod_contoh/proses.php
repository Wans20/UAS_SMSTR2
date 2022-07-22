<?php 
session_start();
require_once("../../config/koneksidb.php");
require_once("../../config/config.php");
security_login();
$qry = mysqli_query($koneksidb,"select * from tst_penjualan where idmember=".$_POST['member']." LIMIT 0,1");
$dt = mysqli_fetch_array($qry);
echo json_encode($dt);
?>