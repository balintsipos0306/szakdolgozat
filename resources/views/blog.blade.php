<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/blog.css">
  <link rel="stylesheet" href="css/scrollbar.css">
  <link rel="stylesheet" href="css/footer.css">
  <title>Sipos Bálint - Kezdőlap</title>
</head>
<body id="page">
  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="js/scroll.js"></script>
  <script src="js/hamburger.js"></script>
  <script src="js/adminLogin.js"></script>

  @if (session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
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
          const toastElement = document.getElementById('successToast');
          if (toastElement) {
              const toast = new bootstrap.Toast(toastElement, { autohide: false });
              toast.show();
          }
      });
    </script>
  @endif

  <header id="myheader">
    <div class="hamburger">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>

    <div class= "logoholder">
      <img id = "logo" src="webp/tinywow_Logó.webp" alt="">
    </div>

    <nav id = "navv">
      <ul class="nav justify-content-end" id="menu">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Kezdőlap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gallery/nature">Galéria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact">Elérhetőségek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/shop">Webshop</a>
        </li>
      </ul>
    </nav>
  </header>

  <main id = "main">  
    @php
      $blogs = DB::table('blogs')->where('isPublished', "publikált")->get();
    @endphp

    <div class="container">
      <div id="sub" class="card text-bg-success mb-3">
        <div class="card-header">Feliratkozás</div>
        <div class="card-body">
          <h5 class="card-title">Iratkozz fel a körlevélre, hogy emailben értesülj az új bejegyzésekről</h5>
          <form action="/sub" method="POST">
            @csrf
            <div class="input-group" id="inputs">
              <div class="g col-4">
                <label for="name" class="form-label">Keresztnév</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="name">
              </div>
              <div class="g col-6" id="email">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="email">
              </div>
            </div>
            <button type="submit" class="btn btn-light">Feliratkozás</button>
          </form>
        </div>
      </div>
    </div>

    <div class="row d-flex flex-nowrap" id="felsorolas">
      @foreach ($blogs as $blog)
        <div class="col">
          <div class="card" aria-hidden="true">
            <img src="{{ asset('storage/' . $blog->image_path) }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">
                <span>{{$blog->title}}</span>
              </h5>
              <p class="card-text" id="szoveg">{{$blog->text}}...</p>
              <a class="btn btn-primary col-6" href="{{ route('blog.open', ['id' => $blog->id]) }}">Megnyitás</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    
    <hr class="border border-secondary border-3 opacity-75">

    @php
      $latest = DB::table('blogs')->where('isPublished', "Publikált")->orderBy('created_at', 'DESC')->first();
    @endphp

    <div class="container">
      <img id="borito" src="{{asset('storage/'. $latest->image_path)}}" alt="">
      <h2>{{$latest->title}}</h2>
      <hr>
      <p>{{$latest->text}}</p>
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
  <script src="js/main.js"></script>
</body>
</html>