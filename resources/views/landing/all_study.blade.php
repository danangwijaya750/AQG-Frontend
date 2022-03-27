
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
    <div class="header-main rounded-full">
        @include('navbar_landing')
    </div>
</header>

<section class="mt-40" data-aos="fade-up" data-aos-anchor="#app">
    <div class="container">
        @if (count($data['study']) > 0)
            <div class="row d-flex justify-content-center pt-120">
                <div class="row">
                    @foreach ($data['study'] as $row)
                    <div class="col-sm-4">
                        <div class="card card-shadowm mt-4">
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
                                <a href="{{ route('study.detail', ['id' => $row->id] ) }}"
                                    class="btn btn-primary btn-branch">
                                    Selengkapnya
                                    <i class="ml-2 fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="row mt-40 pb-60">
                    <div class="col-lg-12 text-center mt-10">
                        <a href="{{ url('/') }}" class="btn-branch">Kembali <i class="ml-2 fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state text-center">
                <img src="https://ahsanf.github.io/AQG-Frontend/public/img/empty_info.png" alt="" srcset="">
                <h4 class="pt-2">Saat ini belum ada materi yang dibagikan.</h4>
            </div>
        @endif

    </div>
</section>
@include('landing.footer')
@endsection
@push('javascript')
@endpush
