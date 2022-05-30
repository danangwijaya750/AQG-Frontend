@extends('layouts.app')
@section('title')
    Tambah Mata Pelajaran
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Manajemen Mata Pelajaran</h3>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tambah Mata Pelajaran</h2>
            <p class="section-lead">Isi form dibawah untuk membuat Mata Pelajaran</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="col-md-12">
                                <h4>Form Isian</h4>
                            </div>
                        </div>

                        <div class="card-body">
                        <form method="POST"  action="{{ route('admin.lesson.update', ['lesson'=>$data['lesson']['id']]) }}" enctype="multipart/form-data"">
                            @csrf
                            @method('put')
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control" name="title" value="{{ $data['lesson']['title'] }}" placeholder="Isikan Nama Mata Pelajaran">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="level">Mata Pelajaran</label>
                                        <select id="level" name="level_id" class="form-control select2">

                                            @foreach($data['levels'] as $l)
                                            <option value="{{ $l->id }}"@if($data['lesson']['level_id' == $l->id])selected @endif>{{ $l->title }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                            </div>


                            <div class="card-footer text-right">
                                <button id="btn_generate" class="btn btn-icon icon-right btn-primary" type="submit">Simpan Mata Pelajaran <i class="fas fa-graduation-cap"></i></button>
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
