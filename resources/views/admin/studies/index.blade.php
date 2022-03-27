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
                              <a href="{{ route('admin.study.create') }}" class="btn btn-primary btn-icon icon-right">
                               Buat Materi <i class="fas fa-lightbulb"></i>
                              </a>
                            </div>
                          </div>


                        <div class="card-body">
                            <table id="datatable" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col" width="3%">No</th>
                                    <th scope="col">Judul Materi</th>
                                    <th scope="col">Isi Materi</th>
                                    <th class="text-center" scope="col" width="15%" >Tingkat Pendidikan</th>
                                    {{-- <th class="text-center" scope="col" width="15%">Jumlah Soal</th> --}}
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Dibuat Oleh</th>
                                    <th class="text-center" scope="col">Dibuat Pada</th>
                                    <th scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($data['studies'] as $study )
                                  <tr>
                                    <td class="text-center" scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $study->title }}</td>
                                    <td>{{ Str::limit(strip_tags($study->desc), 50) }}</td>
                                    <td class="text-center">
                                    {{ $study->lesson->level->title }}
                                    </td>
                                    {{-- <td class="text-center">{{ $study->length }}</td> --}}
                                    <td class="text-center">
                                    @if ($study->is_sharing != 1)
                                        <span class="badge badge-success">Private</span>
                                    @else
                                    <span class="badge badge-primary">Public</span>
                                    @endif
                                    </td>
                                    <td class="text-center"> {{ $study->user->name }}</td>
                                    <td class="text-center"> {{ $study->created_at }}</td>
                                    <td class="text-center">

                                        <div class="btn-group">
                                            <a href="{{ route('admin.study.edit', ['study' => $study['id']]) }}">

                                                <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Materi"><i class="fas fa-pencil-alt"></i></button>

                                            </a>
                                            <form action="{{ route('admin.study.destroy', ['study' => $study['id']]) }}" method="POST">
                                                @csrf
                                                @method('delete')

                                                <button  type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" onClick="return confirm('Hapus data ?')" data-original-title="Hapus Materi"><i class="fas fa-trash"></i></button>
                                              </form>

                                        </div>

                                    </td>
                                    {{-- <td>

                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn  btn-md btn-icon icon-right btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Export Soal <i class="fas fa-file-export"></i>
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('quiz.pdf', $study->id) }}">PDF</>
                                            <a class="dropdown-item" href="{{ route('quiz.txt', $study->id) }}">Moodle (GIFT)</a>
                                        </div>
                                        </div>

                                    <a href="{{ route('admin.study.show', $study->id) }}" class="btn btn-md btn-icon icon-right btn-warning">Detail <i class="fa fa-eye" aria-hidden="true"></i></a>

                                    </td> --}}
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
            $('#datatable').DataTable();
        } );
    </script>

@endsection
