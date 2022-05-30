@extends('layouts.app')
@section('title')
   Manajemen Pengguna
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pengguna</h3>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Pengguna</h4>
                            <div class="card-header-action">
                              <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                               Tambah Pengguna
                              </a>
                            </div>
                          </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col" width="3%">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th>Instansi</th>
                                    <th>Profesi</th>
                                    <th class="text-center"  scope="col">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($data['users'] as $user )
                                  <tr>
                                    <td class="text-center" scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>
                                    @if($user['role_id'] == 1 )
                                        <span class="badge badge-info">
                                            Superadmin
                                        </span>
                                    @else
                                    <span class="badge badge-success">
                                        Pengguna Biasa
                                    </span>
                                    @endif
                                       </td>
                                    <td>
                                    {{ $user['instance']  }}
                                    </td>
                                    {{-- <td class="text-center">{{ $study->length }}</td> --}}
                                    <td>
                                        {{ $user['profession']  }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.user.edit', ['user' => $user['id']]) }}">
                                                <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit Pengguna"><i class="fas fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('admin.user.destroy', ['user' => $user['id']]) }}" method="POST">
                                                @csrf
                                                @method('delete')

                                                <button  type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="" onClick="return confirm('Hapus data ?')" data-original-title="Hapus Pengguna"><i class="fas fa-trash"></i></button>
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
