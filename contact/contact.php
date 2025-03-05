<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Contactez-nous | I&N Compagnie</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Nova
  * Template URL: https://bootstrapmade.com/nova-bootstrap-business-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="contact-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.webp" alt="">
      </a>

     <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" >Accueil<br></a></li>
          <li><a href="about.php">A propos</a></li>
          <li><a href="services.php">Nos services</a></li>
          <li><a href="contact.php" class="active">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/contact-page-title-bg.webp);">
      <div class="container">
        <h1>Contact</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Accueil</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Adresse</h3>
                <p>Antananarivo, Madagascar</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Téléphone</h3>
                <p>+261 32 12 578 00</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>E-mail</h3>
                <p>contact@incompagnie.mg</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-7">

        <form action="forms/contact.php" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="500" method="post" id="contactForm" autocomplete="off">
        <div class="row gy-4">
        <div class="col-md-6">
            <input type="text" id="inputName" name="name" class="form-control" placeholder="Votre nom" required>
        </div>

        <div class="col-md-6">
            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Votre email" required>
        </div>

        <div class="col-md-12">
            <input type="tel" id="inputPhone" class="form-control" name="phone" placeholder="Téléphone" required>
        </div>

        <div class="col-md-12">
            <textarea class="form-control" id="inputMessage" name="message" rows="6" placeholder="Message" required></textarea>
        </div>

        <div class="card-body p-5">
            <div class="alert d-none" id="alertMessage">
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" id="btn" ><i class="bi bi-send-fill"></i>Envoyer</button>
        </div>

    </div>
</form>
          </div><!-- End Contact Form -->

        </div>

      </div>
      <script>
    const contactForm = document.querySelector('#contactForm');
    const btn = document.querySelector('#btn');
    const alertMessage = document.querySelector('#alertMessage');

    contactForm.addEventListener('submit', function(e) {
      btn.textContent = 'envoi en cours...';
      btn.disabled = true;
      e.preventDefault();
      const formData = new FormData(this);
      fetch('sendmail.php', {
          method: 'post',
          body: formData
        })
        .then(function(response) {
          return response.text();
        })
        .then(function(text) {
          if (text === 'success') {
            btn.textContent = 'Send Message';
            btn.disabled = false;
            alertMessage.classList.remove('d-none');
            alertMessage.classList.add('alert-success');
            alertMessage.innerHTML = 'Votre message a été bien envoyé.';
          } else {
            btn.textContent = 'Send Message';
            btn.disabled = false;
            alertMessage.classList.remove('d-none');
            alertMessage.classList.add('alert-danger');
            alertMessage.innerHTML = 'Erreur ! message non envoyé.';
          }
        })
        .catch(function(error) {
          console.error(error);
        })
    });
  </script>

    </section><!-- /Contact Section -->

  </main>

   <footer id="footer" class="footer dark-background py-4">

  <div class="container text-md-start">
    <div class="row gy-4 justify-content-center">

      <!-- Logo & Présentation -->
      <div class="col-lg-4 col-md-12 footer-about text-center">
        <a href="index.php" class="logo d-block mx-auto">
          <img src="assets/img/logo.webp" alt="logo I&N Compagnie" class="img-fluid">
        </a>
        <p class="mt-3">I&N COMPAGNIE offre des services administratifs, marketing et informatiques pour clients locaux et internationaux. Ensemble, propulsons vos projets digitaux vers le succès.</p>
        <div class="social-links d-flex justify-content-center gap-3 mt-3">
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href="https://linkedin.com/compagny/incompagnie"><i class="bi bi-linkedin"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
        </div>
      </div>

      <!-- Liens utiles -->
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Liens utiles</h4>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="about.php">A propos</a></li>
          <li><a href="services.php">Nos services</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>

      <!-- Nos services -->
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Nos services</h4>
        <ul>
          <li><a>Conception sites web</a></li>
          <li><a>Optimisation SEO</a></li>
          <li><a>Conception graphique</a></li>
          <li><a>Marketing digital</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-lg-4 col-md-12 footer-contact text-center">
        <h4>Adresse</h4>
        <p>Antananarivo, Madagascar</p>
        <p class="mt-2"><strong>Tél : </strong> +261 32 12 578 00</p>
        <p><strong>E-mail : </strong>contact@incompagnie.mg</p>
      </div>

    </div>
  </div>

  <!-- Copyright -->
  <div class="container text-center mt-4 border-top pt-3">
    <p>© <span>2025</span> <strong class="sitename">I&N COMPAGNIE</strong> - Tous droits réservés</p>
  </div>

</footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>