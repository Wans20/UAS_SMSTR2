if(document.getElementById('formuser')){
$("#btnsubmit").click(function () {
    let user = $("#user").val();
    let nama = $("#nama").val();
    let pass = $("#pass").val();
    let passkonfirm = $("#passkonfirm").val();
    let active = $("input[type='radio']:checked");
      if (user == ""||nama==null) {
        alert("username Wajib diisi!!");
      }else if(nama==""||nama==null){
        alert("nama lengkap wajib diisi");
      }else if(pass==""||pass==null){
        alert("password wajib diisi!");
      }else if(passkonfirm==""||passkonfirm==null){
        alert("silahkan konfirmasi password anda");
      }else if(pass!=passkonfirm){
        alert("password yang anda inputkan tidak sama!");
      }else if(active.length==""){
        alert("silahkahn pilih keaktifan");
      }else{
        $("#btnkonfirm").modal("show");
      }
  });
  $("#btnsimpan").click(function () {
    $("#formuser").attr("action", "?modul=mod_userlogin&action=save");
    $("#formuser").submit();
  });
}