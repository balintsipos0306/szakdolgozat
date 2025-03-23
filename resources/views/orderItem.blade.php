<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/scrollbar.css">
    <link rel="stylesheet" href="../css/order.css">
    <title>Sipos Bálint - Szerkesztő felület</title>
</head>
<body id="page">

  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/adminLogin.js"></script>
  <script src ="../js/loader.js"></script>

  <header id="myheader">
    <div class= "logoholder">
      <img id = "logo" src="../../webp/tinywow_Logó.webp" alt="">
    </div>
  </header>

  <main>
    @if (!empty(Auth()->user()->name))
        @php
            $username = Auth()->user()->name;
        @endphp
        <h1>{{$username}}</h1>
    @endif

    <div class="container">
        @php
            $cart = DB::table('cart')->where('userID', Auth()->user()->id)->get();
        @endphp

        <div class="container" id="cart">
        @foreach ($cart as $item)
            @php
                $items = DB::table('webshop')->where('id', $item->itemID)->first();
            @endphp
            <div class="row">
                <div class="col">
                    <img src="{{ asset('storage/' . $items->image_path) }}" class="card-img-top" alt="...">
                </div>
                <div class="col">
                    <p>{{$items->name}}</p>
                </div>
                <div class="col">
                    <p>{{$items->price}}</p>
                </div>
                <div class="col">
                    <form action="/delete-from-cart" method="POST" class="d-flex align-items-center">
                    @csrf
                    <div class="mb-3">
                    <input type="hidden" name="userID" value="{{Auth()->user()->id}}" readonly>
                    </div>
                    <div class="mb-3">
                    <input type="hidden" name="itemID" value="{{$items->id}}" readonly>
                    </div>
                    <button id="deleteButton" type="submit"><img src="../webp/close.png" alt=""></button>
                </form>
                </div>
            </div>
        @endforeach
        </div>

        <hr>

        <form action="" method="POST">
            @csrf
            <div class="row g-2">
                <div class="col-auto">
                    <label for="firstname" class="form-label"><strong>Vezetéknév</strong></label>
                    <input type="text" class="form-control" name="lastname" required>
                </div>
                <div class="col-auto">
                    <label for="firstname" class="form-label"><strong>Keresztnév</strong></label>
                    <input type="text" class="form-control" name="firstname" required>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-auto">
                    <label for="irsz" class="form-label"><strong>Irányítószám</strong></label>
                    <input type="number" class="form-control" name="irsz" required>
                </div>
                <div class="col-auto">
                    <label for="city" class="form-label"><strong>Város</strong></label>
                    <input type="text" class="form-control" name="city" required>
                </div>
                <div class="col-auto">
                    <label for="street" class="form-label"><strong>Utca</strong></label>
                    <input type="text" class="form-control" name="street" required>
                </div>
                <div class="col-auto">
                    <label for="housenum" class="form-label"><strong>Házszám</strong></label>
                    <input type="text" class="form-control" name="housenum" required>
                </div>
            </div>
        </form>
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