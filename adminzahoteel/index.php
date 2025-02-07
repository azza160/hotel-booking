
<!-- kode html untuk menyimpan beberapa link library yang digunakan -->
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	</head>
	<body>
	
	</body>
	</html>

<!-- end kode html -->


<?php

	require "function/function.php" ;

	
	
	//jika tombol show all ditekan
	if(isset($_POST['showall'])){
		header('Location: index.php') ;
	}

	//jika tombol tambah data ditekan
	if(isset($_POST['add'])){
        if(tambah($_POST) > 0){
            echo"     
                <script>
					Swal.fire({
						title: 'Sukses',
						text: 'Data berhasil ditambahkan',
						icon: 'success'
					}).then(() => {
						window.location.href = 'index.php';
					});
					
                </script> ";
        }
        else{
            echo"     
				<script>
					Swal.fire({
						title: 'Gagal',
						text: 'Data tidak berhasil ditambahkan',
						icon: 'error'
					}).then(() => {
						window.location.href = 'index.php';
					});
				</script> ";     
        	
        }
	}


	//jika tombol delete ditekan
	if(isset($_GET['delete'])){
		$idhotel = $_GET['id'] ;
		if (hapus($idhotel) > 0) {
			echo "
			<script>
				Swal.fire({
					title: 'Sukses',
					text: 'Data berhasil dihapus',
					icon: 'success'
				}).then(() => {
					window.location.href = 'index.php';
				});
			</script>";
		} else {
			echo "
			<script>
				Swal.fire({
					title: 'Gagal',
					text: 'Data tidak berhasil dihapus',
					icon: 'error'
				}).then(() => {
					window.location.href = 'index.php';
				});
			</script>";
		}
	}


	//jika tombol save ditekan
	if(isset($_POST['ubah'])){
		if(ubah($_POST) > 0){
			echo "
				<script>
					Swal.fire({
						title: 'Sukses',
						text: 'Data berhasil diubah',
						icon: 'success'
					}).then(() => {
						window.location.href = 'index.php';
					});
				</script>";			
		}
		else{
			echo "
				<script>
					Swal.fire({
						title: 'Gagal',
						text: 'Data tidak berhasil diubah',
						icon: 'error'
					}).then(() => {
						window.location.href = 'index.php';
					});
				</script>";			
		}
	}

	//cek apakah tombol cetak ditekan
	if(isset($_POST['cetak'])){
		header("Location:pdf/pdf.php") ;
	}

	$nomor = 1 ;

    //jika user mencari data
    if(isset($_GET['cari'])){
        //ambil data dari cari
        $cari = $_GET['cari'] ;
        //tentukan ada berapa total data yang sudah dicari
        $total_data = count(tampil("SELECT * FROM hotel WHERE nama LIKE '%$cari%' OR lokasi LIKE '%$cari%' ")) ;
        //tetukan ada berapa data disetiap halaman
        $dataperhalaman = 5 ;
        //tentukan akan berapa halaman nantinya
        $totalhalaman = ceil($total_data / $dataperhalaman) ;
        //tentukan web yang sedang aktif
        if(isset($_GET['hal'])){
            $halaktif = $_GET['hal'] ;
        }
        else{
            $halaktif = 1 ;
        }

        //tentukan data awal
        $dataawal = ($halaktif * $dataperhalaman) - $dataperhalaman ;
        //tampilkan data
        $hotel = tampil("SELECT * FROM hotel WHERE nama LIKE '%$cari%' OR lokasi LIKE '%$cari%' LIMIT $dataawal,$dataperhalaman ") ; 
    }

    //jika user tidak mencari data
    else{
        $total_data = count(tampil("SELECT * FROM hotel")) ;
        $dataperhalaman = 5 ;
        $totalhalaman = ceil($total_data / $dataperhalaman) ;
        if(isset($_GET['hal'])){
            $halaktif = $_GET['hal'] ;
        }
        else{
            $halaktif = 1 ;
        }

        $dataawal = ($halaktif * $dataperhalaman) - $dataperhalaman ; 
        $hotel = tampil("SELECT * FROM hotel LIMIT $dataawal,$dataperhalaman ") ;
    }


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Hotel dashboard</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="css/custom.css">
		
		
		<!--google fonts -->
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  


