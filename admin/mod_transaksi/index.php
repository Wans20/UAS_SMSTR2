<?php
include_once("transaksiCtrl.php");
function rupiah($angka)
{
    $hasil_rupiah = "Rp." . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
if (!isset($_GET['action'])) {
?>
    <a href="?modul=mod_transaksi&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
    <table class="table table-bordered">
        <tr>
            <th>Kode Invoice</th>
            <th>Tanggal Transaksi</th>
            <th>Nama Produk</th>
            <th>Nama Member</th>
            <th>Total</th>
            <th>Status Bayar</th>
            <th>Status Pesanan</th>
            <th>Action</th>
        </tr>
        <?php
        $list_penjualan = mysqli_query($koneksidb, "SELECT t.no_invoice,p.nmproduk,m.nm_member,t.total,t.tgl_transaksi,t.is_bayar,t.is_closed FROM tst_penjualan t INNER JOIN daftarmember m ON t.idmember = m.idmember INNER JOIN mst_produk p ON t.idproduk = p.idproduk");
        foreach ($list_penjualan as $lp) :
        ?>
            <tr>
                <td><?= $lp['no_invoice']; ?></td>
                <td><?= $lp['tgl_transaksi']; ?></td>
                <td><?= $lp['nmproduk']; ?></td>
                <td><?= $lp['nm_member']; ?></td>
                <td><?= rupiah($lp['total']); ?></td>
                <td><?= ($lp['is_bayar'] == 1) ? "Lunas" : "Belum Lunas" ?></td>
                <td><?= ($lp['is_closed'] == 1) ? "Selesai" : "Proses" ?></td>
                <td>
                    <?php
                    if ($lp['is_bayar'] == 1) {
                    ?>
                        <a href="?modul=mod_transaksi&action=edit&id=<?= $lp['no_invoice']; ?>" class="btn btn-xs btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a href="?modul=mod_transaksi&action=delete&id=<?= $lp['no_invoice']; ?>" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i> Delete</a>
                    <?php
                    } else {
                    ?>
                        <a href="?modul=mod_transaksi&action=edit&id=<?= $lp['no_invoice']; ?>" class="btn btn-xs btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
    <hr>
<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
?>
    <?php
    $query_member = mysqli_query($koneksidb, "SELECT idmember,kode_member,nm_member FROM daftarmember");
    $query_cekkode = mysqli_query(
        $koneksidb,
        "select no_invoice from tst_penjualan ORDER BY no_invoice DESC LIMIT 0,1"
    );
    $cekkode = mysqli_fetch_array($query_cekkode);
    if (mysqli_num_rows($query_cekkode) == 0) {
        $kodeakhir = "INV-";
    } else {
        $kodeakhir = $cekkode['no_invoice'];
    }
    // echo $kodeakhir . "<br>";
    $no_urutakhir = substr($kodeakhir, 8);
    // echo $no_urutakhir . "<br>";
    $th_akhir = substr($kodeakhir, 4, 4);
    $th_sekarang = date("Y");
    // echo $th_akhir . " : " . $th_sekarang . "<br>";
    if ($th_akhir == $th_sekarang) {
        //$nourut_baru = $no_urutakhir + 1;

        if ($no_urutakhir < 9) {
            $nourut_baru = "000" . ($no_urutakhir + 1);
        } else if ($no_urutakhir < 99) {
            $nourut_baru = "00" . ($no_urutakhir + 1);
        } else if ($no_urutakhir < 999) {
            $nourut_baru = "0" . ($no_urutakhir + 1);
        } else {
            $nourut_baru = ($no_urutakhir + 1);
        }
        // echo "kodenya:" . $nourut_baru . "<br>";
    } else {
        $nourut_baru =  "0001";
    }
    $kodeterbaru = "INV-" . $th_sekarang . $nourut_baru;
    // echo "kode: " . $kodeterbaru;
    $data_produk = mysqli_query($koneksidb, "select * from mst_produk");
    ?>
    <?php
    if ($proses == "insert") {
    ?>
        <form action="?modul=mod_transaksi&action=save" id="formtransaksi" method="POST" enctype="multipart/form-data">
            <div class="row">
                <label class="col-md-2">Kode</label>
                <div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="text" name="kode" id="kode" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Member</label>
                <div class="col-md-5">
                    <select name="member" id="member" class="form-control">
                        <?php
                        foreach ($query_member as $m) :
                        ?>
                            <option value="<?= $m['idmember']; ?>"><?= $m['nm_member']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Produk</label>
                <div class="col-md-5">
                    <select name="produk" id="produk" class="form-control" required>
                        <option value="" selected disabled>--Pilih Produk--</option>
                        <?php
                        foreach ($data_produk as $p) :
                        ?>
                            <option value="<?= $p['idproduk']; ?>" data-harga="<?= $p['harga']; ?>" data-stock="<?= $p['stock']; ?>"><?= $p['nmproduk']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Stock</label>
                <div class="col-md-5">
                    <input type="text" name="stock" id="stock" class="form-control" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Harga</label>
                <div class="col-md-5">
                    <input type="text" name="harga" id="harga" class="form-control" readonly required>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Qty</label>
                <div class="col-md-5">
                    <input type="number" name="qty" id="qty" class="form-control" min="1" required>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Total</label>
                <div class="col-md-5">
                    <input type="text" name="total" id="total" class="form-control" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Status Bayar</label>
                <div class="col-md-5">
                    <input class="form-check-input" type="checkbox" id="statusbayar" name="statusbayar">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Status Pesanan</label>
                <div class="col-md-5">
                    <input class="form-check-input" type="checkbox" id="statuspesanan" name="statuspesanan">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Bukti Pembayaran</label>
                <div class="col-md-5">
                    <input type="file" id="bukti" name="bukti" class="form-control">
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2"></label>
                <div class="col-md-5">
                    <button type="button" id="btnsubmit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_transaksi"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <form action="?modul=mod_transaksi&action=save" id="formtransaksi" method="POST" enctype="multipart/form-data">
            <?php
            // $qry = mysqli_query($koneksidb, "select * from tst_penjualan where no_invoice='$kode' LIMIT 0,1");
            $qry = mysqli_query($koneksidb, "SELECT a.*, b.nm_member, c.nmproduk FROM tst_penjualan a INNER JOIN daftarmember b ON a.idmember = b.idmember INNER JOIN mst_produk c ON a.idproduk = c.idproduk WHERE no_invoice='$kode'");
            $dt = mysqli_fetch_array($qry);
            ?>
            <div class="row pt-3">
                <label class="col-md-2">Kode Invoice</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="kodeinvoice" name="kodeinvoice" value="<?= $dt['no_invoice']; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Tanggal Transaksi</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="tgl_transaksi" name="tgl_transaksi" value="<?= date_format(new DateTime($dt['tgl_transaksi']), 'd-m-Y'); ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Nama Produk</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="nm_produk" name="nm_produk" value="<?= $dt['nmproduk']; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Nama Member</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="nm_member" name="nm_member" value="<?= $dt['nm_member']; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Qty</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="qty" name="qty" value="<?= $dt['qty']; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Harga</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="harga" name="harga" value="<?= $dt['harga']; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Total</label>
                <div class="col-md-5">
                    <input class="form-control" type="text" id="total" name="total" value="<?= $dt['total']; ?>" readonly>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Status Bayar</label>
                <div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="hidden" name="no_invoice" value="<?= $id; ?>">
                    <input class="form-check-input" type="checkbox" id="statusbayar" name="statusbayar" <?= $dt['is_bayar'] == 1 ? "checked" : "" ?>>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Status Pesanan</label>
                <div class="col-md-5">
                    <input class="form-check-input" type="checkbox" id="statuspesanan" name="statuspesanan" <?= $dt['is_closed'] == 1 ? "checked" : "" ?>>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2">Bukti Pembayaran</label>
                <div class="col-md-5">
                    <input type="hidden" name="gambarlama" value="<?= $dt['buktipembayaran']; ?>">
                    <?php
                    if ($dt['buktipembayaran'] == "") {
                    ?>
                        <input type="file" id="buktipembayaran" name="buktipembayaran" class="form-control">
                    <?php
                    } else {
                    ?>
                        <img src="../assets/img/<?= $dt['buktipembayaran']; ?>" class="img img-thumbnail mb-3" width="150px" alt="">
                        <input type="file" id="buktipembayaran" name="buktipembayaran" class="form-control">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row pt-3">
                <label class="col-md-2"></label>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_transaksi"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
        </form>
    <?php } ?>
    <div class="modal" tabindex="-1" id="modalsubmit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btntidak" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" id="btnya" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>