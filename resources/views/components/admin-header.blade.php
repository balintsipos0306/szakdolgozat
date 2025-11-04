  <header>  
    <nav class="navbar bg-body-tertiary fixed-top">
      <div class="container-fluid">
        <div class="imgholder">
            <img id="logo" src="{{ asset('webp/tinywow_Logó.webp') }}" alt="">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menü</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/admin">Körlevél küldése</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/admin/blog">Blog szerkesztés</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/image-upload">Képek feltöltése</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/webshop">Webshop szerkesztése</a>
              </li>
            </ul>
            <form action="/logout" method="POST" id="logout">
            @csrf
            @method('DELETE')
            <button id="signout" type="submit" class="btn btn-primary">Kilépés</button>
        </form>
          </div>
        </div>
      </div>
    </nav>
  </header>