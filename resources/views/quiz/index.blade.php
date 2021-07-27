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
                        <div class="card-header container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Daftar Soal</h4>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="#" class="btn btn-md btn-icon icon-right btn-primary">Generate Soal <i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="quiz_table" class="table table-responsive table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" width="3%">No</th>
                                    <th scope="col">Judul Soal</th>
                                    <th scope="col">Tingkat Pendidikan</th>
                                    <th scope="col">Jumlah Soal</th>
                                    <th scope="col">Jenis Soal</th>
                                    <th scope="col">Dibuat Pada</th>
                                    <th scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($all as $quiz )
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $quiz->title }}</td>
                                    <td>{{ $quiz->level }}</td>
                                    <td>{{ $quiz->length }}</td>
                                    <td>
                                        @if ($quiz->type!=1)
                                        <span class="badge badge-dark">Isian Singkat</span>
                                        @else
                                        <span class="badge badge-primary">Pilihan Ganda</span>
                                        @endif
                                    <td>{{ $quiz->created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-md btn-icon icon-right btn-success">Export <i class="fas fa-file-export    "></i></a>
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
