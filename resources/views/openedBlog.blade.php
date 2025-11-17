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
    <title>Blog - Sipos Bálint</title>
</head>
<body id="page">
  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/scroll.js"></script>

  <x-base-header/>
    
  <m id = "main">
    
  <x-subscribe-card/>

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


  </div>
  
  </main>


  <x-base-footer/>
  <script src="js/main.js"></script>
</body>
</html>