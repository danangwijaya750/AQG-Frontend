@extends('layouts.app')
@section('title')
    Edit Materi
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Materi</h3>
        </div>
        <div class="section-body">
            <h2 class="section-title">Edit Materi</h2>
            <p class="section-lead">Sesuaikan data materi.</p>
            <div class="row col-lg-12">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="col-md-12">
                                <h4>Form Isian</h4>
                            </div>
                        </div>

                        <div class="card-body">
                        <form method="POST" action="{{ route('admin.study.update' ,['study' => $data['study']['id']]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group col-md-12">
                            <label for="lesson">Judul Materi</label>
                            <input type="text" class="form-control" name="title" placeholder="Isikan Judul Soal" value="{{ $data['study']['title'] }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label>Materi</label>
                                <textarea class="form-control summernote-simple" name="desc" placeholder="Masukkan Paragraf Materi" >{{ $data['study']['desc'] }}</textarea>
                              </div>

                            <div class="form-row col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Tingkat Pendidikan</label>
                                    <div class="selectgroup w-100">
                                        @foreach ($data['levels'] as $level)
                                        <label class="selectgroup-item">
                                            <input type="radio" id="level{{ $level['id'] }}" name="level_id" value="{{ $level['id'] }}" class="selectgroup-input" @if($data['study']['lesson']['level_id'] == $level['id'] ) checked @endif>
                                            <span class="selectgroup-button">{{ $level['title'] }}</span>
                                        </label>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lesson">Mata Pelajaran</label>
                                    <select id="lesson" name="lesson_id" class="form-control select2">
                                        <option value="{{ $data['study']['lesson']['id'] }}"selected>{{ $data['study']['lesson']['title'] }}</option>
                                        {{-- @foreach($data['lessons'] as $l)
                                        <option value="{{ $l->id }}">{{ $l->title }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label">Bagikan Materi ?</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" id="sharing" name="is_sharing" value="1" class="selectgroup-input" @if($data['study']['is_sharing'] == 1 ) checked @endif>
                                        <span class="selectgroup-button">Ya</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" id="sharing" name="is_sharing" value="0" class="selectgroup-input" @if($data['study']['is_sharing'] == 0 ) checked @endif>
                                        <span class="selectgroup-button">Tidak</span>
                                    </label>


                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button id="btn_generate" class="btn btn-icon icon-right btn-primary" type="submit">Simpan Materi <i class="fas fa-book-open    "></i></button>
                                <a href="{{ route('admin.study.index') }}" class="btn btn-outline-danger">Batal</a>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="card">
                            <div class="card-header container-fluid">
                                <div class="col-md-12">
                                    <div class="row">
                                        <h4>Materi Anda</h4>
                                        <div class="card-header-action">
                                            <a href="{{ route('admin.study.index') }}">
                                              Lihat Semua
                                            </a>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="quiz_table" class="table table-responsive table-bordered">
                                    <thead>
                                      <tr>
                                        <th scope="col" width="3%">No</th>
                                        <th scope="col">Judul Materi</th>
                                        <th scope="col">Dibuat Pada</th>
                                        <th scope="col"></th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($data['studies'] as $study )
                                      <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $study->title }}</td>
                                        <td>{{ Carbon\Carbon::parse($study->created_at)->diffForHumans() }}</td>
                                        <td><a href="{{ route('admin.study.edit', ['study' => $study->id]) }}"><i class="fas fa-arrow-right    "></i></a></td>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
      $('document').ready((e)=>{
        $('input[type=radio][name=level_id]').on('change', function (){
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
