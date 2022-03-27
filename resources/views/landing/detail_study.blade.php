@extends('layouts.landing_skeleton')
@push('stylesheet')
    <link rel="stylesheet" href="https://ahsanf.github.io/AQG-Frontend/public/assets/assets/css/blog.css" />
@endpush
@section('app')
    {{-- Preloader --}}
    <div class="preloader w-100 h-100 position-fixed">
        <span class="loader"> Loading… </span>
    </div>

    {{-- Nav --}}
    <header class="header">
        <div class="header-main">
            @include('navbar_landing')
        </div>
    </header>

    <section class="pb-140 pt-140">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <article class="blog-post pt-4">
                        <h2 class="blog-post-title text-capitalize">{{ $data['study']['title'] }}</h2>
                        <p class="blog-post-meta">
                            Mata Pelajaran : {{ $data['study']['lesson']['title'] }}
                            <br>
                            Tingkat Pendidikan : {{ $data['study']['lesson']['level']['title']}}
                            <br>
                            Oleh : {{ $data['study']['user']['name'] }}
                        </p>
                        <hr>

                        <b>Materi</b>
                        <p>
                            {{ strip_tags($data['study']['desc']) }}
                        </p>

                    </article>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-left mt-10">
                    <a href="{{ route('study.public.pdf', ['id' => $data['study']['id']]) }}" class="btn-branch">Unduh Materi </a>
                </div>
            </div>
        </div>
    </section>
@include('landing.footer')
@endsection
@push('javascript')
@endpush
