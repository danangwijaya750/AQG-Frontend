@extends('layouts.app')
@section('title')
    Tambah Tingkat Pendidikan
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Manajemen Tingkat Pendidikan</h3>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tambah Tingkat Pendidikan</h2>
            <p class="section-lead">Isi form dibawah untuk membuat Tingkat Pendidikan</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="col-md-12">
                                <h4>Form Isian</h4>
                            </div>
                        </div>

                        <div class="card-body">
                        <form method="POST" action="{{ route('admin.level.store') }}">
                            @csrf
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-12">
                                    <label for="title">Nama Tingkat Pendidikan</label>
                                    <input type="text" class="form-control" name="title" placeholder="Isikan Nama Tingkat Pendidikan">
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('admin.level.index') }}" class="btn btn-outline-danger">Batal</a>
                                <button id="btn_generate" class="btn btn-icon icon-right btn-primary" type="submit">Tambah Tingkat Pendidikan <i class="fas fa-school"></i></button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>

            </div>


        </div>

    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
      $('document').ready((e)=>{

        var $button = $("button");

        $($button).on("click", function(){
                $(this).addClass("btn-progress")
        })
      });


    </script>
@endsection
