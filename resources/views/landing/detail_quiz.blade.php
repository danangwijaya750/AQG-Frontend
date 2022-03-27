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
                        <h2 class="blog-post-title text-capitalize">{{ $data['quiz']['title'] }}</h2>
                        <p class="blog-post-meta">
                            Mata Pelajaran : {{ $data['quiz']['lesson']['title'] }}
                            <br>
                            Tingkat Pendidikan : {{ $data['quiz']['lesson']['level']['title']}}
                            <br>
                            Oleh : {{ $data['quiz']['user']['name'] }}
                        </p>
                        <hr>

                        <b>Soal</b>
                        @foreach (json_decode($data['quiz']['questions'],true) as  $question)
                        <br>
                        <p>Klasifikasi: {{ $question['name'] }} </p>
                        @foreach ($question['q'] as $q)
                        <p>
                            {{ $loop->iteration }}.     {{ $q }}
                        </p>
                        @endforeach
                        @endforeach
                    </article>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-left mt-10">
                    <a href="{{ route('quiz.public.pdf', ['id' => $data['quiz']['id']]) }}" class="btn-branch">Unduh Soal </a>
                </div>
            </div>
        </div>
    </section>
@include('landing.footer')
@endsection
@push('javascript')
@endpush
