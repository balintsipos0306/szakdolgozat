<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/Admin/admin.css">
  <link rel="stylesheet" href="../css/scrollbar.css">
  <link rel="stylesheet" href="../css/Admin/admin-blog.css">
  <title>Sipos Bálint - Szerkesztő felület</title>
</head>
<body id="page">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


  <x-system-feedback/>
  <x-admin-header/>

  <main>
    <h1>Blogok szerkesztése</h1>

    <div class="container">
      <div class="container mt-4" id="table">
        <div class="row">
          <div class="col d-flex align-items-center justify-content-center">
            <h2>ID</h2>
          </div>    
          <div class="col d-flex align-items-center justify-content-center">
            <h2>Cím</h2>
          </div>
          <div class="col d-flex align-items-center justify-content-center">
            <h2>Szöveg</h2>
          </div>
          <div class="col d-flex align-items-center justify-content-center">
            <h2>Kép</h2>
          </div>
          <div class="col d-flex align-items-center justify-content-center">
            <h2>Állapot</h2>
          </div>
          <div class="col d-flex align-items-center justify-content-center">
            <h2>Utoljára módosítva</h2>
          </div>
          <div class="col d-flex align-items-center justify-content-center">
            <h2>Szerkesztés</h2>
          </div>
          <div class="col d-flex align-items-center justify-content-center">
            <h2>Törlés</h2>
          </div>
        </div>
              
        @foreach($blogs as $blog)
          <div class="row">
            <div class="col d-flex align-items-center justify-content-center" id="col">
              <p>{{$blog->id}}</p>
            </div>
            <div class="col d-flex align-items-center justify-content-center" id="col">
              <p>{{$blog->title}}</p>
            </div>
            <div class="col d-flex align-items-center justify-content-center" id="col">
              <p>{{ Str::limit($blog->text, 60)}}<p>
            </div>
            <div class="col d-flex align-items-center justify-content-center" id="col">
              <img src="{{ asset('storage/' . $blog->image_path) }}">
            </div>
            <div class="col d-flex align-items-center justify-content-center" id="col">
              <p>{{$blog->isPublished}}</p>
            </div>
            <div class="col d-flex align-items-center justify-content-center" id="col">
              <p>{{$blog->updated_at}}</p>
            </div>
            <div class="col d-flex align-items-center justify-content-center" id="col">
              <a href="{{ route('blog.edit', ['id' => $blog->id]) }}">Szerkesztés</a>
            </div>
            <div class="col d-flex align-items-center justify-content-center" id="col">
              <form action="/blog-delete" method="POST">
                @csrf
                <div class="mb-3">
                  <input type="number" class="form-control" id="title" name="id" value = {{$blog->id}} hidden>
                  <button id="delButton" type="submit"><img src="../webp/close.png" alt=""></button>
                </div>
              </form>
            </div>
          </div>
          @endforeach
      </div>
      <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Blog készítése
      </button>

      <div class="collapse" id="collapseExample">
        <div class="card card-body"> 
          <form action="/blog-upload" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Cím</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
              <label for="text" class="form-label">Szöveg</label>
              <textarea class="form-control" id="text" name="text" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Borítókép feltöltése</label>
              <input class="form-control" type="file" name="image" id="image" required>
            </div>
            <label for="isPublished" class="form-label">Mentés módja</label>
            <select class="form-select" name="isPublished" id="isPublished">
              <option selected value="Publikált">Publikálás</option>
              <option value="Piszkozat">Piszkozat</option>
            </select>
            <button class="btn btn-primary" type="submit">Feltöltés</button>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>
</html>