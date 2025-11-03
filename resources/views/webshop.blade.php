<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/shop.css">
  <link rel="stylesheet" href="../css/scrollbar.css">
  <title>Webshop - Sipos Bálint</title>
</head>
<body id="page">

  <div class="loader"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/hamburger.js"></script>
  <script src="../js/adminLogin.js"></script>
  <script src ="../js/loader.js"></script>

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

  @if ($errors->any())
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto text-danger">Hiba</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const toastElement = document.getElementById('errorToast');
        if (toastElement) {
          const toast = new bootstrap.Toast(toastElement, { autohide: false });
          toast.show();
        }
      });
    </script>
  @endif

  <x-registration-modal/>
  <x-login-modal/>
  <x-cart-modal/>

  <x-webshop-header/>

  <main>
    <div class="container">
      <div class="nav">
        <form class="d-flex" role="search" action="/shop/search" method="GET">
          @csrf
          <input class="form-control me-2" type="search" placeholder="Keresés" aria-label="Keresés" name="input">
          <button class="btn btn-outline-success" type="submit">Keresés</button>
        </form>
      </div>

      <div class="items">
        @if(count($items) == 0)
          <h2 style="margin:auto;text-align:center">Az általad keresett termék nem található</h2>
        @endif
        <div class="row">
          @foreach ($items as  $item)
            <div class="col">
              <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{$item->name}}</h5>
                  <p id="szoveg"class="card-text">{{$item->text}}</p>
                  <p>...</p>
                  <a href="{{ route('item.open', ['id' => $item->id]) }}" class="btn btn-primary">Megnyitás</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>

  <x-base-footer/>
</body>
</html>