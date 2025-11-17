//From URL on page load
window.addEventListener('DOMContentLoaded', function() {
  const urlParams = new URLSearchParams(window.location.search);
  const searchTerm = urlParams.get('search');
  
  if (searchTerm) {
    document.getElementById('searchInput').value = searchTerm;
    filterItems();
  }
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

function filterItems() {
  const searchInput = document.getElementById('searchInput');
  const searchTerm = searchInput.value.toLowerCase().trim();
  const itemCards = document.querySelectorAll('.item-card');
  let visibleCount = 0;
  
  updateUrl(searchTerm)

  // Filter items
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

  // Show/hide "no results" message
  const noResults = document.getElementById('noResults');
  noResults.style.display = visibleCount === 0 ? 'block' : 'none';
}
