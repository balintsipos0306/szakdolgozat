<link rel="stylesheet" href="{{asset('css/webshopSearch.css')}}">

<div class="search">
  <form class="d-flex" role="search" id="searchForm" onsubmit="return false;">
    <input 
      class="form-control me-2" 
      type="search" 
      placeholder="Keresés" 
      aria-label="Keresés" 
      name="input"
      id="searchInput"
      autocomplete="off"
      oninput="toggleClearButton()">
    <button class="btn btn-outline-success" type="button" onclick="filterItems()">Keresés</button>
    <button class="btn btn-outline-danger" type="button" onclick="clearFilter()" id="clearBtn" style="display:none;">Törlés</button>
</form>
</div>

<script src="{{asset('/js/webshopSearch.js')}}"></script>