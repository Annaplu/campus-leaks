@extends('layouts.app_Index')
@section('title', 'Campus Leaks_Index')

@section('content')
    

    <!-- services section start -->
    <div class="services_section layout_padding">
        <div class="container">
            <h1 class="services_taital">Metanoiac </h1>
            <p class="services_text">Ikuti dan temukan berbagai karya jurnalistik menarik seputar kampus maupun luar kampus</p>
            <div class="services_section_2">
                <div class="row">
                    <div class="col-md-4">
                        <div><img src="images/img-1.png" class="services_img"></div>
                        <div class="btn_main"><a href="https://www.metanoiac.id/category/metanews/">MetaNews</a></div>
                    </div>
                    <div class="col-md-4">
                        <div><img src="images/img-2.png" class="services_img"></div>
                        <div class="btn_main"><a href="https://www.metanoiac.id/e-buletin-metanoiac/">E-Buletin</a></div>
                    </div>
                    <div class="col-md-4">
                        <div><img src="images/img-3.png" class="services_img"></div>
                        <div class="btn_main"><a href="https://www.metanoiac.id/category/hiburan/sastra/">Sastra</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services section end -->

    

    <!-- blog section start -->
    <div class="blog_section layout_padding">
        <div class="container">
            <h1 class="blog_taital">See Our  Video</h1>
            <p class="blog_text">many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which</p>
            <div class="play_icon_main">
                <div class="play_icon"><a href="https://youtu.be/4epXHdwlxHw?si=yPHaOz8mJ8_EmB9E"><img src="images/play-icon.png"></a></div>
            </div>
        </div>
    </div>
    <!-- blog section end -->

    <!-- choose section start -->
    <div class="choose_section layout_padding">
        <div class="container">
            <h1 class="choose_taital">Kenapa Harus Melapor</h1>
            <p class="choose_text">Karena dengan melaporkan sebuah kejadian yang dapat memperburuk proses pembelajaran atau keamanan masyarakat kampus, kita dapat membantu diri kita sendiri untuk merasa lebih nyaman untuk berada di lingkungan tersebut. </p>
            <div class="newsletter_box">
                <h1 class="let_text">Ayo Laporkan Keresahan Anda</h1>
                <div class="getquote_bt"><a href="{{ url('/report') }}">Report</a></div>
            </div>
        </div>
    </div>
    <!-- choose section end -->
@endsection
