function showSidebar(){
  const sidebar = document.querySelector('.sidebar')
  sidebar.style.display = 'flex'
}

function hideSidebar(){
  const sidebar = document.querySelector('.sidebar')
  sidebar.style.display = 'none'
}

function toggleFilter() {
    const filter = document.getElementById('filterOptions');
    filter.style.display = filter.style.display === 'block' ? 'none' : 'block';
  }

  function selectFilter(element) {
  const selectedText = element.textContent;
  document.getElementById("selectedFilter").textContent = selectedText;
  toggleFilter();

  // Logika filter data bisa ditambahkan di sini
  console.log("Filter dipilih:", selectedText);
}

  // Tutup dropdown jika klik di luar
  window.onclick = function(e) {
    if (!e.target.closest('.filter-dropdown')) {
      document.getElementById('filterOptions').style.display = 'none';
    }
  };