<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><a href="../websitezahoteel/index.php"><span>Zahoteel</span></a></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="active">
		  <a href="#" class="dashboard"><i class="material-icons">dashboard</i>hotel dashboard </a>
		  </li>

		  <li class="">
		  	<a href="kamar.php" class="dashboard"> <i class="material-icons">aspect_ratio</i>kamar dashboard </a>
		  </li>
		
		  
          <li class="">
		  	<a href="users.php" class="dashboard"> <i class="material-icons">apps</i>users dashboard</a>
          </li>

		  <li class="">
		  	<a href="riwayat.php" class="dashboard"><i class="material-icons">library_books</i>booking dashboard</a>
          </li>

		  <li class="">
		  	<a href="paket3.php" class="dashboard"><i class="material-icons">library_books</i>paket dashboard</a>
          </li>

		  <li class="">
		  <a href="gallery.php" class=""><i class="material-icons">date_range</i>gallery dashboard</a>
		  </li>

		  <li class="">
		  <a href="fasilitas.php" class=""><i class="material-icons">date_range</i>fasilitas dashboard</a>
		  </li>

		  <li class="">
		  	<a href="riwayat_paket.php" class="dashboard"> <i class="material-icons">apps</i>pemesanan paket dashboard</a>
          </li>

		
		</ul>
	 </div>
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
      <div id="content">
	     
		  <!------top-navbar-start-----------> 
		     
		  <div class="top-navbar">
		     <div class="xd-topbar">
			     <div class="row">
				     <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
					    <div class="xp-menubar">
						    <span class="material-icons text-white">signal_cellular_alt</span>
						</div>
					 </div>
					 
					 <div class="col-md-5 col-lg-3 order-3 order-md-2">
					     <div class="xp-searchbar">
						     <form action="" method="get">
							    <div class="input-group">
								  <input type="search" class="form-control"
								  placeholder="cari" name="cari">
								  <div class="input-group-append">
								     <button class="btn" type="submit" name="tombolcari" id="button-addon2">Go
									 </button>
								  </div>
								</div>
							 </form>
						 </div>
					 </div>
					 
					 
					 <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
					     <div class="xp-profilebar text-right">
						    <nav class="navbar p-0">
							   <ul class="nav navbar-nav flex-row ml-auto">
							   <li class="dropdown nav-item active">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <span class="material-icons">notifications</span>
								  <span class="notification">4</span>
								 </a>
								  <ul class="dropdown-menu">
								     <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
								  </ul>
							   </li>
							   
							   <li class="nav-item">
							     <a class="nav-link" href="#">
								   <span class="material-icons">question_answer</span>
								 </a>
							   </li>
							   
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <img src="img/users.png" style="width:40px; border-radius:50%;"/>
								  <span class="xp-user-live"></span>
								 </a>
								  <ul class="dropdown-menu small-menu">
								     <li><a href="#">
									 <span class="material-icons">person_outline</span>
									 Profile
									 </a></li>
									 <li><a href="#">
									 <span class="material-icons">settings</span>
									 Settings
									 </a></li>
									 <li><a href="../registrasi/logout.php">
									 <span class="material-icons">logout</span>
									 Logout
									 </a></li>
									 
								  </ul>
							   </li>
							   
							   
							   </ul>
							</nav>
						 </div>
					 </div>
					 
				 </div>
				 
				 <div class="xp-breadcrumbbar text-center">
				    <h4 class="page-title">Dashboard</h4>
					<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">Zahoteel</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
					</ol>
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 
		  
		  
	<!------ container utama -----------> 
		     
		<div class="main-content">
			<div class="row">

					<!-- table data -->

				    	<div class="col-md-12">
					   		<div class="table-wrapper">
					     
					   			<div class="table-title">
					     			<div class="row">
						     			<div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    			<h2 class="ml-lg-2">Kelola Data Hotel</h2>
							 			</div>
							 			<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   				<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
							   					<i class="material-icons">&#xE147;</i>
							   					<span>Tambah Data Hotel</span>
							   				</a>
											<form method="post" action="">
							   				<button class="btn btn-primary" data-toggle="modal" type="submit" name="showall">
							   					<span>Show all</span>
											</button>
											</form>
											<form method="post" action="">
							   				<button class="btn btn-primary" data-toggle="modal" type="submit" name="cetak">
							   					<span>Cetak laporan</span>
											</button>
											</form>
							 			</div>
					    			</div>
					   			</div>
					   
					  			<table class="table table-striped table-hover">
					      			<thead>
						     			<tr>
							 				<th>No</th>
											<th>Id</th>
							 				<th>Foto</th>
											<th>bannerfoto</th>
							 				<th>Nama</th>
							 				<th>Lokasi</th>
							 				<th>Rating</th>
											<th>Deskripsi</th>
							 				<th>Actions</th>
							 			</tr>
						  			</thead>
						  
						  			<tbody>
										<?php foreach($hotel as $h) : ?>
						     				<tr>
							 					<td><?= $nomor ; ?></td>
												<?php $nomor++ ; ?>
												<td><?= $h['idhotel'] ;?></tf>
							 					<td><img src="img/image/<?= $h['foto'] ;?>" width="80" height="80" style="border-radius: 50%; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border: 4px solid lightgray;"></td>
												 <td><img src="img/image/<?= $h['banner'] ;?>" width="80" height="80" style="border-radius: 50%; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border: 4px solid lightgray;"></td>
							 					<td><?= $h['nama'] ;?></td>
							 					<td><?= $h['lokasi'] ;?></td>
							 					<td>Bintang <?= $h['rating'] ;?></td>
												<td><?= $h['deskripsi'] ;?></td>
							 					<td>
							    					<a href="#editEmployeeModal<?= $h['idhotel'] ?>" class="edit" data-toggle="modal">
							   							<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
							   						</a>
							   						<a href="#deleteEmployeeModal<?= $h['idhotel'] ;?>" class="delete" data-toggle="modal">
							   							<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
							   						</a>
												</td> 					   				
											</tr>

											<!---- delete-modal start--------->
					 						<div class="modal fade" tabindex="-1" id="deleteEmployeeModal<?= $h['idhotel'] ;?>" role="dialog">
  												<div class="modal-dialog" role="document">
    												<div class="modal-content">
      													<div class="modal-header">
        													<h5 class="modal-title">Hapus hotel</h5>
        													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          														<span aria-hidden="true">&times;</span>
        													</button>
      													</div>
      													<div class="modal-body">
        													<p>apakah anda pasti ingin menghapus data ini?</p>
															<p class="text-warning"><small>aksi ini bisa di cancel</small></p>
      													</div>
      													<div class="modal-footer">
        													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        													<button type="button" class="btn btn-success"><a href="?id=<?=  $h['idhotel'] ;?>&delete=<?= true ; ?>">Delete</a></button>
      													</div>
    												</div>
  												</div>
											</div>
											<!----- delete-modal end ----->

											<!----edit-modal start--------->
												<div class="modal fade" tabindex="-1" id="editEmployeeModal<?= $h['idhotel'] ; ?>" role="dialog">

													<!-- tampilkan data yang akan diubah kedalam form  -->
														<?php
															$id = $h['idhotel'] ;
															$hotelubah = tampil("SELECT * FROM hotel WHERE idhotel = $id ") ;
															$hotelubah = $hotelubah[0] ;
														?>
													<!-- end tampil data -->

													<div class="modal-dialog" role="document">
			  											<div class="modal-content">
															<div class="modal-header">
				  												<h5 class="modal-title">Edit Hotel</h5>
				  												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
				  												</button>
															</div>
															<form action="" method="post" enctype="multipart/form-data">
																	<input type="hidden" name="fotolama" value="<?= $hotelubah['foto'] ; ?>">
																	<input type="hidden" name="idhotel" value="<?= $hotelubah['idhotel'] ; ?>">
																	<input type="hidden" name="bannerlama" value="<?= $hotelubah['banner'] ; ?>">
															<div class="modal-body">
				  												<div class="form-group">
					  												<label for="nama">Nama hotel</label>
					  												<input type="text" class="form-control" name="nama" id="nama" value="<?= $hotelubah['nama'] ;?>">
				  												</div>
				  												<div class="form-group">
					 								 				<label for="lokasi">Lokasi</label>
					  												<input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $hotelubah['lokasi'] ; ?>" required>
				 												</div>
				  												<div class="form-group">
					  												<label for="deskripsi">Deskripsi</label>
					  												<input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $hotelubah['deskripsi'] ; ?>" required>
				  												</div>
																<div class="form-group">
																	<label for="rating">Rating</label>
																	<input type="number" class="form-control" id="rating" name="rating" value="<?= $hotelubah['rating'] ; ?>" required>
																</div>
																<div class="form-group">
																	<label for="foto">Foto</label>
																	<input type="file" class="form-control" name="foto" id="foto">
																</div>
																<div class="form-group">
																	<label for="banner">Banner Foto</label>
																	<input type="file" class="form-control" name="banner" id="banner">
																</div>
															</div>
															<div class="modal-footer">
				  												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				  												<button type="submit" name="ubah" class="btn btn-success">Save</button>
															</div>
															</form>
			  											</div>
													</div>
		  										</div>
											<!----edit-modal end --------->

										<?php endforeach ; ?>						 
						  			</tbody>					  					      
					   			</table>
					   
					   			<div class="clearfix">
					     			<div class="hint-text">menampilkan <b>data</b> dari <b><?= $total_data ; ?> data</b></div>
					     				<ul class="pagination">

											<?php if($halaktif > 1 && isset($_GET['cari'])) : ?>
												<li class="page-item"><a href="?hal=<?php echo $halaktif - 1 ;?>&cari=<?= $_GET['cari'] ; ?>" class="page-link">previous</a></li>
											<?php elseif($halaktif > 1) : ?>
												<li class="page-item"><a href="?hal=<?php echo $halaktif - 1 ;?>" class="page-link">previous</a></li>
											<?php endif ; ?>

											<?php for($i = 1; $i <= $totalhalaman ; $i++) :?>
												<?php if(isset($_GET['cari'])) :?>
													<?php if($i == $halaktif) :?>
														<li class="page-item active"><a href="?hal=<?= $i ;?>&cari=<?= $_GET['cari'] ; ?>" class="page-link" ><?= $i ; ?></a></li>
													<?php else : ?>
														<li class="page-item"><a href="?hal=<?= $i ;?>&cari=<?= $_GET['cari'] ; ?>" class="page-link" ><?= $i ; ?></a></li>
													<?php endif ; ?>
												<?php else : ?>
													<?php if($i == $halaktif) :?>
														<li class="page-item active"><a href="?hal=<?= $i ;?>" class="page-link" ><?= $i ; ?></a></li>
													<?php else : ?>
														<li class="page-item"><a href="?hal=<?= $i ;?>" class="page-link" ><?= $i ; ?></a></li>
													<?php endif ; ?>
												<?php endif ; ?>
											<?php endfor ;?>


											<?php if($halaktif < $totalhalaman && isset($_GET['cari'])) : ?>
												<li class="page-item"><a href="?hal=<?php echo $halaktif + 1 ;?>&cari=<?= $_GET['cari'] ; ?>" class="page-link">next</a></li>
											<?php elseif($halaktif < $totalhalaman) : ?>
												<li class="page-item"><a href="?hal=<?php echo $halaktif + 1 ;?>" class="page-link">next</a></li>
											<?php endif ; ?>

						 				</ul>
					   			</div>
								   
					   		</div>
						</div>
					
					
					<!---- add modal form --------->

						<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
  							<div class="modal-dialog" role="document">
    							<div class="modal-content">
      								<div class="modal-header">
        								<h5 class="modal-title">Tambah Data Hotel</h5>
        								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          									<span aria-hidden="true">&times;</span>
        								</button>
									</div>

									<form action="" method="post" enctype="multipart/form-data">	
      									<div class="modal-body">
        									<div class="form-group">
		    									<label for="nama">Nama</label>
												<input type="text" class="form-control" required name="nama" id="nama">
											</div>
        									<div class="form-group">
		    									<label for="lokasi">Lokasi</label>
												<input type="text" class="form-control" required name="lokasi" id="lokasi">
											</div>
											<div class="form-group">
		    									<label for="deskripsi">Deskripsi</label>
												<input type="text" class="form-control" required name="deskripsi" id="deskripsi">
											</div>
											<div class="form-group">
		    									<label for="rating">Rating</label>
												<input type="number" class="form-control" required name="rating" id="rating">
											</div>
											<div class="form-group">
												<label for="foto">foto</label>
												<input type="file" class="form-control" required name="foto" id="foto">
											</div>
											<div class="form-group">
												<label for="banner">banner foto</label>
												<input type="file" class="form-control" required name="banner" id="banner">
											</div>		
      									</div>
      									<div class="modal-footer">
        									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        									<button type="submit" name="add" class="btn btn-success">Add</button>	
      									</div>
									</form>	
    							</div>
  							</div>
						</div>

					  
					   
					   
					   
					   
					
					   
					
					
				 
			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
		  
		 
		 
		 <!----footer-design------------->
		 
		 <footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <p class="mb-0">&copy 2023 Zahoteel . All Rights Reserved.</p>
			   </div>
			</div>
		 </footer>
		 
		 
		 
		 
	  </div>
   
</div>



<!-------complete html----------->





  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>
  
  
  <script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });
  </script>
  
  



  </body>
  
  </html>


