@extends('layouts.auth_app')
@section('title')
    Buat Akun
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header"><h4>Buat Akun</h4></div>

        <div class="card-body pt-1">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="first_name">Nama Lengkap:</label><span
                                    class="text-danger">*</span>
                            <input id="firstName" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name"
                                   tabindex="1" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}"
                                   autofocus required>
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label for="instane">Asal instansi:</label><span
                                    class="text-danger">*</span>
                            <input id="instane" type="text"
                                   class="form-control{{ $errors->has('instance') ? ' is-invalid' : '' }}"
                                   placeholder="Masukkan Instansi" name="instance" tabindex="1"
                                   value="{{ old('instance') }}"
                                   required autofocus>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="instane">Profesi:</label><span
                                    class="text-danger">*</span>
                            <input id="profession" type="text"
                                   class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}"
                                   placeholder="Masukkan Profesi" name="profession" tabindex="1"
                                   value="{{ old('profession') }}"
                                   required autofocus>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email:</label><span
                                    class="text-danger">*</span>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="Masukkan Email" name="email" tabindex="1"
                                   value="{{ old('email') }}"
                                   required autofocus>
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                    </div>
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
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                              Buat Akun
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Sudah punya akun ? <a
                href="{{ route('login') }}">Masuk</a>
    </div>
@endsection
