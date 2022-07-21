$("#btnsimpan").click(function () {
    let nmkategori = $("#nmkategori_ins").val();
    if (nmkategori == "") {
      alert("nama kategori Wajib diisi!!");
    } else {
      $("#ModalKonfirmasi").modal("show");
    }
  });
  $("#btnyes").click(function () {
    $("#kategori_produk").attr("action", "?modul=mod_kategoriproduk&action=save");
    $("#kategori_produk").submit();
  });

  $("#btnsimpan_edit").click(function () {
    let nmkategori = $("#nmkategori_edt").val();
    if (nmkategori == ""||nmkategori == null) {
      alert("nama kategori Wajib diisi!!");
    } else {
      $("#ModalKonfirmasi2").modal("show");
    }
  })
  $("#btnyes_edit").click(function () {
    $("#kategoriproduk_edit").attr("action", "?modul=mod_kategoriproduk&action=update");
    $("#kategoriproduk_edit").submit();
  });
  // $("#btnsave").click(function () {
  //   let nmproduk = $("#nmproduk_ins").val();
  //   let image = $("#img_add").val();
  //   let idkategori = $("#idkategori_ins").val();
  //   let price = $("#harga_ins").val();
  //   let stock = $("#stock_ins").val();
  //   let kondisi = $("#kondisi_ins").val();
  //   let deskripsi = $("#deskripsi").val();
  //   let berat = $("#berat_ins").val();
  //     if (nmproduk == ""||nmproduk==null) {
  //       alert("nama Wajib diisi!!");
  //     }else if(image==""||image==null){
  //       alert("email wajib diisi");
  //     }else if(idkategori==""||idkategori==null){
  //       alert("password wajib diisi!");
  //     }else if(price==""||price==null){
  //       alert("silahkan konfirasi password anda!");
  //     }else if (stock==""||stock==null){
  //       alert("silahkan masukkan tanggal lahir anda !!");
  //     }else if(kondisi==""||kondisi==null){
  //       alert("silahkan masukkan no telp anda");
  //     }else if(deskripsi==""||deskripsi==null){
  //       alert("silahkan masukkan alamat anda");
  //     }else if(berat==""||berat==null){
  //       alert("silahkan pilih jenis kelamin anda");
  //     }else{
  //       $("#ModalKonfirmasi1").modal("show");
  //     }
  // });
  // $("#btnyess").click(function () {
  //   $("#formproduk").attr("action", "?modul=mod_produk&action=save");
  //   $("#formproduk").submit();
  // });