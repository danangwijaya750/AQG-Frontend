@extends('layouts.app')
@section('title')
    Generate Soal
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Soal</h3>
        </div>
        <div class="section-body">
            <h2 class="section-title">Generate Soal</h2>
            <p class="section-lead">Isi form dibawah untuk membuat soal.</p>
            <div class="row col-lg-12">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="col-md-12">
                                <h4>Form Isian</h4>
                            </div>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('quiz.store') }}">
                                @csrf

                                <div class="form-group col-md-12">
                                <label for="lesson">Judul Soal</label>
                                <input type="text" class="form-control" name="title" placeholder="Isikan Judul Soal">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Materi</label>
                                <textarea class="form-control" placeholder="Masukkan Paragraf Materi" style="margin-top: 0px; margin-bottom: 0px; height: 122px;"></textarea>
                              </div>
                            <div class="form-group col-md-6">
                                    <label class="form-label">Tingkat Pendidikan</label>
                                    <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="level" value="1" class="selectgroup-input">
                                        <span class="selectgroup-button">SD</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="level" value="2" class="selectgroup-input">
                                        <span class="selectgroup-button">SMP</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="level" value="3" class="selectgroup-input">
                                        <span class="selectgroup-button">SMA</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="level" value="4" class="selectgroup-input">
                                        <span class="selectgroup-button">SMK</span>
                                    </label>
                                    </div>
                            </div>

                            <div class="form-row col-md-12">
                                <div class="form-group col-md-10">
                                    <label for="select2-lesson">Mata Pelajaran</label>
                                    <select id="select2-lesson" name="lesson" class="form-control">
                                        <option disabled selected>Pilih Mata Pelajaran</option>
                                        @foreach($lessons as $l)
                                        <option value="{{ $l->id }}">{{ $l->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="class">Kelas</label>
                                    <select id="" name="class" class="form-control">
                                    <option disabled selected>Pilih Kelas</option>
                                    @foreach ($class as $c)
                                    <option value="{{ $c->id }}">{{ $c->class }} - {{ $c->title }}</option>

                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-5">
                                    <label for="">Jenis Pertanyaan</label>
                                    <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="type" value="2" class="selectgroup-input">
                                        <span class="selectgroup-button">Isian Singkat</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="type" value="1" class="selectgroup-input">
                                        <span class="selectgroup-button">Pilihan Ganda</span>
                                    </label>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-1">

                                    <label for="">Jumlah</label>
                                    <input style="height: calc(1.5em + .5rem + 6px);" type="number" name="length" class="form-control form-control-sm" placeholder="0">
                                    {{-- <input type="number" name="" id="" class="form-control" placeholder=""> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-icon icon-right btn-primary" type="submit">Generate Soal <i class="fas fa-book-open    "></i></button>
                            </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header container-fluid">
                                <div class="col-md-12">
                                    <div class="row">
                                        <h4>Generate Baru-baru ini</h4>
                                        <div class="card-header-action">
                                            <a href="{{ route('quiz.index') }}">
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
                                        <th scope="col">Judul Soal</th>
                                        <th scope="col">Dibuat Pada</th>
                                        <th scope="col"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no=1; ?>
                                    @foreach ($all as $quiz )
                                      <tr>
                                        <td scope="row"><?php echo $no++; ?></td>
                                        <td>{{ $quiz->title }}</td>
                                        <td>{{ $quiz->created_at }}</td>
                                        <td><a href=""><i class="fas fa-arrow-right    "></i></a></td>
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
        $('.select2-lesson').select2({
        placeholder: "Pilih atau cari Mata Pelajaran",
        allowClear: false,
        ajax: {
            url: '/quiz/lessons-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
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
        }
    </script>
@endsection
