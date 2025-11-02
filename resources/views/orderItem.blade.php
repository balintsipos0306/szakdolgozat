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
    <link rel="stylesheet" href="../css/order.css">
    <title>Rendelés - Sipos Bálint</title>
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

        <h3>Jelenleg a webshopos fizetés nem üzemel, kérlek támogass <a href="https://revolut.me/bsipos03">revoluton</a></h3>
    </div>

  </main>
  <x-base-footer/>

</body>
</html>