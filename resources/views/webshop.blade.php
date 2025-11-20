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
  <script src ="../js/loader.js"></script>

  <x-system-feedback/>
  <x-registration-modal/>
  <x-login-modal/>
  <x-cart-modal/>

  <x-webshop-header/>

  <main>
    <div class="container">
      <x-webshop-search/>

      <div class="items">
        <h2 id="noResults" style="margin:auto;text-align:center;display:none">Az általad keresett termék nem található</h2>
        
        <div class="row" id="itemsContainer">
          @foreach ($items as  $item)
            <div class="col item-card" 
                 data-name="{{strtolower($item->name)}}" 
                 data-text="{{strtolower($item->text)}}">
              <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{$item->name}}</h5>
                  <p id="szoveg"class="card-text">{{Str::limit($item->text, 40)}}</p>
                  <a href="{{ route('item.open', ['id' => $item->id]) }}" class="btn btn-primary">Megnyitás</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>

  <div style="margin-top: 10em">
    <x-base-footer/>
  </div>
</body>
</html>