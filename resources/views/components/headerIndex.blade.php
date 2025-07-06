<!-- header section start -->
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
                                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

   <!-- banner section start -->
   <div class="banner_section layout_padding">
      <div id="carouselBanner" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">

         <!-- ❌ HAPUS INDICATORS -->
         <!-- <ol class="carousel-indicators">...</ol> -->

         <!-- Slides -->
         <div class="carousel-inner">
            @isset($beritaBanner)
               @foreach ($beritaBanner as $index => $berita)
                  <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                     <div class="container">
                        <h1 class="banner_taital fade-text" style="font-size: 40px; font-weight: bold;">
                           {{ $berita->judul }}
                        </h1>
                        <p class="banner_text fade-text" style="font-size: 16px;">
                           {{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 100, '...') }}
                        </p>
                        <div class="read_bt fade-text">
                           <a href="{{ $berita->url }}" target="_blank">Selengkapnya</a>
                        </div>
                     </div>
                  </div>
               @endforeach
            @endisset
         </div>

         <!-- Controls -->
         <a class="carousel-control-prev" href="#carouselBanner" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselBanner" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
   </div>
   <!-- banner section end -->
</div>



