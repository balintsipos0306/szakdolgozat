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
  <title>Sipos Bálint - Kezdőlap</title>
</head>
<body id="page">
  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="js/scroll.js"></script>

  <x-system-feedback/>
  <x-base-header/>

  <main id = "main">  
    <x-subscribe-card/>

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

    @if($latest)
    <div class="container">
      <img id="borito" src="{{asset('storage/'. $latest->image_path)}}" alt="">
      <h2>{{$latest->title}}</h2>
      <hr>
      <p>{{$latest->text}}</p>
    </div>
    @endif
  </main>

  <x-base-footer/>
  <script src="js/main.js"></script>
</body>
</html>