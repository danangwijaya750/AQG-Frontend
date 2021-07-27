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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Form Isian</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Size</label>
                                <div class="selectgroup w-100">
                                  <label class="selectgroup-item">
                                    <input type="radio" name="value" value="50" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">SD</span>
                                  </label>
                                  <label class="selectgroup-item">
                                    <input type="radio" name="value" value="100" class="selectgroup-input">
                                    <span class="selectgroup-button">SMP</span>
                                  </label>
                                  <label class="selectgroup-item">
                                    <input type="radio" name="value" value="150" class="selectgroup-input">
                                    <span class="selectgroup-button">SMA</span>
                                  </label>
                                  <label class="selectgroup-item">
                                    <input type="radio" name="value" value="200" class="selectgroup-input">
                                    <span class="selectgroup-button">SMK</span>
                                  </label>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
