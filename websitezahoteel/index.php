<!-- kode html untuk menyimpan beberapa link library yang digunakan -->
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            *{
                font-family : 'poppins' ;
            }
        </style>
	</head>
	<body>
	
	</body>
	</html>

<!-- end kode html -->




<?php
  require "../adminzahoteel/function/function.php" ;
  session_start() ;
  //ambil data hotel dari database untuk ditampilkan
  $hotel = tampil("SELECT * FROM hotel") ;
  $paket = tampil("SELECT * FROM paket_liburan WHERE ketersediaan = 'tersedia'") ;
  $gallery = tampil("SELECT * FROM gallery WHERE idhotel = 0 ") ;
  //jika user menekan tombol cari
  if(isset($_POST['cari'])){
      $negara = $_POST['negara'] ;
      $hotel = cari($negara) ; 
  }



    //jika user menekan tombol booking packet
    if(isset($_GET['pesan'])){
        
      //ambil data kamar dari variabel post id
      $idpaket = $_GET['idpaket'] ;
  
      //cek apakah user sudah login atau belum
      if(isset($_SESSION['login'])){
        header("Location: pesanpaketliburan/booking/index.php?idpaket=$idpaket");
        exit;
      }
  
      else{
          echo"     
              <script>
                  Swal.fire({
                      title: 'Gagal',
                      text: 'Anda belum login.Harap login terlebih dahulu',
                      icon: 'warning'
                  }).then(() => {
                  window.location.href = 'index.php';
                  });
             </script> ";                     
      }
  
  }

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zahoteel</title>

  <!-- favicon -->
  <link rel="icon" href="favicon.ico" >

  <!-- custom css link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="./assets/css/style1.css">

  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
  rel="stylesheet">

  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body id="top">

  <!-- HEADER -->

  <header class="header" data-header>

    <div class="overlay" data-overlay></div>

    <div class="header-top">
      <div class="container">

        <a href="tel:+01123456790" class="helpline-box">

          <div class="icon-box">
            <ion-icon name="call-outline"></ion-icon>
          </div>

          <div class="wrapper">
            <p class="helpline-title">info lebih lanjut :</p>
            <p class="helpline-number">+62 (0838) 6165 2293</p>
          </div>

        </a>

        <a href="#" class="logo">
          <i class="fa-solid fa-hotel"></i>
          <p>ZAHOTEEL</p>
        </a>

        <div class="header-btn-group">

          <button class="search-btn" aria-label="Search" id="profile-icon">
            <?php if(isset($_SESSION['login'])) : ?>
              <?php if(isset($_SESSION['admin'])) : ?>
                <a href="../adminzahoteel/index.php" style="color: white ;"><ion-icon name="person"></ion-icon></a>
              <?php else :?>
                <button class="btn btn-primary"><a href="../registrasi/logout.php" style="color: white ;">Log out</a></button>
              <?php endif ; ?>
            <?php else : ?>  
              <a href="../registrasi/login.php" style="color: white ;"><ion-icon name="person-outline"></ion-icon></a>
            <?php endif ; ?>  
          </button>

          <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
          </button>

        </div>

      </div>
    </div>

    <div class="header-bottom">
      <div class="container">

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

        <nav class="navbar" data-navbar>

          <div class="navbar-top">

            <a href="#" class="logo">
              <i class="fa-solid fa-hotel"></i>
              <p>ZAHOTEEL</p>
            </a>

            <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </div>

          <ul class="navbar-list">

            <li>
              <a href="#home" class="navbar-link" data-nav-link>beranda</a>
            </li>

            <li>
              <a href="#home" class="navbar-link" data-nav-link>tentang kami</a>
            </li>

            <li>
              <a href="#hotel" class="navbar-link" data-nav-link>hotel</a>
            </li>

            <li>
              <a href="#package" class="navbar-link" data-nav-link>Paket Liburan</a>
            </li>

            <li>
              <a href="#gallery" class="navbar-link" data-nav-link>gallery</a>
            </li>

            <li>
              <a href="#contact" class="navbar-link" data-nav-link>contact kami</a>
            </li>

          </ul>

        </nav>

        <button class="btn btn-primary">Book Now</button>

      </div>
    </div>

  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home">
        <div class="container">

          <h2 class="h1 hero-title">have fun with za hoteel</h2>

          <p class="hero-text">
            Kami adalah hotel group yang berada di bawah naungan perusahaan Za hoteel.
            Nikmati liburan mu dengan menginap di hotel - hotel kami yang ada di seluruh dunia.
          </p>

          <div class="btn-group">
            <button class="btn btn-primary"><a href="#hotel" style="color: white">Learn more</a></button>

            <button class="btn btn-secondary"><a href="#hotel" style="color: white">Book now</a></button>
          </div>

        </div>
      </section>





      <!-- 
        - #TOUR SEARCH
      -->

      <section class="tour-search">
        <div class="container">

          <form action="" method="post" class="tour-search-form">

            <div class="input-wrapper">
              <label for="destination" class="input-label">Cari nama negara*</label>

              <input type="text" name="negara" id="destination" required placeholder="masukan nama negara..."
                class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="people" class="input-label">Jumlah orang*</label>

              <input type="number" name="people" id="people" required placeholder="jumlah orang..." class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="checkin" class="input-label">Tanggal Checkin*</label>

              <input type="date" name="checkin" id="checkin" required class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="checkout" class="input-label">Tanggal Checkout*</label>

              <input type="date" name="checkout" id="checkout" required class="input-field">
            </div>
            
            <button type="submit" name="cari" class="btn btn-secondary">cari sekarang</button>

          </form>

        </div>
      </section>





      <!-- 
        - #POPULAR
      -->

      <section class="populer" id="hotel">
          <div class="container">

            <p class="section-subtitle">Hotel</p>

            <h2 class="h2 section-title">Hotel Zahoteel</h2>

            <p class="section-text">
                Beberapa Hotel - Hotel kami yang sangat populer di seluruh dunia.Pastikan anda menginap di tempat kami saat sedang berlibur.
            </p>

            <div class="swiper negara-slider">
              <div class="swiper-wrapper">
                <?php foreach($hotel as $h) : ?>
                  <div class="swiper-slide popular-card">
                    <figure class="card-img">
                      <img src="../adminzahoteel/img/image/<?= $h['foto'] ;?>">
                    </figure>
      
                    <div class="card-content">
      
                        <div class="card-rating">
                          <?php for($i = 1 ; $i <= $h['rating'] ; $i++) : ?>
                            <ion-icon name="star"></ion-icon>
                          <?php endfor ; ?>
                        </div>
      
                      <p class="card-subtitle">
                        <a href="#"><?= $h['lokasi'] ;?></a>
                      </p>
      
                      <h3 class="h3 card-title">
                        <a href="#"><?= $h['nama'] ;?></a>
                      </h3>
      
                      <p class="card-text">
                        <?= $h['deskripsi'] ;?>
                      </p>

                      <a class="btn-visit" href="../websitezahotel/?id=<?= $h['idhotel'] ;?>">kunjungi</a>

                    </div>
                  </div>
                <?php endforeach ; ?>    
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next">
                  <i class="fa-solid fa-arrow-right"></i> 
                </div>
                <div class="swiper-button-prev">
                <i class="fa-solid fa-arrow-left"></i>
                </div>
            </div>
          </div>
    
          <div class="btn-page">
            <button class="btn btn-primary"><a href="" style="color: white ;">Show all</a></button>
          </div>

      </section>





      <!-- 
        - #PACKAGE
      -->

      <section class="package" id="package">
        <div class="container">

          <p class="section-subtitle">Paket liburan</p>

          <h2 class="h2 section-title">Paket liburan Zahoteel</h2>

          <p class="section-text">
              Kami menyediakan paket liburan bagi orang orang yang ingin berlibur ke seluruh dunia.
          </p>

          <ul class="package-list">
            <?php foreach($paket as $p) : ?>              
            <li>
              <div class="package-card">

                <figure class="card-banner">
                  <img src="../adminzahoteel/img/image/<?= $p['foto'] ;?>">
                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title"><?= $p['nama'] ;?></h3>

                  <p class="card-text">
                    <?= $p['deskripsi'] ;?>
                  </p>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <div class="meta-box">
                        <ion-icon name="time"></ion-icon>

                        <p class="text"><?= $p['lama'] ;?>hari/<?= $p['lama'] ;?>malam</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                        <ion-icon name="people"></ion-icon>

                        <p class="text">kapasitas : <?= $p['kapasitas'] ;?></p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                        <ion-icon name="location"></ion-icon>

                        <p class="text"><?= $p['tempat'] ;?></p>
                      </div>
                    </li>

                  </ul>

                </div>

                <div class="card-price">

                  <div class="wrapper">

                    <p class="reviews">(reviews)</p>

                    <div class="card-rating">
                      <?php for($j = 1 ; $j <= $p['rating'] ; $j++) : ?>
                      <ion-icon name="star"></ion-icon>
                      <?php endfor ; ?>
                    </div>

                  </div>

                  <p class="price">
                  Rp.<?= number_format($p['harga']) ;?>
                    <span>/ per orang</span>
                  </p>

                  <button class="btn btn-secondary"><a href="?idpaket=<?= $p['id'] ;?>&pesan=true" style="color: white ;">Book Now</a></button>

                </div>

              </div>
            </li>
            <?php endforeach ; ?>
          </ul>

          <button class="btn btn-primary"><a href="#package" style="color: white">Pake liburan kami</a></button>

        </div>
      </section>





      <!-- 
        - #GALLERY
      -->

      <section class="gallery" id="gallery">
        <div class="container">

          <p class="section-subtitle">Photo Gallery</p>

          <h2 class="h2 section-title">Photo's From Travellers</h2>

          <p class="section-text">
            Foto foto dari para client yang sudah menggunakan jasa kami.Nikmati pemandangan pemandangan indah dari seluruh dunia
          </p>

          <ul class="gallery-list">
            
            <?php foreach($gallery as $g) : ?>
            <li class="gallery-item">
              <figure class="gallery-image">
                <img src="../adminzahoteel/img/image/<?= $g['foto'] ;?>">
              </figure>
            </li>
            <?php endforeach ; ?>

          </ul>

        </div>
      </section>





      <!-- 
        - #CTA
      -->

      <section class="cta" id="contact">
        <div class="container">

          <div class="cta-content">
            <p class="section-subtitle">Call To Action</p>

            <h2 class="h2 section-title">Ready For Unforgatable Experience. Remember Us!</h2>

            <p class="section-text">
              butuh informasi lebih jauh mengenai jasa yang kami berikan.contact kami melalui no telepon dan sosial media.Pihak kami akan memberikan informasi yang jelas dan rinci.
            </p>
          </div>

          <button class="btn btn-secondary">Contact Us !</button>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

          <h2 style="margin-bottom: 10px ;">Zahoteel</h2>

          <p class="footer-text">
              Terimakasi sudah mengunjungi website kami.jangan lupa jika anda butuh sesuatu mengenai informasi hotel hotel dan paket liburan di seluruh dunia kami akan selalu ada.
          </p>

        </div>

        <div class="footer-contact">

          <h4 class="contact-title">Contact Us</h4>

          <p class="contact-text">
            Feel free to contact and reach us !!
          </p>

          <ul>

            <li class="contact-item">
              <ion-icon name="call-outline"></ion-icon>

              <a href="tel:+01123456790" class="contact-link">+62 0838 6165 2293</a>
            </li>

            <li class="contact-item">
              <ion-icon name="mail-outline"></ion-icon>

              <a href="" class="contact-link">Zahoteel.com</a>
            </li>

            <li class="contact-item">
              <ion-icon name="location-outline"></ion-icon>

              <address>Simpang Batu Hampa</address>
            </li>

          </ul>

        </div>

        <div class="footer-form">

          <p class="form-text">
            Iuti sosial media dan youtube kami!
          </p>

          <form action="" class="form-wrapper">
            <input type="email" name="email" class="input-field" placeholder="Enter Your Email" required>

            <button type="submit" class="btn btn-secondary">Subscribe</button>
          </form>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2023 <a href="">ZAHOTEEL</a>. All rights reserved
        </p>

        <ul class="footer-bottom-list">

          <li>
            <a href="#" class="footer-bottom-link">Privacy Policy</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">Term & Condition</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">FAQ</a>
          </li>

        </ul>

      </div>
    </div>

  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>  
  <script src="./assets/js/scriptt.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>