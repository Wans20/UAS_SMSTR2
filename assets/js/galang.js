if (document.getElementById("formtransaksi")) {
  $("#produk").change(function () {
    let idproduk = $(this).val(); //idproduk
    //ini hanya digunakan untuk attribut data pada combobox
    let hrgproduk = $(this).find(":selected").data("harga");
    let stock = $(this).find(":selected").data("stock");
    //   console.log(idproduk + ":" + hrgproduk);
    $("#harga").val(hrgproduk);
    $("#stock").val(stock);
  });
  //hitung total
  $("#qty").on('keyup', function () {
    let qty = $(this).val();
    let stock = $('#produk').find(":selected").data("stock");
    if (qty > stock) {
      $("#total").val("Tidak boleh melebihi stock");
      $("#btnsubmit").prop('disabled', true);
    } else {
      let harga = $("#harga").val();
      let total = harga * qty;
      $("#total").val(total);
      $("#btnsubmit").prop('disabled', false);
    }
    // console.log(qty + stock + ":" + harga);
  });

  $('#btnsubmit').click(function () {
    let qty = $('#qty').val();
    if (qty < 1) {
      alert('Qty tidak boleh 0');
    } else {
      $('#modalsubmit').modal("show");
    }
  })

  $('#btnya').click(function () {
    $('#formtransaksi').attr("action", "?modul=mod_transaksi&action=save");
    $('#formtransaksi').submit();
  })
}