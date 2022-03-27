@extends('layouts.app')
@section('title')
    Edit Soal
@endsection

@section('content')
<style>
    .no-border {
        border: none !important;
        background-color: transparent !important;
        width: 100%;
    }
</style>
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Soal</h3>
        </div>
        <div class="section-body">
            <h2 class="section-title">Edit Soal</h2>
            <p class="section-lead">Seluruh soal dapat diedit sedinamis mungkin atau <a href="{{ route('admin.quiz.create') }}"> generate soal baru</a></p>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $data['quiz']['title'] }}</h4>
                          </div>
                        <div class="card-body">
                            <div class="row-lg-12">
                                <form action="{{ route('admin.quiz.update', ['quiz' => $data['quiz']['id']]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                <div class="form-group col-md-12">
                                    <label for="lesson">Judul Soal</label>
                                    <input type="text" class="form-control" name="title" placeholder="Isikan Judul Soal" value="{{ $data['quiz']['title']}}">
                                    </div>

                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Tingkat Pendidikan</label>
                                            <div class="selectgroup w-100">
                                                @foreach ($data['levels'] as $level)
                                                <label class="selectgroup-item">
                                                    <input type="radio" id="level{{ $level['id'] }}" name="level_id" value="{{ $level['id'] }}" class="selectgroup-input" @if($data['quiz']['lesson']['level_id'] == $level['id'] ) checked @endif>
                                                    <span class="selectgroup-button">{{ $level['title'] }}</span>
                                                </label>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lesson">Mata Pelajaran</label>
                                            <select id="lesson" name="lesson_id" class="form-control select2">
                                                <option value="{{ $data['quiz']['lesson']['id'] }}" selected>{{ $data['quiz']['lesson']['title'] }}</option>
                                                {{-- @foreach($data['lessons'] as $l)
                                                <option value="{{ $l->id }}">{{ $l->title }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Bagikan Soal ?</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="is_sharing" value="1" class="selectgroup-input" @if($data['quiz']['is_sharing'] == 1) checked @endif>
                                                <span class="selectgroup-button">Ya</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="is_sharing" value="0" class="selectgroup-input" @if($data['quiz']['is_sharing'] == 0) checked @endif>
                                                <span class="selectgroup-button">Tidak</span>
                                            </label>
                                        </div>
                                    </div>
                                <div class="col-md-12 mt-4">
                                    <label class="control-label">Klasifikasi Soal <i class="fas fa-info-circle   "></i></label>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        @foreach (json_decode($data['quiz']['questions'],true) as $key => $question)
                                            <li class="nav-item">
                                                <a class="nav-link @if($loop->first) active show @endif" id="{{ $question['c'] }}-tab" data-toggle="tab" href="#{{ $question['c'] }}" role="tab" aria-controls="{{ $question['c'] }}" aria-selected="true">{{ $question['name'] }}</a>
                                                <input type="hidden" name="questions[{{ $key }}][name]" value="{{ $question['name'] }}">
                                            </li>
                                        @endforeach

                                      </ul>
                                      <div class="col-md-12">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="input-group mt-4 mb-2">
                                                <input type="text" class="form-control" id="soal" placeholder="Masukkan soal" aria-label="">

                                                <div class="input-group-append">
                                                  <button class="btn btn-primary" id="add-row" type="button">Tambah Soal</button>
                                                </div>
                                              </div>
                                              {{-- {{ dd($data['quiz']) }} --}}
                                            @foreach (json_decode($data['quiz']['questions'],true) as $key => $question)
                                            <input type="hidden" name="questions[{{ $key }}][c]" value="{{ $question['c'] }}">
                                            <div class="tab-pane fade @if($loop->first) active show @endif" id="{{ $question['c'] }}" role="tabpanel" aria-labelledby="{{ $question['c'] }}-tab">
                                                    <table class="table table-striped" id="question_table">
                                                      <tbody><tr>
                                                        <th width="40%">Soal</th>

                                                        <th width="10%">Aksi</th>
                                                      </tr>
                                                    {{-- {{ dd($question['q']) }} --}}
                                                      @foreach ( $question['q'] as $question_key => $q )
                                                      <tr id="question-{{ $key }}-{{ $question_key }}">
                                                        <td>
                                                            <input class="no-border" type="text" name="questions[{{ $key }}][q][{{ $question_key }}]" value="{{ $q }}">
                                                        </td>

                                                        <td><a onclick="deleteRow({{ $key }},{{ $question_key }})" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                                      </tr>
                                                        @endforeach
                                            </tbody></table>

                                            </div>
                                            @endforeach
                                            <small style="font-size:14px;color:red;">*Klik pada baris untuk edit soal</small>
                                          </div>
                                      </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" id="save_btn" class="btn btn-primary btn-icon icon-right">
                                Update Soal <i class="fas fa-save"></i>
                              </button>
                            </form>
                              <a href="{{ route('admin.quiz.index') }}" class="btn btn-outline-danger">Batal</a>
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
        $('#add-row').click(function(){
            console.log('duar');
            var soal = $('#soal').val();

            var markup = '<tr id="question-{{ $key }}-{{ $question_key }}"> <td> <input class="no-border" type="text" name="questions[{{ $key }}][q][{{ $question_key }}]" value="'+ soal+'"> </td> <td><a onclick="deleteRow({{ $key }},{{ $question_key }})" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td> </tr>';
            $(".tab-pane.active table tbody").append(markup);
            $('#soal').val('');

        });

        $('.tab-pane fade active tr').each(function(index, tr) {
            $(tr).find('td:nth-child(2').each (function (index, td) {
                console.log(td)
            });
        });


        $('#save_btn').on("click", function(){
                $(this).addClass("btn-progress")
        });

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
                                console.log(data);
                                $('#lesson').empty();
                                $('#lesson').append('<option disabled hidden>Pilih Mata Pelajaran</option>');
                                $.each(data, function(lesson,lesson){
                                    $('select[name="lesson_id"]').append('<option value="'+ lesson.id +'">' + lesson.title+ '</option>');
                                });

                                $('#lesson_name').val(data.title);
                            } else {
                                $('#lesson').empty();
                            }
                        }
                    });
                }
            });

       });

       function deleteRow(key, questionKey){
            console.log(key,questionKey);
            $(`#question-${key}-${questionKey}`).remove();
            $(this).closest("tr").remove();
        }
    </script>
@endsection
