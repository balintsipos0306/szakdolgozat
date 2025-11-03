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
            @endforeach
            <hr>  
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