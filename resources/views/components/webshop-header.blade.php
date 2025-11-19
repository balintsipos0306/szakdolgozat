<link rel="stylesheet" href="{{ asset('css/baseHeader.css') }}">
<link rel="stylesheet" href="{{ asset('css/webshopHeader.css') }}">
<script src="{{asset('js/adminLogin.js')}}"></script>

<div>
<header id="myheader">

    <x-hamburger-menu/>

    <div class= "logoholder">
      <img id = "logo" src="../../webp/tinywow_Logó.webp" alt="">
    </div>

    <nav id = "navigation">
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
          @if (!empty(Auth()->user()->name))
            <li class="nav-item" id="nameHolder">
              <p id="username">{{Auth()->user()->name}}</p>
            </li>
          @endif
        <li class="nav-item">
          <a data-bs-toggle="modal" data-bs-target="#login"><img id="icon" src="../../webp/user.png" alt=""></a>
        </li>
        <li class="nav-item">
          @if ($hasCartItems)
            <a data-bs-toggle="offcanvas" href="#cart" role="button" aria-controls="offcanvasExample"><img id="icon" src="../../webp/shopping-cart-item.png" alt=""></a>
          @else
            <a data-bs-toggle="offcanvas" href="#cart" role="button" aria-controls="offcanvasExample"><img id="icon" src="../../webp/shopping-cart.png" alt=""></a>
          @endif
        </li>
      </ul>
    </div>
  </header>
</div>