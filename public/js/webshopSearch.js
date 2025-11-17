//From URL
window.addEventListener('DOMContentLoaded', function() {
  const urlParams = new URLSearchParams(window.location.search);
  const searchTerm = urlParams.get('search');
  
  if (searchTerm) {
    document.getElementById('searchInput').value = searchTerm;
    filterItems();
  }
  toggleClearButton(); // Check on page load
});

function updateUrl(searchTerm){
  const url = new URL(window.location);
  if (searchTerm) {
    url.searchParams.set('search', searchTerm);
  } else {
    url.searchParams.delete('search');
  }
  window.history.pushState({}, '', url);
}

function filterItems(clear = false) {
  const searchTerm = clear ? "" : document.getElementById('searchInput').value.toLowerCase().trim();
  
  // If we're on the item page, redirect to shop page with search term
  if (!document.getElementById('itemsContainer')) {
    const shopUrl = '/shop' + (searchTerm ? '?search=' + encodeURIComponent(searchTerm) : '');
    window.location.href = shopUrl;
    return;
  }
  
  updateUrl(searchTerm)
  
  // Filter
  const itemCards = document.querySelectorAll('.item-card');
  let visibleCount = 0;
  itemCards.forEach(card => {
    const name = card.getAttribute('data-name');
    const text = card.getAttribute('data-text');
    
    if (!searchTerm || name.includes(searchTerm) || text.includes(searchTerm)) {
      card.style.display = '';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  const noResults = document.getElementById('noResults');
  noResults.style.display = visibleCount === 0 ? 'block' : 'none';
}

function clearFilter(){
  document.getElementById('searchInput').value = "";
  filterItems(true);
  toggleClearButton();
}

function toggleClearButton(){
  const input = document.getElementById('searchInput');
  const clearBtn = document.getElementById('clearBtn');
  clearBtn.style.display = input.value.trim() ? 'block' : 'none';
}
