<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/Admin/admin.css">
    <link rel="stylesheet" href="../../../css/scrollbar.css">
    <link rel="stylesheet" href="../../../css/Admin/admin-blog.css">
    <title>Sipos Bálint - Szerkesztő felület</title>
</head>
<body id="page">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <header>  
    <nav class="navbar bg-body-tertiary fixed-top">
      <div class="container-fluid">
        <div class="imgholder">
            <img id="logo" src="../../../webp/tinywow_Logó.webp" alt="">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <a href="/admin" id="homeButton"><h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menü</h5></a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/admin/blog">Blog szerkesztés</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/image-upload">Képek feltöltése</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Webshop szerkesztése</a>
              </li>
            </ul>
            <form action="/logout" method="POST" id="logout">
            @csrf
            @method('DELETE')
            <button id="signout" type="submit" class="btn btn-primary">Kilépés</button>
        </form>
          </div>
        </div>
      </div>
    </nav>

  </header>

  <main>
    <h1>Blog módosítása</h1>

    @php
      $item = DB::table('webshop')->where('id', $id) -> first();
    @endphp

  <div class="container">
    <form action="/webshop-update" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="id" class="form-label"><strong>Azonosító</strong></label>
        <input type="text" class="form-control" id="id" name="id" value="{{$item->id}}" readonly>
      </div>
      <div class="mb-3">
        <label for="title" class="form-label"><strong>Cím</strong></label>
        <input type="text" class="form-control" id="title" name="title" value="{{$item->name}}" required>
      </div>
      <div class="mb-3">
        <label for="text" class="form-label"><strong>Szöveg</strong></label>
        <textarea class="form-control" id="text" name="text" rows="3"required>{{$item->text}}</textarea>
      </div>
      <div class="mb-3">
      <img id="boritokep" src="{{asset('storage/' . $item->image_path )}}">
      </div>
      <div class="mb-3">
        <label for="image" class="form-label"><strong>Borítókép megváltoztatása</strong></label>
        <input class="form-control" type="file" name="image" id="image">
      </div>
      <div class="mb-3">
        <label for="price" class="form-label"><strong>Ár</strong></label>
        <input type="text" class="form-control" id="price" name="price" value="{{$item->price}}" required>
      </div>

      <button class="btn btn-primary" type="submit">Mentés</button>
      <a class="btn btn-secondary" href="/admin/webshop">Vissza</a>
    </form>
  </div>
  </main>

</body>
</html>