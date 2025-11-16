<link rel="stylesheet" href="{{asset('css/loginModal.css')}}">

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