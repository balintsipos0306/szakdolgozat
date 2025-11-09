<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Admin/admin.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">
    <link rel="stylesheet" href="../../css/Admin/admin-blog.css">
    <title>Sipos Bálint - Szerkesztő felület</title>
</head>
<body id="page">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <x-system-feedback/>
  <x-admin-header/>

  <main>
    <h1>Blog módosítása</h1>

    @php
      $blogs = DB::table('blogs')->where('id', $id) -> first();
    @endphp

  <div class="container">
    <form action="/blog-update" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="id" class="form-label"><strong>Azonosító</strong></label>
        <input type="text" class="form-control" id="id" name="id" value="{{$blogs->id}}" readonly>
      </div>
      <div class="mb-3">
        <label for="title" class="form-label"><strong>Cím</strong></label>
        <input type="text" class="form-control" id="title" name="title" value="{{$blogs->title}}" required>
      </div>
      <div class="mb-3">
        <label for="text" class="form-label"><strong>Szöveg</strong></label>
        <textarea class="form-control" id="text" name="text" rows="3"required>{{$blogs->text}}</textarea>
      </div>
      <div class="mb-3">
      <img id="boritokep" src="{{asset('storage/' . $blogs->image_path )}}">
      </div>
      <div class="mb-3">
        <label for="image" class="form-label"><strong>Borítókép megváltoztatása</strong></label>
        <input class="form-control" type="file" name="image" id="image">
      </div>
      <label for="isPublished" class="form-label"><strong>Mentés módja</strong></label>
      @if ($blogs->isPublished == "Piszkozat")
        <select class="form-select" name="isPublished" id="isPublished">
          <option selected value="Piszkozat">Piszkozat</option>
          <option value="Publikált">Publikálás</option>
        </select>      
      @else
        <select class="form-select" name="isPublished" id="isPublished">
        <option selected value="Publikált">Publikált</option>
        <option value="Piszkozat">Piszkozat</option>
        </select>      
      @endif

      <button class="btn btn-primary" type="submit">Mentés</button>
      <a class="btn btn-secondary" href="/admin/blog">Vissza</a>
    </form>
  </div>

</body>
</html>