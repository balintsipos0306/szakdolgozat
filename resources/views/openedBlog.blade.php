<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="../css/scrollbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Sipos Bálint - Kezdőlap</title>
</head>
<body id="page">
  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/scroll.js"></script>
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
          <a class="nav-link" href="/contact">Elérhetőségek</a>
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
    
  <m id = "main">
    
  @php
    $blogs = DB::table('blogs')->where('isPublished', "publikált")->get();
    $selected = DB::table('blogs')->where('isPublished', "publikált")->where('id', $id)->first();
    $previous = DB::table('blogs')->where('isPublished', "publikált")->where('created_at', '<', $selected->created_at)->orderBy('created_at', 'DESC')->first();
    $next = DB::table('blogs')->where('isPublished', "publikált")->where('created_at', '>', $selected->created_at)->orderBy('created_at', 'ASC')->first();
  @endphp

  <div class="container">
    <div id="sub" class="card text-bg-success mb-3">
      <div class="card-header">Feliratkozás</div>
        <div class="card-body">
          <h5 class="card-title">Iratkozz fel a körlevélre, hogy emailben értesülj az új bejegyzésekről</h5>
          <form action="/sub" method="POST">
            @csrf
            <div class="input-group" id="inputs">
              <div class="g col-3">
                <label for="name" class="form-label">Név</label>
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
  </div>

  <div class="container">
    <img id="borito" src="{{asset('storage/'. $selected->image_path)}}" alt="">
    <h2>{{$selected->title}}</h2>
    <hr>
    <p>{{$selected->text}}</p>
    <div class="btn-group" role="group" aria-label="Basic example">
        @if (empty($previous->id))
        <a type="button" class="btn btn-secondary" disabled>Előző blog</a>
        @else
        <a type="button" class="btn btn-secondary" href="/blog/{{$previous->id}}">Előző blog</a>
        @endif
        <a type="button" class="btn btn-primary" href="/blog">Vissza a főoldalra</a>
        @if (empty($next->id))
            <a type="button" class="btn btn-secondary" disabled>Következő blog</a>
        @else
        <a type="button" class="btn btn-secondary" href="/blog/{{$next->id}}">Következő blog</a>
        @endif
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

    <div class="col">
    <div class="card" aria-hidden="true">
    <div class="card-body">
    <h5 class="card-title placeholder-glow">
      <span class="placeholder col-6"></span>
    </h5>
    <p class="card-text placeholder-glow">
      <span class="placeholder col-7"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-4"></span>
      <span class="placeholder col-6"></span>
      <span class="placeholder col-8"></span>
    </p>
    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
  </div>
</div>
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

  <script src="js/main.js"></script>
</body>
</html>