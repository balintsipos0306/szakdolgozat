  <link rel="stylesheet" href="{{asset('css/cart.css')}}">

<div class="offcanvas offcanvas-end" tabindex="-1" id="cart" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Kosár</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      @if (!empty(Auth()->user()->name))
        @if ($hasItems)
          <div class="container">
            @foreach ($cartItems as $cart)
              @if($cart->item)
              <div class="row">
                <div class="col d-flex align-items-center"><img src="{{ asset('storage/' . $cart->item->image_path) }}" class="card-img-top" alt="..."></div>
                <div class="col d-flex align-items-center"><a href="/shop/item/{{$cart->item->id}}"><h7>{{$cart->item->name}}</h7></a></div>
                <div class="col d-flex align-items-center"><i>{{$cart->item->price}} Ft</i></div>
                <div class="col d-flex align-items-center">
                  <form action="/delete-from-cart" method="POST" class="d-flex align-items-center">
                    @csrf
                    <div class="mb-3">
                      <input type="hidden" name="userID" value="{{Auth()->user()->id}}" readonly>
                    </div>
                    <div class="mb-3">
                      <input type="hidden" name="itemID" value="{{$cart->item->id}}" readonly>
                    </div>
                    <button id="deleteButton" type="submit"><img src="{{asset('webp/close.png')}}" alt=""></button>
                  </form>
                </div>
              </div>
              @endif
            @endforeach
            <hr>  
          </div>
          <div class="container" id="sum">
            <hr class="border border-secondary border-3 opacity-75">
            <p><i><b>Összesen</b>: {{$cartSum}} Ft</i></p>
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