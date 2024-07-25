@extends('layouts.manager')

@section('link_style')
<link href="{{ asset('css/unggah/progress_bar.css') }}" rel="stylesheet">
@endsection

@section('style')
<style>
    .main {
        background-color: #F1F1F1;
    }

    .cardbox:nth-child(3) .card {
        background-color: #a50000;
    }

    .cardbox:nth-child(3) .material-symbols-outlined {
        color: white;
    }

    .cardbox h5 {
        font-size: 30px;
    }

    .cardbox p {
        font-size: 20px;
        color: #D4D4D4;
    }

    .cardbox:nth-child(3) h5 {
        color: white;
    }

    .cardbox:nth-child(3) p {
        color: #D8A4A4;
    }


    .card-body {
        display: flex;
        align-items: center;
        /* Align items vertically in the center */
        justify-content: space-between;
        /* Distribute space between items */
    }

    .card-text {
        margin-right: 10px;
        /* Adjust spacing between text and icon as needed */
    }

    .card-text {
        margin-right: 10px;
        /* Adjust spacing between text and icon as needed */
    }

    .card-icon {
        /* Optional: styles for the card icon */
    }

    .reportBox {
        display: flex;
        align-items: center;
        /* Align items vertically in the center */
        justify-content: space-between;
    }

    .report {
        background-color: white;
    }

    .table-header {
        display: flex;
        border-bottom: 3px solid #EDEDED;
        /* background-color: #a50000; */
        align-items: center;
        /* margin-bottom: 3px; */
    }

    .table-title {
        width: 50%;
    }


    .table-button {
        width: 50%;
        display: flex;
        justify-content: end;
    }

    .table-title h5 {
        font-weight: bold;
        font-size: 24px;
    }

    .button-seeAll {
        border-radius: 20px;
        border-width: 0px;
        background-color: #a50000;
        width: 92px;
        height: 43px;
        color: white;
        font-size: 16px;
        font-weight: bold;
    }

    .report-table {
        width: 100%;
    }

    .report-table th {
        border-bottom: 3px solid #EDEDED;
        text-align: center;
    }

    .report-table td {
        border-bottom: 1px solid #EDEDED;
        text-align: center;
    }
</style>

<style>
    .semua:hover a {
        border-color: white;
        border-width: 0.5px;
        border-style: ridge;
        transition: .2s;
    }

    .bottom-button {
        background-color: #A50000;
        color: white;
    }

    .bottom-button:hover {
        border-color: #A50000;
        background-color: white;
        border-width: 1.5px;
        border-style: ridge;
        transition: .2s;
    }
</style>
@endsection

@section('title')
Unggah Kasus
@endsection

@section('content')
<div class="container-fluid">
    <div class="row" style="background-color: #EDEDED;">
        <!-- 1 -->
        <div class="row pt-3 px-5">
            <div class="col-lg-2">
                <span class="back-icon" onclick="goBack()">
                    <span class="material-symbols-outlined" style="scale: 120%;">arrow_back</span>
                </span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="container">
                    <div class="step-progress">
                        <div class="step done"></div>
                        <div class="step done"></div>
                        <div class="step done"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2 -->
        <div class="row justify-content-center mt-4">
            <input type="text" class="reports" name="reports">
            <div class="col-lg-10 rounded p-1 justify-content-center"
                style="background-color: white; height: 35rem; width: 82vw;">
                <div class="container-fluid">
                    <form action="{{route('manager.hot_topic_posted')}}" method="POST" id="submit">
                        @csrf
                        <div class="row">
                            <div class="col-lg-10 rounded p-5" style="background-color: white;  width: 82vw;"
                                id="form-data-container">
                                <div class="row text-center mb-5">
                                    <h3 style="">Ringkasan Kasus</h3>
                                    <hr style="color: #A50000; opacity: 100; width: 25rem; margin-left: 31rem;">
                                </div>
                                <div class="row mb-4" style="margin-top: 5rem;">
                                    <input for="" class="form-control-plaintext title" name="title"
                                        style="font-weight: bold; font-size: x-large; margin-left: 0.7rem"></input>
                                    <input class="form-control-plaintext damage_type" name="damage_type"
                                        style="font-size: medium; color: #A50000; margin-top: -0.8rem; margin-left: 0.7rem"></input>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-2">
                                        <h5 for="" class="" style="font-size: large; font-weight: 400;">Lokasi &nbsp:
                                        </h5>
                                    </div>
                                    <div class="col-lg-10">
                                        <input for="" class="form-control-plaintext address" name="address"
                                            style="font-weight: medium; font-size: large; margin-left: -10rem; margin-top: -0.6rem"></input>
                                        <input for="" class="form-control-plaintext kelurahan" name="kelurahan"
                                            style="font-weight: medium; font-size: large; margin-left: -10rem; margin-top: -0.6rem"></input>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <button class="rounded-pill"
                                                style="background-color: #D8A4A4; border: none;">Baru
                                                Dilaporkan</button>
                                        </div>
                                        <div class="col-lg-2">
                                            <h5
                                                style="color: #A50000; font-size: large; margin-top: 0.12rem; margin-left: -7rem">
                                                150
                                                Laporan</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-d-flex text-justify " style="width:85rem">
                                    <textarea for="" class="form-control-plaintext description" name="description"
                                        style="font-weight: medium; font-size: large; margin-left: 0.7rem; white-space: normal; height: 10rem;"></textarea>
                                </div>
                                <div class=" row">
                                    <!-- gambar gmn gatau -->
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end mt-4" style="margin-right: -11rem">
                            <div class="col-lg-2">
                                <div class="button">
                                    <button type="submit" class="btn btn-lg rounded bottom-button">Unggah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
</div>
@endsection

@section('script')
<script>
    function goBack() {
        window.history.back();
    }

    function collectReportData() {
        let inputHotTopic = JSON.parse(localStorage.getItem('input_hot_topic'));
        if (inputHotTopic) {
            if (inputHotTopic.title) {
                document.querySelector(".title").value = inputHotTopic.title;
            }
            if (inputHotTopic.damage_type) {
                document.querySelector(".damage_type").value = inputHotTopic.damage_type;
            }
            if (inputHotTopic.address) {
                document.querySelector(".address").value = inputHotTopic.address;
            }
            if (inputHotTopic.kelurahan) {
                document.querySelector(".kelurahan").value = inputHotTopic.kelurahan;
            }
            if (inputHotTopic.description) {
                document.querySelector(".description").value = inputHotTopic.description;
            }
        }

        const reportselect = localStorage.getItem('report_is_checked');
            $(".reports").val(reportselect);

    }



    document.addEventListener('DOMContentLoaded', function() {
        collectReportData();

    });
</script>
@endsection