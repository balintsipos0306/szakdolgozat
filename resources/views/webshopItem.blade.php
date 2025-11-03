<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/shopItem.css">
    <link rel="stylesheet" href="../../css/scrollbar.css">
    <title>Webshop - Sipos Bálint </title>
</head>
<body id="page">

  <div class="loader">

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../../js/hamburger.js"></script>
  <script src="../../js/adminLogin.js"></script>
  <script src="../../js/adminLogin.js"></script>
  <script src="../../js/loader.js"></script>

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
            @php
                $item = DB::table('webshop')->where('id', $id)->first();
                $allItems = DB::table('webshop')->get();
            @endphp

            <div class="row">
                <div class="col">
                <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="...">
                </div>
                <div class="col">
                    <a href="/shop" ><img src="../../webp/back-button.png" id="backIcon" alt=""></a>
                    <p id="price">{{$item->price}} Ft</p>
                    <div class="content">
                        <h2>{{$item->name}}</h2>
                        <section>
                            {{$item->text}}
                        </section>
                    </div>
                    @if (!empty(Auth()->user()->name))
                        <form action="/item-to-cart" method="POST">
                          @csrf
                          <div class="mb-3">
                            <input type="hidden" class="form-control" id="ID" name="itemID" value="{{$id}}">
                          </div>
                          <div class="mb-3">
                            <input type="hidden" class="form-control" id="ID" name="userID" value="{{Auth()->user()->id}}">
                          </div>
                          <button type="submit" class="btn btn-light" id="cartbutton">
                            <img src="../../webp/shopping-cart.png" id="icon" alt="">
                            <i>Kosárba</i>
                        </button>
                        </form>
                    @else
                        <button type="button" class="btn btn-light" id="cartbutton" disabled>
                            <img src="../../webp/shopping-cart.png" id="icon" alt="">
                            <i>Kosárba</i>
                        </button>
                        <i id="cartAlert">A kosárhoz előbb lépj be</i>
                    @endif
                </div>
            </div>

            <h2><u>További termékek</u></h2>

            <div class="row d-flex flex-nowrap" id="felsorolas">
                @foreach ($allItems as $items)
                    @if ($items->name != $item->name)                    
                    <div class="col">
                        <div class="card" aria-hidden="true">
                            <img src="{{ asset('storage/' . $items->image_path) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">
                                <span>{{$items->name}}</span>
                                </h5>
                                <p class="card-text" id="szoveg">{{$items->text}}...</p>
                                <a class="btn btn-primary col-6" href="{{ route('item.open', ['id' => $items->id]) }}">Megnyitás</a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

        </div>

    </div>
  </main>

  <x-base-footer/>

</body>
</html>