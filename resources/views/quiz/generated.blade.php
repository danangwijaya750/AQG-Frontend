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
            <h2 class="section-title">Generate Soal</h2>
            <p class="section-lead">Isi form dibawah untuk membuat soal.</p>

            <div class="row-lg-12">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $quiz->title }}</h4>
                            <div class="card-header-action">
                              <a href="{{ route('quiz.create') }}" class="btn btn-primary">
                                Simpan Soal
                              </a>
                            </div>
                          </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 d-inline-flex">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-start">
                                            <img  src="{{ asset('img/level.svg') }}">
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
                                            <img  src="{{ asset('img/lesson.svg') }}">
                                            <div>
                                              <h6 class="mb-1 pl-3">Mata Pelajaran</h6>
                                              <p class="mb-1 pl-3">{{ $lesson->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-start">
                                            <img  src="{{ asset('img/kompetensi_inti.svg') }}">
                                            <div>
                                              <h6 class="mb-1 pl-3">Kompetensi Inti</h6>
                                              <p class="mb-1 pl-3">3. Pengetahuan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-start">
                                            <img  src="{{ asset('img/KD.svg') }}">
                                            <div>
                                              <h6 class="mb-1 pl-3">Kompetensi Dasar</h6>
                                              <p class="mb-1 pl-3">3.1 Menganalisis jaringan berbasis luas</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="col-md-12 mt-4">
                                    <label class="control-label">Kualitas Soal <i class="fas fa-info-circle    "></i></label>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">C1 (Mengingat)</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">C2 (Memahami)</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">C3 (Mengaplikasikan)</a>
                                        </li>
                                      </ul>
                                      <div class="col-md-8">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                             <ol>
                                                @foreach ($data as $key => $value)
                                                <li>
                                                    {{ $value['q'] }}
                                                </li>
                                             @endforeach
                                             </ol>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                              Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                                            </div>
                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                              Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
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
