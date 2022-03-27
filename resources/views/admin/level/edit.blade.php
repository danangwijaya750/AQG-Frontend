@extends('layouts.app')
@section('title')
    Buat Tingkat Pendidikan
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Manajemen Tingkat Pendidikan</h3>
        </div>
        <div class="section-body">
            <h2 class="section-title">Buat Tingkat Pendidikan</h2>
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
                        <form method="POST"  action="{{ route('admin.level.update', ['level'=>$data['level']['id']]) }}" enctype="multipart/form-data"">
                            @csrf
                            @method('put')
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Nama Tingkat Pendidikan</label>
                                    <input type="text" class="form-control" name="title" value="{{ $data['level']['title'] }}" placeholder="Isikan Nama Tingkat Pendidikan">
                                    </div>


                            </div>

                            <div class="card-footer text-right">
                                <button id="btn_generate" class="btn btn-icon icon-right btn-primary" type="submit">Simpan Tingkat Pendidikan <i class="fas fa-school"></i></button>
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

        function makeTableScroll() {
                // Constant retrieved from server-side via JSP
            var maxRows = 10;
            var table = document.getElementById('quiz_table');
            var wrapper = table.parentNode;
            var rowsInTable = table.rows.length;
            var height = 0;
            if (rowsInTable > maxRows) {
                for (var i = 0; i < maxRows; i++) {
                    height += table.rows[i].clientHeight;
                }
                wrapper.style.height = height + "px";
                }
            }

  

        $("#btn_generate").on("click", function(){
                $(this).addClass("btn-progress")
        })
      });


    </script>
@endsection
