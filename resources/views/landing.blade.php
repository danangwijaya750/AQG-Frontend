@extends('layouts.landing_skeleton')
@push('stylesheet')
@endpush
@section('app')
    {{-- Preloader --}}
    <div class="preloader w-100 h-100 position-fixed">
        <span class="loader"> Loading… </span>
    </div>

    {{-- Nav --}}
    <header class="header">
        <div class="header-main rounded-full">
            @include('navbar_landing')
        </div>
    </header>

    {{-- Banner --}}
    <div class="banner" data-aos="fade-up" data-aos-anchor="#app">
        <div class="banner_slider">
            <div class="single_slide">
                <div class="container">
                    <div class="banner-images row justify-content-between align-items-end">
                        <div class="container">
                            <div class="row pb-0">
                                <div class="col-lg-6">
                                    {{-- Event Title --}}
                                    <div class="section-title style--two">

                                        <p class="up2">AUTOMATIC <br> QUESTION <br> GENERATOR</p>
                                        <p class="up4">Platform Manajemen Soal Termudah</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('register') }}"> <button class="btn-branch">Mulai Daftar
                                                🔥</button></a>
                                        <a class="page-scroll" href="#tentang"><button class="btn-pelajari">Pelajari
                                                lebih lanjut</button></a>
                                    </div>

                                    {{-- Social --}}
                                    {{-- <div class="mt-40">
                                        <ul class="social_icon_list">
                                            <li class="h-24">
                                                <a href="https://instagram.com/nalarinuny/">
                                                    <i class="fa fa-github"></i>
                                                    <span class="lh-30">
                                                        nalarinuny
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="h-24">
                                                <a href="https://t.me/nalarinuny2022">
                                                    <i class="fa fa-telegram"></i>
                                                    <span class="lh-30">
                                                        t.me/nalarinuny2022
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> --}}
                                </div>

                                {{-- Banner Image --}}
                                <div class="col-lg-6 order-first order-lg-last">
                                    <img class="pt-4" width="100%" src="https://ahsanf.github.io/AQG-Frontend/public/assets/landing/img/landing.png"
                                        alt="" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cabang Lomba --}}
    <section class="pt-5 pb-80" id="tentang" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-left">
                        <h2 class="section-title text-center">
                            Apa Itu AQG
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">

            {{-- Video Opini --}}
            <div class="row justify-content-between align-items-center pb-10" data-aos="fade-up" data-aos-anchor="#app">
                <div class="col-lg-5">
                    <div class="mb-50 mb-lg-0">
                        <img src="https://ahsanf.github.io/AQG-Frontend/public/assets/landing/img/desc.png" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title style--two">
                        <div class="title-border">
                            <span></span> <span></span> <span></span>
                        </div>
                        <h2 class="branch-title">Generate Soal Dengen Artificial Intelligence</h2>
                        <p class="branch-decs">

                            Natural Language Processing (NLP) adalah salah satu bidang di Artificial Intelligence yang paling populer dan memiliki banyak
                            aplikasinya seperti untuk text summarization, machine translation, question answering, dan automatic question generator .
                            AQG merupakan sebuah sistem yang dapat membuat pertanyaan dari informasi yang ada berupa teks dengan menggunakan algoritma tertentu dan pola tertentu.

                        </p>

                    </div>
                </div>
            </div>


        </div>
    </section>

    {{-- Update Info --}}
    <section class="pt-90" id="quiz" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="section-title">
                            HASIL GENERATE SOAL YANG DIBAGIKAN
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-40" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            @if (count($data['quiz']) > 0)
                <div class="row d-flex justify-content-center">
                    @foreach ($data['quiz'] as $row)
                        <div class="col-sm-4">
                            <div class="card card-shadow">
                                <div class="card-header">
                                    <h5 class="card-title mt-2 text-capitalize">{{ $row->title }}</h5>

                                </div>
                                <div class="card-body">
                                    <p class="card-text pb-20 branch-decs update">
                                        Mata Pelajaran : {{ $row->lesson->title }}
                                        <br>
                                        Tingkat Pendidikan : {{ $row->lesson->level->title }}
                                        <br>
                                        Oleh : {{ $row->user->name }}
                                    </p>
                                    <a href="{{ route('quiz.detail', ['id' => $row->id] ) }}"
                                        class="btn btn-primary btn-branch">
                                        Selengkapnya
                                        <i class="ml-2 fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center">
                    <img src="https://ahsanf.github.io/AQG-Frontend/public/assets/landing/img/empty_info.png" alt="" srcset="">
                    <h4 class="pt-2">Saat ini belum ada pertanyaan yang dibagikan.</h4>
                </div>
            @endif
            <div class="row mt-40">
                <div class="col-lg-12 text-center mt-10">
                    <a href="#" class="btn-branch">Lihat Semua <i class="ml-2 fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </section>

       {{-- Update Info --}}
       <section class="pt-20 mt-80" id="study" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="section-title">
                            MATERI YANG DIBAGIKAN
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-40" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            @if (count($data['studies']) > 0)
                <div class="row d-flex justify-content-center">
                    @foreach ($data['studies'] as $row)
                        <div class="col-sm-4">
                            <div class="card card-shadow">
                                <div class="card-header">
                                    <h5 class="card-title mt-2 text-capitalize">{{ $row->title }}</h5>

                                </div>
                                <div class="card-body">
                                    <p class="card-text pb-20 branch-decs update">
                                        Mata Pelajaran : {{ $row->lesson->title }}
                                        <br>
                                        Tingkat Pendidikan : {{ $row->lesson->level->title }}
                                        <br>
                                        Oleh : {{ $row->user->name }}
                                    </p>
                                    <a href="{{ route('quiz.detail', ['id' => $row->id] ) }}"
                                        class="btn btn-primary btn-branch">
                                        Selengkapnya
                                        <i class="ml-2 fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center">
                    <img src="https://ahsanf.github.io/AQG-Frontend/public/assets/landing/img/empty_info.png" alt="" srcset="">
                    <h4 class="pt-2">Saat ini belum ada materi yang dibagikan.</h4>
                </div>
            @endif
            <div class="row mt-40">
                <div class="col-lg-12 text-center mt-10">
                    <a href="#" class="btn-branch">Lihat Semua <i class="ml-2 fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </section>


    {{-- FAQ --}}
    <section class="pt-40 mt-20" id="faq" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="section-title pt-80 pb-40">
                            FAQ
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row mb-40">
                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                <h2 class="mb-0">
                                    <button class="btn-link" type="button">
                                        Apakah AQG platfrom gratis ?
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Ya, AQG adalah platfrom manajemen soal gratis.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                <h2 class="mb-0">
                                    <button class="btn-link collapsed" type="button">
                                        Apakah untuk generate soal wajib registrasi ?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                   Ya, untuk melakukan generate soal harus registrasi terlebih dahulu
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-10 mb-100">
                <div class="col-lg-12 text-center mt-10">
                    <a href="https://wa.me/6281359888622" class="btn-branch">Ajukan
                        pertanyaan</a>
                </div>
            </div>
        </div>
    </section>



    {{-- Gallery Section --}}
    {{-- <section class="pt-140" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="section-title">
                            GALERI
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-140" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button class="gl"><a class="more" href="#">Lihat lebih banyak</a></button>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- Footer --}}
    <footer class="footer c1-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="widget widget_about">
                        <div class="widget-logo">
                            <img src="https://ahsanf.github.io/AQG-Frontend/public/assets/landing/img/logo_white.svg" data-rjs="2" alt="" />
                        </div>

                        <div style="padding-bottom: 10px"><b style="color: white; font-size: 24px">Automatic Question Generator</b></div>
                        <div class="about-text">
                            {{-- <p>
                                    Kompetisi ini diselenggarakan oleh Universitas Negeri Yogyakarta dengan tujuan mengajak
                                    seluruh mahasiswa Indonesia berperan serta dalam mewujudkan kelayakan dan/atau
                                    kesiapan tujuan SDGs di era industri digital 4.0.
                                </p> --}}
                            <p>
                                Tim DikasihRegexDong <br>
                                Jalan Colombo No. 1, Karangmalang, Depok, Sleman, <br>
                                Daerah Istimewa Yogyakarta
                            </p>
                        </div>
                    </div>
                    <div class="widget widget_social_icon">
                        <div style="padding-bottom: 10px"><b style="color: white; font-size: 16px">Kontak</b></div>
                        <ul class="">
                            <li>
                                <a href="https://instagram.com/infinite.uny/"><i class="fa fa-instagram"></i>
                                    infinite.uny
                                </a>
                            </li>

                            <li>
                                <a href="https://api.whatsapp.com/send/?phone=6281359888622"><i class="fa fa-phone"></i>
                                    +62 813 5988 8622 (Ahsan Kun)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 d-flex align-items-center justify-content-end">
                    <div>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#tentang">Tentang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#quiz">Soal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#study">Materi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#faq">FAQ</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <hr color="white" style="opacity: 0.2">
            <div class="row">
                <div class="col-12">
                    <p class="text-center txt-footer">
                        Crafted
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        by
                        <a href="https://hello.infiniteuny.id/">
                           Tim DikasihRegexDong
                        </a>
                        | Universitas Negeri Yogyakarta &copy;
                        {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('javascript')
@endpush
