@extends('layouts.app')
@section('title')
    Buat Materi
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pengguna</h3>
        </div>
        <div class="section-body">
            <h2 class="section-title">Buat Pengguna</h2>
            <p class="section-lead">Isi form dibawah untuk membuat pengguna</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="col-md-12">
                                <h4>Form Isian</h4>
                            </div>
                        </div>

                        <div class="card-body">
                        <form method="POST" action="{{ route('admin.user.store') }}">
                            @csrf
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="lesson">Nama Pengguna</label>
                                    <input type="text" class="form-control" name="name" placeholder="Isikan Nama Pengguna">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="lesson">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Isikan Email Pengguna">
                                      </div>
                            </div>


                            <div class="form-row col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="level">Instansi</label>
                                    <input type="text" class="form-control" name="instance" placeholder="Masukkan Asal Instansi">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lesson">Profesi</label>
                                    <input type="text" class="form-control" name="profession" placeholder="Masukkan Profesi">
                                </div>
                            </div>

                            <div class="form-row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password
                                            :</label><span
                                                class="text-danger">*</span>
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                               placeholder="Atur password" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation"
                                               class="control-label">Konfirmasi Password:</label><span
                                                class="text-danger">*</span>
                                        <input id="password_confirmation" type="password" placeholder="Konfirmasi password"
                                               class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                               name="password_confirmation" tabindex="2">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password_confirmation') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label">Role Pengguna</label>
                                <div class="selectgroup w-100">

                                    <label class="selectgroup-item">
                                        <input type="radio" id="sharing" name="role_id" value="1" class="selectgroup-input">
                                        <span class="selectgroup-button">Superadmin</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" id="sharing" name="role_id" value="2" class="selectgroup-input">
                                        <span class="selectgroup-button">Pengguna Biasa</span>
                                    </label>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button id="btn_generate" class="btn btn-icon icon-right btn-primary" type="submit">Buat Pengguna <i class="fas fa-user"></i></button>
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
        $('input[type=radio][name=level]').on('change', function (){
                var levelId = $(this).val();
                if(levelId){
                    $.ajax({
                        url: '/filter/lesson/'+levelId,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data){
                            if(data){
                                $('#lesson').empty();
                                $('#lesson').append('<option disabled hidden>Pilih Mata Pelajaran</option>');
                                $.each(data, function(lesson,lesson){
                                    $('select[name="lesson_id"]').append('<option value="'+ lesson.id +'">' + lesson.title+ '</option>');
                                });
                            } else {
                                $('#lesson').empty();
                            }
                        }
                    });
                }
            });
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

        var $button = $("button");

        $($button).on("click", function(){
                $(this).addClass("btn-progress")
        })
      });


    </script>
@endsection
