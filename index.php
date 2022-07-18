<?php 
	require_once("config/koneksidb.php");
	require_once("config/config.php");
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Coffe Shop</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="assets/styles.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
</head>

<body style="background-color: black;">
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg" style="background-color: black;">
		<div class="container pe-5 ps-5">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a href="index.php" class="nav-link">HOME</a>
				</li>
				<li class="nav-item">
					<a href="?page=halamanProduk" class="nav-link">PRODUCT</a>
				</li>
			</ul>

			<div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0 fontnav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="?page=daftarmember">Daftar Member</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- banner -->
	<section id="header">
	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"  aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label= "Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/img/1.jpg" class="w-100" width="800px" height="350px" alt="img"/>
          <div class="carousel-caption d-none d-md-block">
            <h1>- KEHIDUPAN -</h1>
            <h6>"Salah satu media yang bisa jadi pedoman hidup untuk manusia kedepannya"</h6>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/img/2.jpg" class="w-100" width="800px" height="350px" alt="img"/>
          <div class="carousel-caption d-none d-md-block">
            <h1>- LADANG -</h1>
            <h6>"Sebuah informasi banyak kita temui dengan cara membaca, salah satunya media adalah BUKU"</h6>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/img/3.jpg" class="w-100" width="800px" height="350px" alt="img"/>
          <div class="carousel-caption d-none d-md-block">
            <h1>- PENENTU -</h1>
            <h6>"Selain Tuhan, buku pun ikut menentukan nasib pembacanya di masa depan"</h6>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <br />
	</section>
	<!-- konten -->
	<section id="konten ">
		<?php 
			if(isset($_GET['page'])){
				include_once("".$_GET['page'].".php");
			}
			else{
				include_once("home.php");
			}
		 ?>
	</section>
	<!-- footer -->
    <div class="container-fluid text-white">
      <div class="row" style="background-color: rgb(0, 0, 0)">
        <div class="col-md-6">
          <br />
          <h5 style="text-align: center">STORE</h5>
          <hr/>
          <p><i class="bi bi-house-fill"></i> Street Rejosari Gg.01 Rt.05 Rw.03, No.04,Benowo, Pakal, Surabaya, Jawa Timur, Indonesia</p>
          <p><i class="bi bi-alarm-fill"></i> 07.00 WIB / 17.00 WIB</p>
          <p><i class="bi bi-telephone-fill"></i><a href="+6282139873061" class="text-white" target="blank">082139873061</a></p>
          <p><i class="bi bi-envelope-fill"></i><a href="mailto:wans200102@gmail.com" class="text-white" target="blank">wans200102@gmail.com</a></p>
        </div>

        <div class="col-md-6">
          <br/>
          <h5 style="text-align: center">SOSMED</h5>
          <hr/>
          <div class="row text-center">
            <div class="col-3 text-success">
              <p><i class="bi bi-whatsapp"></i><a href="http://wa.me/+6282139873061"class="text-white"target="_blank"><br />082139873061</a></p>
            </div>
            <div class="col-3 text-danger">
              <p><i class="bi bi-instagram"></i><a href="https://www.instagram.com/a_wan_s/" class="text-white" target="_blank"><br />a_wan_s</a></p>
            </div>
            <div class="col-3 text-info">
              <p><i class="bi bi-twitter"></i><a href=" https://twitter.com/mampir_hidup?t=VCl8rPUMKM8IGYdgaVdXwg&s=08" class="text-white" target="_blank"><br />@mampir_idup</a></p>
            </div>
            <div class="col-3 text-primary">
              <p> <i class="bi bi-facebook"></i><a href="https://www.facebook.com/profile.php?id=100010256894133" class="text-white" target="_blank"><br />Agung Setiawan</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
	<!-- modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form class="bg-light p-5" action="ceklogin.php" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Form Login</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-4">
							<label for="username" class="form-label">Username</label>
							<input type="text" name="username" class="form-control" id="logusername" />
						</div>
						<div class="mb-4">
							<label for="password" class="form-label">Password</label>
							<input type="password" name="password" class="form-control" id="logpassword" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnbatal" class="btn btn-secondary"
							data-bs-dismiss="modal">Batal</button>
						<button type="submit" name="btnlogin" id="btnkeluar" class="btn btn-primary">Login</button>
					</div>
					<div class="row mb-3">
						<div class="col-md-5 text-end">
							<a href="?page=lupapassword" class="btn btn-primary">Lupa Password?</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- js -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="assets/proses.js"></script>
	<script src="assets/js/adit.js"></script>
	<script src="assets/js/sulthan.js"></script>
	<script src="assets/js/galang.js"></script>
	<script src="assets/js/ardi.js"></script>
	<script src="assets/js/agung.js"></script>
	<script src="assets/js/putra.js"></script>
</body>

</html>