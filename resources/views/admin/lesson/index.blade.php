@extends('layouts.app')
@section('title')
   Manajemen Mata Pelajaran
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Mata Pelajaran</h3>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Mata Pelajaran</h4>
                            <div class="card-header-action">
                              <a href="{{ route('admin.lesson.create') }}" class="btn btn-primary">
                               Tambah Mata Pelajaran
                              </a>
                            </div>
                          </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col" width="3%">No</th>
                                    <th scope="col">Nama Mata Pelajaran</th>
                                    <th scope="col">Tingkat Pendidikan</th>
                                    <th class="text-center"  scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($data['lessons'] as $lesson )
                                  <tr>
                                    <td class="text-center" scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $lesson['title'] }}</td>
                                    <td><span class="badge badge-primary"> {{ $lesson['level']['title'] }}</span>
                                       </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.lesson.edit', ['lesson' => $lesson['id']]) }}">
                                                <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Mata Pelajaran"><i class="fas fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('admin.lesson.destroy', ['lesson' => $lesson['id']]) }}" method="POST">
                                                @csrf
                                                @method('delete')

                                                <button  type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" onClick="return confirm('Hapus data ?')" data-original-title="Hapus Mata Pelajaran"><i class="fas fa-trash"></i></button>
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
            $('#datatable').DataTable();
        } );
    </script>

@endsection
