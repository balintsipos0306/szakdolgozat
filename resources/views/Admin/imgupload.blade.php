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
      <link rel="stylesheet" href="../css/Admin/imageControl.css">
      <title>Sipos Bálint - Szerkesztő felület</title>
  </head>
  <body id="page">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <header>  
      <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
          <div class="imgholder">
              <img id="logo" src="../webp/tinywow_Logó.webp" alt="">
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
                  <a class="nav-link" href="#" disabled = true>Képek feltöltése</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/webshop">Webshop szerkesztése</a>
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
      <h1>Képek</h1>

      @php
          $pictures = DB::table('gallery')->get()
      @endphp

      <div class="container">
        <div class="container mt-4" id="table">
            <div class="row">
              <div class="col d-flex align-items-center justify-content-center">
                <h2>ID</h2>
              </div>    
              <div class="col d-flex align-items-center justify-content-center">
                <h2>Kép</h2>
              </div>
              <div class="col d-flex align-items-center justify-content-center">
                <h2>Kategória</h2>
              </div>
              <div class="col d-flex align-items-center justify-content-center">
                <h2>Törlés</h2>
              </div>
            </div>
              
            @foreach($pictures as $picture)
              <div class="row">
                  <div class="col d-flex align-items-center justify-content-center" id="col">
                    <p>{{$picture->id}}</p>
                  </div>
                  <div class="col d-flex align-items-center justify-content-center" id="col">
                    <img src="{{ asset('storage/' . $picture->image_path) }}">
                  </div>
                  <div class="col d-flex align-items-center justify-content-center" id="col">
                    <p>{{$picture->category}}</p>
                  </div>
                  <div class="col d-flex align-items-center justify-content-center" id="col">
                  <form action="/rm-image" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input type="number" name="id" class="form-control" value="{{ $picture->id }}" readonly hidden>
                    </div>
                    <button id="delete" type="submit"><img src="../webp/close.png" alt=""></button>
                  </form>
                  </div>
              </div>
            @endforeach
        </div>

        <div class="controls">
          <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Képek feltöltése
          </button>

          <div class="collapse" id="collapseExample">
            <div class="card card-body"> 
              <form action="/upload" method="POST" enctype="multipart/form-data">
              @csrf
              <div>
                  <label for="category">Kategória:</label>
                  <select class="form-select" name = "category" aria-label="Default select example" required>
                    <option value="Természet" id="category">Természet</option>
                    <option value="Rendezvény" id="category">Rendezvény</option>
                    <option value="Portré" id="category">Portré</option>
                  </select>
              </div>

              <div class="mb-3">
                <label for="image" class="form-label">Kép feltöltése</label>
                <input class="form-control" type="file" name="image" id="image" required>
              </div>
              
              <button class="btn btn-primary" type="submit">Feltöltés</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </main>

  </body>
  </html>