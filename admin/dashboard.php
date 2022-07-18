<?php
     include_once ('requestctrl.php');
  ?>
        <?php
        if(!isset($_GET['act'])){
        ?>
        <h3 class="text-center"> Daftar Request Password User </h3>
        <table class="table table-bordered "> 
            <tr> 
                <th> tanggal </th>
                <th> Username </th>
                <th> Password Baru </th>
                <th> Action </th>
            <?php
            $qry_listmenu= mysqli_query($koneksidb,"select * from tst_request order by id_request DESC")or die("gagal akses tabel mst_blog".mysqli_error($koneksidb));
            while($row = mysqli_fetch_array($qry_listmenu)){
            ?>
            <tr>
                <td><?php echo date('d/m/Y',strtotime($row['date_request']));?></td>
                <td><?= $row['username']; ?></td>
                <td><?php echo $row['password_baru']; ?></td>
                <td>
                    <div class="d-grid gap-1 d-md-block">
                    <a href="?page=requestctrl&act=edit&id=<?= $row['id_request']; ?>" class="btn btn-xs btn-primary"> <i class="bi bi-pencil-square" > </i> detail </a>
                    </div>
            </td>
            </tr>
            <?php
            }
            ?>
  <?php
        }
        else if (isset($_GET['act']) && ($_GET['act']== "edit")){
        ?>
            <div class="row">
                <h3 class="text-center"><?php echo $judul; ?></h3>
                <form action="?page=requestctrl&act=update" method="post">
                <div class="row pt-2">
                <div class="col-md-2"> 
            </div>  
            <div class="col-md-5"> 
                <input type="hidden"name="id_request" class="form-control" value="<?php echo $data['id_request'];?>">  
                </div>
                <div class="col-md-1"></div>
                </div>
                <div class="row pt-2">
                <div class="col-md-2"> 
                <label for="username" class="form-label" name="judul" >Username </label>
            </div>  
            <div class="col-md-5"> 
                <input  readonly  type="text" name="username" class="form-control" value="<?php echo $data['username'];?>">  
                </div>
                <div class="col-md-1"></div>
                </div>
                <div class="row pt-2">
                <div class="col-md-2"> 
                <label for="username" class="form-label" name="judul" >Password </label>
            </div>  
            <div class="col-md-5"> 
                <input  readonly  type="text" name="password_baru" class="form-control" value="<?php echo $data['password_baru'];?>">  
                </div>
                <div class="col-md-1"></div>
                </div>  
                <div class="row pt-2">
                <div class="col-md-2">
                    </div>  
                <div class="col-md-5"> 
                <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary" type="submit"><i class="bi bi-download" name="simpan" > </i> ACC Request </button>
                </div>
                <div class="col-md-1"></div>
                </div>
                </form> 
            </div>  
            </div>
            <?php
            }