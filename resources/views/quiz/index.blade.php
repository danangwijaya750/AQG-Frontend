@extends('layouts.app')
@section('title')
    Daftar Soal
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Soal</h3>
        </div>
        <div class="section-body">
            {{-- <h2 class="section-title">This is Example Page</h2> --}}
            {{-- <p class="section-lead">This page is just an example for you to create your own page.</p> --}}
            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  {{ session()->get('message') }}
                </div>
              </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Soal</h4>
                            <div class="card-header-action">
                              <a href="{{ route('quiz.create') }}" class="btn btn-primary">
                                Generate Soal
                              </a>
                            </div>
                          </div>
                            {{-- <div class="float-right">
                                <a href="#" class="btn btn-md btn-icon icon-right btn-primary">Generate Soal <i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div> --}}

                        <div class="card-body">
                            <table id="quiz_table" class="table table-responsive table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" width="3%">No</th>
                                    <th scope="col">Judul Soal</th>
                                    <th class="text-center" scope="col" width="15%" >Tingkat Pendidikan</th>
                                    {{-- <th class="text-center" scope="col" width="15%">Jumlah Soal</th> --}}
                                    <th class="text-center" scope="col">Jenis Soal</th>
                                    <th class="text-center" scope="col">Dibuat Pada</th>
                                    <th scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; ?>
                                @foreach ($all as $quiz )
                                  <tr>
                                    <td class="text-center" scope="row"> <?php echo $no++; ?></td>
                                    <td>{{ $quiz->title }}</td>
                                    <td class="text-center">
                                        @if($quiz->level_id == 1)
                                        SD
                                        @elseif($quiz->level_id == 2)
                                        SMP
                                        @elseif($quiz->level_id == 3)
                                        SMA
                                        @elseif($quiz->level_id == 4)
                                        SMK
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">{{ $quiz->length }}</td> --}}
                                    <td class="text-center">
                                        @if ($quiz->type!=1)
                                        <span class="badge badge-info">Isian Singkat</span>
                                        @else
                                        <span class="badge badge-primary">Pilihan Ganda</span>
                                        @endif
                                    <td class="text-center"> {{ $quiz->created_at }}</td>
                                    <td>

                                            <div class="dropdown d-inline mr-2">
                                                <button class="btn  btn-md btn-icon icon-right btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Export Soal <i class="fas fa-file-export"></i>
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                  <a class="dropdown-item" href="{{ route('quiz.pdf', $quiz->id) }}">PDF</a>
                                                  <a class="dropdown-item" href="{{ route('quiz.txt', $quiz->id) }}">Moodle (GIFT)</a>
                                                </div>
                                              </div>
                                            {{-- <a href="#" class="btn btn-md btn-icon icon-right btn-success">Export <i class="fas fa-file-export"></i></a> --}}
                                            <a href="{{ route('quiz.show', $quiz->id) }}" class="btn btn-md btn-icon icon-right btn-warning">Detail <i class="fa fa-eye" aria-hidden="true"></i></a>

                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#quiz_table').DataTable();
        } );
    </script>

@endsection
