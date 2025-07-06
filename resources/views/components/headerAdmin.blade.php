@push('styles')
<style>
  .header-admin {
    background-color: #8A0000;
    padding: 10px 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
  }

  .main-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .main-nav li {
    margin-left: 10px;
  }

  .main-nav li a {
    color: white;
    text-decoration: none;
    padding: 8px 12px;
    display: flex;
    align-items: center;
  }

  .logo-img {
    max-height: 50px;
  }

  .menu-button {
    display: none;
  }

  .logout-icon {
  display: flex;
  align-items: center;
}

.logout-icon form {
  display: flex;
  align-items: center;
}

.logout-icon button {
  background: none;
  border: none;
  padding: 8px 12px;
  margin: 0;
  cursor: pointer;
  display: flex;
  align-items: center;
}


  /* Sidebar */
  .sidebar {
    position: fixed;
    top: 70px; /* agar di bawah header */
    left: 0;
    width: 70%;
    height: calc(100vh - 70px);
    background-color: #8A0000;
    padding: 20px;
    z-index: 999;
    display: none;
  }

  .sidebar ul {
    list-style: none;
    padding: 0;
  }

  .sidebar li {
    margin-bottom: 15px;
  }

  .sidebar li a {
    color: white;
    text-decoration: none;
  }

  /* Active sidebar */
  .sidebar.active {
    display: block;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .hideOnMobile {
      display: none;
    }

    .menu-button {
      display: inline;
    }
  }

  @media (min-width: 769px) {
    .sidebar {
      display: none !important;
    }
  }

</style>
@endpush

<nav class="header-admin">
  <ul class="main-nav">
    <li>
      <a href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="logo-img">
      </a>
    </li>
    <li class="hideOnMobile {{ Route::is('admin.dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="hideOnMobile {{ Route::is('admin.pengguna') ? 'active' : '' }}">
      <a href="{{ route('admin.pengguna') }}">Pengguna</a>
    </li>
    <li class="hideOnMobile {{ Route::is('admin.informasi') ? 'active' : '' }}">
      <a href="{{ route('admin.informasi') }}">Informasi</a>
    </li>
    <li class="hideOnMobile logout-icon">
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="white">
            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/>
          </svg>
        </button>
      </form>
    </li>
    <li class="menu-button" onclick="showSidebar()">
      <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="white">
          <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
        </svg>
      </a>
    </li>
  </ul>
</nav>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <ul>
    <li onclick="hideSidebar()" style="text-align: right;">
      <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="white">
          <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
        </svg>
      </a>
    </li>
    <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="{{ Route::is('admin.pengguna') ? 'active' : '' }}">
      <a href="{{ route('admin.pengguna') }}">Pengguna</a>
    </li>
    <li class="{{ Route::is('admin.informasi') ? 'active' : '' }}">
      <a href="{{ route('admin.informasi') }}">Informasi</a>
    </li>
    <li>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" style="background: none; border: none; padding: 0; margin: 0; cursor: pointer;">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="white">
            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/>
          </svg>
        </button>
      </form>
    </li>
  </ul>
</div>


@push('scripts')
<script>
  function showSidebar() {
    document.getElementById('sidebar').classList.add('active');
  }

  function hideSidebar() {
    document.getElementById('sidebar').classList.remove('active');
  }

</script>
@endpush