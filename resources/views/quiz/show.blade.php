@extends('layouts.app')
@section('title')
Generate Soal
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Soal</h3>
    </div>
    <div class="section-body">
        <h2 class="section-title">Detail Soal</h2>
        <p class="section-lead">Halamn ini berisi detail soal yang telah disimpan.</p>

            <div class="card">
                    <div class="card-header">
                        <h4>{{ $quiz->title }}</h4>
                        <div class="card-header-action">
                            <button type="submit" class="btn btn-primary">
                                Edit Soal
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row-lg-12">
                            <div class="col-md-12 d-inline-flex">
                                <div class="col-md-3">
                                    <div class="d-flex align-items-start">
                                        <img src="{{ asset('img/level.svg') }}">
                                        <div>
                                            <h6 class="mb-1 pl-3">Tingkat Pendidikan</h6>
                                            <p class="mb-1 pl-3">@if($quiz->level_id == 1)
                                                SD
                                                @elseif($quiz->level_id == 2)
                                                SMP
                                                @elseif($quiz->level_id == 3)
                                                SMA
                                                @elseif($quiz->level_id == 4)
                                                SMK
                                                @endif</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex align-items-start">
                                        <img src="{{ asset('img/lesson.svg') }}">
                                        <div>
                                            <h6 class="mb-1 pl-3">Mata Pelajaran</h6>
                                            <p class="mb-1 pl-3">{{ $lesson->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-lg-12">


                                <div class="col-md-12 mt-4">
                                    <label class="control-label">Kualitas Soal <i class="fas fa-info-circle    "></i></label>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                                aria-controls="home" aria-selected="true">C1 (Mengingat)</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                                aria-controls="profile" aria-selected="false">C2 (Memahami)</a>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-10 mt-4">
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                        @if ($quiz->type === 1)
                                                        Pilihan Ganda
                                                        @elseif($quiz->type === 2)
                                                        Isian Singkat
                                                        @endif
                                                        <br>
                                                        <ol>
                                                            @foreach ($question as $d)
                                                            <li>
                                                                {{ $d->question }}
                                                            </li>
                                                            @endforeach
                                                        </ol>
                                                    </div>
                                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                        @if ($quiz->type === 1)
                                                        Pilihan Ganda
                                                        @elseif($quiz->type === 2)
                                                        Isian Singkat
                                                        @endif
                                                        <br>
                                                        <ol>
                                                            @foreach ($question as $d)
                                                            <li>
                                                                {{ $d->question }}
                                                            </li>
                                                            @endforeach
                                                        </ol>
                                                    </div>

                                                </div>
                                        </div>
                                        <div class="col-md-2 mt-16">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Ekspor Soal</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mt-2">
                                                        <a href="{{ route('quiz.pdf', $quiz->id) }}" class="btn btn-lg btn-block btn-icon icon-right btn-primary">PDF <i class="far fa-edit"></i></a>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <a href="{{ route('quiz.txt', $quiz->id) }}" class="btn btn-lg btn-block btn-icon icon-right btn-primary">Moodle (GIFT) <i class="far fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            </div>

                        </div>
                    </div>
            </div>



    </div>


</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $('.select2-lesson').select2({
        placeholder: "Pilih atau cari Mata Pelajaran",
        allowClear: false,
        ajax: {
            url: '/quiz/lessons-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

</script>
@endsection