<?php
if (isset($_GET['action']) && ($_GET['action'] == "add")) {
    $judul = "Input your data";
} else if (isset($_GET['action']) && ($_GET['action'] == "edit")) {
    $judul1 = "Form Edit Data";
} else if (isset($_GET['action']) && ($_GET['action'] == "save")) {
    $nama = $_POST['nmkategori_ins'];
    mysqli_query($koneksidb, "INSERT INTO kategoriproduk (nmkategori) VALUES ('$nama')");
    header("Location: home.php?modul=mod_kategoriproduk");
} else if (isset($_GET['action']) && ($_GET['action'] == "update")) {
    $id = $_POST['idkategori_edt'];
    $nama_up = $_POST['nmkategori_edt'];
    mysqli_query($koneksidb, "UPDATE kategoriproduk SET nmkategori='$nama_up' WHERE idkategori='$id'");
    header("Location: home.php?modul=mod_kategoriproduk"); 
} else if (isset($_GET['action']) && ($_GET['action'] == "delete")) {
    $id = $_GET['id'];
    mysqli_query($koneksidb, "DELETE FROM kategoriproduk WHERE idkategori='$id'");
    header("Location: home.php?modul=mod_kategoriproduk");
}