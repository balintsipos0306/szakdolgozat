<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <title>Sipos Bálint - Szerkesztő felület</title>
</head>
<body id="page">

  <div class="loader">

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="js/hamburger.js"></script>
  <script src="js/adminLogin.js"></script>
  <script src ="js/loader.js"></script>

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

  <div class="modal fade" id="reg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Regisztráció</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/webshop/registrate" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Felhasználónév</label>
            <input type="text" class="form-control" aria-describedby="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" aria-describedby="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control" aria-describedby="password" name="password" required>
          </div>
          <div class="form-check" id="check">
            <input name="checkbox" type="checkbox" class="form-check-input" value="true">
            <label class="form-check-label" for="checkbox">Feliratkozom a hírlevélre</label>
          </div>
          <div class="buttons">
              <button type="submit" class="btn btn-primary">Regisztrálás</button>
          </div>
        </form>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#login">Vissza</button>
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      @if (!empty(Auth()->user()->name))
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Kilépés</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="/webshop/logout" method="POST" id="logout">
            @csrf
            @method('DELETE')
            <button id="signout" type="submit" class="btn btn-primary">Kijelentkezés</button>
          </form>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vissza</button>
      </div>
      @else
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Belépés</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/webshop/login" method="POST">
        @csrf
        <div class="mb-3">
        <label for="name" class="form-label">Felhasználónév</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="name">
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Jelszó</label>
        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="password" name="password">
        </div>
        <div class="buttons">
            <button type="submit" class="btn btn-primary">Belépés</button>
            <p>Nincs még fiókja?<a href="#reg" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#reg">Regisztráljon</a></p>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vissza</button>
      </div>
      @endif
    </div>
  </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="cart" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Kosár</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  @if (!empty(Auth()->user()->name))
    @php
      $cartitems = DB::table('cart')->where('userID', Auth()->user()->id)->get();
      $hasItems = DB::table('cart')->where('userID', Auth()->user()->id)->first();
    @endphp
    @if (!empty($hasItems))
      <div class="container">
        @foreach ($cartitems as $cart)
          @php
            $item = DB::table('webshop')->where('id', $cart->itemID)->first();
          @endphp
          <div class="row">
            <div class="col d-flex align-items-center"><img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="..."></div>
            <div class="col d-flex align-items-center"><a href="/shop/item/{{$item->id}}"><h7>{{$item->name}}</h7></a></div>
            <div class="col d-flex align-items-center"><i>{{$item->price}} Ft</i></div>
            <div class="col d-flex align-items-center">
              <form action="/delete-from-cart" method="POST" class="d-flex align-items-center">
                @csrf
                <div class="mb-3">
                  <input type="hidden" name="userID" value="{{Auth()->user()->id}}" readonly>
                </div>
                <div class="mb-3">
                  <input type="hidden" name="itemID" value="{{$item->id}}" readonly>
                </div>
                <button id="deleteButton" type="submit"><img src="../webp/close.png" alt=""></button>
              </form>
            </div>
          </div>
          <hr>
        @endforeach
      </div>
      <div class="container" id="sum">
        @php
          $sum = 0;
          foreach($cartitems as $cart){
            $i = DB::table('webshop')->where('id', $cart->itemID)->first();
            $sum += $i->price;
          }
        @endphp
        <hr class="border border-secondary border-3 opacity-75">
        <p><i><b>Összesen</b>: {{$sum}} Ft</i></p>
        <div class="buttonholder">
          <a class="btn btn-primary" href="/shop/order" target="_blank">Megrendelem</a>
        </div>
      </div>
    @else
    <div>
      Az ön kosara még üres
    </div>
    @endif
  @else
    <p>Kosár használatához, először lépj be</p>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login">Belépés</button>
  @endif
  </div>
</div>

  <header id="myheader">
    <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
    </div>
    <div class= "logoholder">
      <img id = "logo" src="../../webp/tinywow_Logó.webp" alt="">
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
            <a class="nav-link" href="/blog">Blog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/shop">Webshop</a>
        </li>
      </ul>
    </nav>
    <div class="container">
        <ul id="iconList" class="nav">
       <li class="nav-item">
       @if (!empty(Auth()->user()->name))
              <p id="username">{{Auth()->user()->name}}</p>
            @endif
       </li>
        <li class="nav-item">
            <a data-bs-toggle="modal" data-bs-target="#login"><img id="icon" src="../../webp/user.png" alt=""></a>
        </li>
        <li class="nav-item">
          @if (empty(Auth()->user()->name))
          <a data-bs-toggle="offcanvas" href="#cart" role="button" aria-controls="offcanvasExample"><img id="icon" src="../../webp/shopping-cart.png" alt=""></a>
          @else
            @php
              $cartitems = DB::table('cart')->where('userID', Auth()->user()->id)->first();
            @endphp
            @if (empty($cartitems))
              <a data-bs-toggle="offcanvas" href="#cart" role="button" aria-controls="offcanvasExample"><img id="icon" src="../../webp/shopping-cart.png" alt=""></a>
            @else
              <a data-bs-toggle="offcanvas" href="#cart" role="button" aria-controls="offcanvasExample"><img id="icon" src="../../webp/shopping-cart-item.png" alt=""></a>   
            @endif
          @endif
        </li>
        </ul>
    </div>
  </header>

  <main>
    <div class="container">
        <div class="nav">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Keresés" aria-label="Keresés">
                <button class="btn btn-outline-success" type="submit">Keresés</button>
            </form>
        </div>

        <div class="items">

            @php
                $items = DB::table('webshop')->get();
            @endphp

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