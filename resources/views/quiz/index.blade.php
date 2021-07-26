@extends('layouts.app')

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
                            <div class="col-md-10">
                                <h4>Daftar Soal</h4>
                              </div>
                              <div class="col-md-2 float-right">
                                <button class="btn btn-primary" style="margin-left: 4em"
                          (click)="onAddCategoieModal(content)">Tambah Soal</button>
                               </div>

                          </div>
                        <div class="card-body">
                            <table id="quiz_table" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                  </tr>
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
