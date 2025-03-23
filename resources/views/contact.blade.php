<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/scrollbar.css">
  <link rel="stylesheet" href="../css/contact.css">
  <title>Elérhetőségek - Sipos Bálint</title>
</head>
<body>
  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/loader.js"></script>
  <script src="../js/hamburger.js"></script>
  <script src="../js/adminLogin.js"></script>

  <header id="myheader">
    <div class="hamburger">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>

    <div class= "logoholder">
      <img id = "logo" src="../webp/tinywow_Logó.webp" alt="">
    </div>

    <nav id = "navv">
      <ul class="nav justify-content-end" id="menu">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Kezdőlap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/gallery/nature">Galéria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Elérhetőségek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/shop">Webshop</a>
        </li>
      </ul>
    </nav>
  </header>

  <main>
    @if (session('success'))
      <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <strong class="me-auto text-success">Siker</strong>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              {{ session('success') }}
            </div>
        </div>
      </div>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.querySelector('.toast');
            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement, { autohide: false });
                toast.show();
            }
        });
      </script>
    @endif

    <div class="socials">
      <a href="https://www.instagram.com/balintportraits/" target="_blank"><img src="webp/Instagram_icon.png.webp" alt=""></a>
      <a href="https://www.facebook.com/balintsipos03" target="_blank"><img src="webp/images.jfif" alt=""></a>
      <a href="tel:+36705872912"><img src="webp/png-clipart-telephone-logo-iphone-telephone-call-smartphone-phone-electronics-text.png"></img></a>  
    </div>

    <div class="container" id="info">
      <div class="image">
        <img src="../webp/tinywow_DSC_6422_65925974.webp" alt="">
      </div>

      <div>
        <form action="/mail" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Név</label>
            <input class="form-control" id="validationTextarea" name="name" required></input>           
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email cím</label>
            <input class="form-control" id="validationTextarea" name="address" required></input>
          </div>
          <div class="mb-3">
            <label for="title" class="form-label">Tárgy</label>
            <input class="form-control" id="validationTextarea" name="title" required></input>
          </div>
          <div class="mb-3">
            <label for="text" class="form-label">Üzenet</label>
            <textarea class="form-control" id="validationTextarea" name="text" required></textarea>
          </div>      
          <div class="mb-3">
            <button class="btn btn-primary" type="submit">Email küldése</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer>
    <div class="row">
      <div class="col">
        Logó:
        <ul>
          <li><a href="https://vipix.hu/" target="_blank">VIPIX Grafikai Stúdió</a></li>
        </ul>
      </div>

      <div class="col">
        <ul>
          <li>Az oldalt készítette: Sipos Bálint</li>
          <li>Cím: 9200, Mosonmagyaróvár Gát utca 45/b</li>
          <li><a href="/contact">Elérhetőségek</a></li>
        </ul>    
      </div>
    </div>
  </footer>  
</body>
</html>