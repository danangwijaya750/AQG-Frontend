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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Soal</h4>
                            <div class="card-header-action">
                              <a href="{{ route('quiz.create') }}" class="btn btn-primary btn-icon icon-right">
                                Generate Soal <i class="fas fa-coffee"></i>
                              </a>
                            </div>
                          </div>
                        <div class="card-body">
                            <table id="quiz_table" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col" width="3%">No</th>
                                    <th scope="col">Judul Soal</th>
                                    <th class="text-center" scope="col" width="15%" >Tingkat Pendidikan</th>
                                    {{-- <th class="text-center" scope="col" width="15%">Jumlah Soal</th> --}}
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Dibuat Pada</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($data['quizzes'] as $quiz )
                                  <tr>
                                    <td class="text-center" scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $quiz->title }}</td>
                                    <td class="text-center">
                                    {{ $quiz->lesson->level->title }}
                                    </td>
                                    {{-- <td class="text-center">{{ $quiz->length }}</td> --}}
                                    <td class="text-center">
                                    @if ($quiz->is_sharing != 1)
                                        <span class="badge badge-success">Private</span>
                                    @else
                                        <span class="badge badge-primary">Public</span>
                                    @endif
                                    </td>
                                    <td class="text-center"> {{ $quiz->created_at }}</td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown" class="btn btn-sm btn-primary dropdown-toggle" aria-expanded="false"><i class="fas fa-download ml-2"></i></a>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 26px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                  <a href="{{ route('quiz.pdf', ['id' => $quiz['id']]) }}" class="dropdown-item has-icon"><i class="fas fa-file-pdf"></i>PDF</a>
                                                  {{-- <a href="{{ route('quiz.word', ['id' => $quiz['id']]) }}" class="dropdown-item has-icon"><i class="fas fa-file-word"></i> Word</a>
                                                  <a href="#" class="dropdown-item has-icon"><i class="fas fa-sticky-note"></i>GIFT (Moodle)</a> --}}

                                                </div>
                                              </div>
                                            <a href="{{ route('quiz.edit', ['quiz' => $quiz['id']]) }}">
                                                <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Soal"><i class="fas fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('quiz.destroy', ['quiz' => $quiz['id']]) }}" method="POST">
                                                @csrf
                                                @method('delete')

                                                <button  type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" onClick="return confirm('Hapus data ?')" data-original-title="Hapus Soal"><i class="fas fa-trash"></i></button>
                                              </form>
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
