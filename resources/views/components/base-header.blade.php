<link rel="stylesheet" href="{{ asset('css/baseHeader.css') }}">
<script src="{{asset('js/adminLogin.js')}}"></script>

<div>
    <header id="myheader">
        <x-hamburger-menu/>

        <div class= "logoholder">
        <img id = "logo" src= {{ asset('webp/tinywow_Logó.webp') }} alt="">
        </div>

        <nav id = "navv">
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
    </header> 
</div>