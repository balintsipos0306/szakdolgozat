<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/galery.css">
  <title>Galéria - Sipos Bálint</title>
</head>
<body>
  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/scroll.js"></script>
  <script src="../js/hamburger.js"></script>
  <script src="../js/adminLogin.js"></script>
  <script src="../js/picViewer.js"></script>

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
          <a class="nav-link" href="#">Galéria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact">Elérhetőségek</a>
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
    <div id="pics">
      <div class="row" id="category">
        <div class="col-sm-4" id="nextGallery">
          <a href="/gallery/nature"><h2>Természetfotók</h2></a>
        </div>
        <div class="col-sm-4">
         <a href=""><h1>Porté fotók</h1></a>
        </div>
        <div class="col-sm-4" id="nextGallery">
          <a href="/gallery/events"><h2>Rendezvényfotók</h2></a>
        </div>
      </div>

      <hr id="hr" class="border border-black border-2 opacity-100">

      @php
        $pictures = DB::table('gallery')->where('category', 'Portré')->get();
      @endphp

      <div class="row">
        @foreach ($pictures as $picture)
          <div class="col-sm-6">
            <img src="{{ asset('storage/' . $picture->image_path) }}" alt="" onclick="showPic(this)">
          </div>
        @endforeach
      </div>
    </div>
  </main>

  <footer id="footer">
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