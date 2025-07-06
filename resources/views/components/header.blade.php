   <div class="header_section">
      <div class="header_main">
         <div class="mobile_menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <div id="logo" class="pull-left">
                  <h1>
                     <a href="#intro">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="img-fluid" style="max-height: 60px;">
                     </a>
                  </h1>
               </div>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                           <li class="nav-item">
                              <a class="nav-link" href="{{ url('/') }}">Home</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="{{ url('/about') }}">About</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="{{ url('/report') }}">Report</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="{{ url('/riwayat') }}">History</a>
                           </li>
                           @if (Auth::check())
                              <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil Saya</a>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0 m-0">
                                       @csrf
                                       <button type="submit" class="btn btn-link p-0 m-0">Logout</button>
                                    </form>
                                 </div>
                              </li>
                           @else
                              <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                           @endif
                        </ul>
                     </div>
            </nav>
         </div>

         <div class="container-fluid">
            <div class="logo"><a href="{{ url('/') }}"><img src="images/logo1.png" style="max-height: 100px;"></a></div>
            <div class="menu_main">
               <ul>
                  <li><a href="{{ url('/') }}">Home</a></li>
                  <li><a href="{{ url('/about') }}">About</a></li>
                  <li><a href="{{ url('/report') }}">Report</a></li>
                  <li><a href="{{ url('/riwayat') }}">History</a></li>
                  @if(Auth::check())
                  <li><a href="{{ route('profile.edit') }}">Hi, {{ Auth::user()->name }}</a></li>
                  <li>
                     <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:white; cursor:pointer;">Logout</button>
                     </form>
                  </li>
                  @else
                  <li><a href="{{ route('login') }}">Login</a></li>
                  <li><a href="{{ route('register') }}">Register</a></li>
                  @endif
               </ul>
            </div>
         </div>
      </div>     
   </div>