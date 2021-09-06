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
                                    <th class="text-center" scope="col" width="15%">Jumlah Soal</th>
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
                                    <td class="text-center">{{ $quiz->length }}</td>
                                    <td class="text-center">
                                        @if ($quiz->type!=1)
                                        <span class="badge badge-info">Isian Singkat</span>
                                        @else
                                        <span class="badge badge-primary">Pilihan Ganda</span>
                                        @endif
                                    <td class="text-center"> {{ $quiz->created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-md btn-icon icon-right btn-success">Export <i class="fas fa-file-export"></i></a>
                                            <a href="#" class="btn btn-md btn-icon icon-right btn-warning">Detail <i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </div>
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
