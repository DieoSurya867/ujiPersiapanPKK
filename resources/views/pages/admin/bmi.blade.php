@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / </span>Perhitungan BMI</h4>

        <!-- Form controls -->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">


                    <h5 class="card-header">Perhitungan Bmi</h5>
                    <div class="card-body">
                        <form action="{{ route('dashboard.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="namaOrang">Name</label>
                                <input class="form-control" id="namaOrang" type="text">
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="tinggi">Tinggi <em>in cm</em> </label>
                                    <input class="form-control" id="tinggi" type="number">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="berat">Berat <em>in kg</em> </label>
                                    <input class="form-control" id="berat" type="number">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-flex justify-content-between" for="hobby">
                                    <div>Hobbies</div>
                                    <div><em class="justify-content-end">jika lebih dari satu pisahkan dengan koma (,)</em>
                                    </div>
                                </label>
                                <input class="form-control" id="hobbies" type="text">
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="yob">Year of Birth</label>
                                    {{-- <input class="form-control" id="yob" type="number" min="1950"> --}}
                                    <select class="form-control" id="yob" name="yob"></select>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <button class="btn btn-success" id="checkBmi" type="button">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Hasil Perhitungan</h5>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">

                                    <form action="{{ route('dashboard.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nama Orang</label>
                                            <input type="text" class="form-control" name="namaOrang">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Berat Badan</label>
                                            <input type="number" class="form-control" name="berat">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tinggi Badan</label>
                                            <input type="number" class="form-control" name="tinggi">
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label class="form-label">Hobi 1</label>
                                                <input type="text" class="form-control" name="hobi1">
                                            </div>
                                            <div class="col mb-3">
                                                <label class="form-label">Hobi 2</label>
                                                <input type="text" class="form-control" name="hobi2">
                                            </div>
                                            <div class="col mb-3">
                                                <label class="form-label">Hobi 3</label>
                                                <input type="text" class="form-control" name="hobi3">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="lahir">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>

                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama</th>
                                                <th scope="col">BMI</th>
                                                <th scope="col">Kondisi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @isset($data)
                                                    <td>{{ $data['namaOrang'] }}</td>
                                                    <td>{{ $data['bmi'] }}</td>
                                                    <td>{{ $data['obes'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $data['lahir'] }} Tahun</td>

                                                </tr>
                                                <tr>
                                                    <td>{{ $data['kupon'] }} </td>
                                                @endisset
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
