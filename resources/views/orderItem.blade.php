<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/orderPage.css')}}">
    <title>Rendelés - Sipos Bálint</title>
</head>
<body id="page">

  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src ="../js/loader.js"></script>

  <header id="myheader">
    <div class= "logoholder">
      <img id = "logo" src="../../webp/tinywow_Logó.webp" alt="">
    </div>
  </header>
  <x-system-feedback/>

  <main>
    @if (!empty(Auth()->user()->name))
        @php
            $username = Auth()->user()->name;
        @endphp
        <h1>{{$username}}</h1>
    @endif

    <div class="container">
        <div class="container" id="cart">
        @foreach ($items as $item)
            <div class="row">
                <div class="col">
                    <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="...">
                </div>
                <div class="col">
                    <p>{{$item->name}}</p>
                </div>
                <div class="col">
                    <p>{{$item->price}} Ft</p>
                </div>
                <div class="col">
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
        @endforeach
        </div>

        <div class="container" id="szum">
            <p>Végősszeg: {{ $sum }} Ft</p>
        </div>
        <hr>
        <h3>Jelenleg a webshopos fizetés nem üzemel, kérlek támogass <a href="https://revolut.me/bsipos03">Revoluton</a></h3>
    </div>

  </main>
    
  <div style= "position: relative; margin-top: 3em">
    <x-base-footer/>
  </div>

</body>
</html>