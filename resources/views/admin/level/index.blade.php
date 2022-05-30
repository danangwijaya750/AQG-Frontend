@extends('layouts.app')
@section('title')
   Manajemen Tingkat Pendidikan
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Tingkat Pendidikan</h3>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Tingkat Pendidikan</h4>
                            <div class="card-header-action">
                              <a href="{{ route('admin.level.create') }}" class="btn btn-primary">
                               Tambah Tingkat Pendidikan
                              </a>
                            </div>
                          </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col" width="3%">No</th>
                                    <th scope="col">Nama Tingkat Pendidikan</th>
                                    <th class="text-center"  scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($data['levels'] as $level )
                                  <tr>
                                    <td class="text-center" scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $level['title'] }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.level.edit', ['level' => $level['id']]) }}">
                                                <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Tingkat Pendidikan"><i class="fas fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('admin.level.destroy', ['level' => $level['id']]) }}" method="POST">
                                                @csrf
                                                @method('delete')

                                                <button  type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" onClick="return confirm('Hapus data ?')" data-original-title="Hapus Tingkat Pendidikan"><i class="fas fa-trash"></i></button>
                                              </form>


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
