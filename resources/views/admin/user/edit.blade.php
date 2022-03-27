@extends('layouts.app')
@section('title')
    Edit Pengguna
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pengguna</h3>
        </div>
        <div class="section-body">
            <h2 class="section-title">Edit Pengguna</h2>
            <p class="section-lead">Edit form dibawah</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="col-md-12">
                                <h4>{{ $data['user']['name'] }}</h4>
                            </div>
                        </div>

                        <div class="card-body">
                        <form method="POST" action="{{ route('admin.user.update', ['user'=>$data['user']['id']]) }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="lesson">Nama Pengguna</label>
                                    <input type="text" class="form-control" name="name" value="{{ $data['user']['name'] }}" placeholder="Isikan Nama Pengguna">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="lesson">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $data['user']['email'] }}" placeholder="Isikan Email Pengguna">
                                      </div>
                            </div>


                            <div class="form-row col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="level">Instansi</label>
                                    <input type="text" class="form-control" name="instance" value="{{ $data['user']['instance'] }}" placeholder="Masukkan Asal Instansi">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lesson">Profesi</label>
                                    <input type="text" class="form-control" name="profession" value="{{ $data['user']['profession'] }}"  placeholder="Masukkan Profesi">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="d-block">Password</label>
                                <button type="button" class="btn btn-warning btn-icon btn-md icon-left" id="changePassword"><i class="fas fa-edit mt-2"></i>Ubah Password</button>
                                <button type="button" style="display:none;" class="btn btn-outline-warning btn-icon btn-md icon-left" id="closeChangePassword"><i class="fas fa-times mt-2"></i>Batal</button>
                            </div>

                            <div class="form-row col-md-12" id="passwordForm" style="display:none;">
                                <div class="form-group col-md-6 ">
                                    <label for="password" class="d-block">Password Baru</label>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Masukkan Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm_password" class="d-block">Konfirmasi Password</label>
                                    <input class="form-control" type="password" aria-describedbytype="messagae" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password"/>
                                    <small id="message" class="form-text"></small>
                                </div>
                            </div>



                            <div class="form-group col-md-4">
                                <label class="form-label">Role Pengguna</label>
                                <div class="selectgroup w-100">

                                    <label class="selectgroup-item">
                                        <input type="radio" id="sharing" name="role_id" value="1" class="selectgroup-input" @if($data['user']['role_id'] == 1) checked @endif>
                                        <span class="selectgroup-button">Superadmin</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" id="sharing" name="role_id" value="2" class="selectgroup-input" @if($data['user']['role_id'] == 2) checked @endif>
                                        <span class="selectgroup-button">Pengguna Biasa</span>
                                    </label>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button id="btn_generate" class="btn btn-icon icon-right btn-primary" type="submit">Simpan Pengguna <i class="fas fa-user"></i></button>
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

            $('#password, #confirm_password').on('keyup', function() {
            if ($('#password').val() == $('#confirm_password').val()) {
                if ($('#password').val() != '') {
                    $('#message').html('Password sesuai').css('color', 'green');
                } else {
                    $('#message').hide();
                }

            } else
            if ($('#password').val() != '') {
                $('#message').html('Password tidak sesuai').css('color', 'red');
            } else {
                $('#message').hide();
            }

        });

        $('#changePassword').on('click', function() {
            $('#passwordForm').css("display", "");
            $('#closeChangePassword').css("display", "");
        });

        $('#closeChangePassword').on('click', function() {
            $('#passwordForm').css("display", "none");
            $('#password, #confirm_password').val('');
            $(this).hide();
        });;

        $('#btn_generate').on("click", function(){
                $(this).addClass("btn-progress")
        })
      });


    </script>
@endsection
