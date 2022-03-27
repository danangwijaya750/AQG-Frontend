@extends('layouts.app')
@section('title')
    Generated Soal
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
            <h2 class="section-title">Generated Soal</h2>
            <p class="section-lead">Seluruh soal hasil generate dapat diedit sedinamis mungkin.</p>

            <div class="row-lg-12">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $data['quiz']['data']['title'] }}</h4>
                          </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 d-inline-flex">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-start">
                                            <img  src="{{ asset('img/level.svg') }}">
                                            <div>
                                              <h6 class="mb-1 pl-3">Tingkat Pendidikan</h6>
                                              <p class="mb-1 pl-3">{{ $data['quiz']['data']['level_name'] }}</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-start">
                                            <img  src="{{ asset('img/lesson.svg') }}">
                                            <div>
                                              <h6 class="mb-1 pl-3">Mata Pelajaran</h6>
                                              <p class="mb-1 pl-3">{{ $data['quiz']['data']['lesson_name'] }}</p>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                                <form action="{{ route('admin.quiz.save', ['id' => $data['quiz']['data']['user_id'], 'hash' => $data['quiz']['data']['hash']]) }}" method="post">
                                <input type="hidden" name="user_id" value="{{ $data['quiz']['data']['user_id'] }}">
                                <input type="hidden" name="title" value="{{ $data['quiz']['data']['title']}}">
                                <input type="hidden" name="is_sharing" value="{{ $data['quiz']['data']['is_sharing']}}">
                                <input type="hidden" name="lesson_id" value="{{ $data['quiz']['data']['lesson_id'] }}">
                                    @csrf
                                <div class="col-md-12 mt-4">
                                    <label class="control-label">Klasifikasi Soal <i class="fas fa-info-circle   "></i></label>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($data['quiz']['questions'] as $key => $question)
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
                                                <input type="text" class="form-control" id="answer" placeholder="Masukkan jawaban" aria-label="">
                                                <div class="input-group-append">
                                                  <button class="btn btn-primary" id="add-row" type="button">Tambah Soal</button>
                                                </div>
                                              </div>
                                              {{-- {{ dd($data['quiz']) }} --}}
                                            @foreach ($data['quiz']['questions'] as $key => $question)
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
                                            <small style="font-size:14px;color:red;">*Soal dapat diedit dengan klik pada bari</small>
                                          </div>
                                      </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" id="save_btn" class="btn btn-primary btn-icon icon-right">
                                Simpan Soal <i class="fas fa-save"></i>
                              </button>
                            </form>
                            <a href="{{ route('admin.quiz.create') }}" class="btn btn-outline-danger">Batal</a>
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

       });

       function deleteRow(key, questionKey){
            console.log(key,questionKey);
            $(`#question-${key}-${questionKey}`).remove();
            $(this).closest("tr").remove();
        }
    </script>
@endsection
