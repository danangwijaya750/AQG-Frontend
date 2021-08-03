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
            <div class="row col-lg-12">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="col-md-12">
                                <h4>Form Isian</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group col-md-6">
                                    <label class="form-label">Tingkat Pendidikan</label>
                                    <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="1" class="selectgroup-input" checked="">
                                        <span class="selectgroup-button">SD</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="2" class="selectgroup-input">
                                        <span class="selectgroup-button">SMP</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="3" class="selectgroup-input">
                                        <span class="selectgroup-button">SMA</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="4" class="selectgroup-input">
                                        <span class="selectgroup-button">SMK</span>
                                    </label>
                                    </div>
                            </div>

                            <div class="form-row col-md-12">
                                <div class="form-group col-md-10">
                                    <label for="lesson">Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="lesson" placeholder="Pilih atau cari Mata Pelajaran">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="class">Kelas</label>
                                    <select id="class" class="form-control">
                                    <option selected="">Choose...</option>
                                    <option>...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row col-md-12">
                                <div class="form-group col-md-6">
                                    <label>Kompetensi Inti</label>
                                    <select class="form-control __web-inspector-hide-shortcut__">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kompetensi Dasar</label>
                                    <select class="form-control __web-inspector-hide-shortcut__">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        </select>
                                </div>
                            </div>

                            <div class="form-row col-md-12">
                                <div class="form-group col-md-5">
                                    <label for="">Jenis Pertanyaan</label>
                                    <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jenis_pertanyaan" value="1" class="selectgroup-input" checked="">
                                        <span class="selectgroup-button">Pilihan Ganda</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jenis_pertanyaan" value="2" class="selectgroup-input">
                                        <span class="selectgroup-button">Isian Singkat</span>
                                    </label>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-1">

                                    <label for="">Jumlah</label>
                                    <input style="height: calc(1.5em + .5rem + 6px);" type="number" class="form-control form-control-sm" placeholder="0">
                                    {{-- <input type="number" name="" id="" class="form-control" placeholder=""> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-icon icon-right btn-primary" type="submit">Generate Soal <i class="fas fa-book-open    "></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header container-fluid">
                                <div class="col-md-12">
                                    <div class="row">
                                        <h4>Generate Baru-baru ini</h4>
                                        <div class="card-header-action">
                                            <a href="{{ route('quiz.index') }}">
                                              Lihat Semua
                                            </a>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="quiz_table" class="table table-responsive table-bordered">
                                    <thead>
                                      <tr>
                                        <th scope="col" width="3%">No</th>
                                        <th scope="col">Judul Soal</th>
                                        <th scope="col">Dibuat Pada</th>
                                        <th scope="col"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($all as $quiz )
                                      <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $quiz->title }}</td>
                                        <td>{{ $quiz->created_at }}</td>
                                        <td><a href=""><i class="fas fa-arrow-right    "></i></a></td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>

                            </div>
                        </div>
                    </div>
            </div>

            <div class="row-lg-12">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="col-md-12">
                                <div class="row">
                                    <h4>Judul Soal</h4>

                                </div>
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
                                              <p class="mb-1 pl-3">SMK</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-start">
                                            <img  src="{{ asset('img/lesson.svg') }}">
                                            <div>
                                              <h6 class="mb-1 pl-3">Mata Pelajaran</h6>
                                              <p class="mb-1 pl-3">Matematika</p>
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
                                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                              Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                                            </div>
                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                              Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                                            </div>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="card">
                                              <div class="card-header">

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
@endsection
