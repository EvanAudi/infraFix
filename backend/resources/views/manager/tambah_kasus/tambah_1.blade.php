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

<style>
    .pagination .page-link {
        color: #A50000;
    }

    .pagination .page-link:hover {
        color: darkred;
    }

    .pagination .active {
        color: #A50000;
    }
</style>
@endsection

@section('title')
Menambahkan Kasus
@endsection

@section('content')

<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger" style="">
        Penambahan Laporan Gagal.
    </div>
    @endif
    <div class="row" style="background-color: #EDEDED;">
        <!-- 1 -->
        <div class="row pt-3 px-5">
            <div class="col-lg-2">
                <div class="button">
                    <a href="{{ route('manager.laporan_belum_unggah') }}" id="submit">
                        <button type="button" class="btn-close" disabled aria-label="Close"></button>
                    </a>
                </div>
            </div>
        </div>
        <!-- 2 -->
        <div class="row justify-content-center" style="margin-top: 7rem">
            <div class="col-lg-10 rounded" style="background-color: white; height: 35.3rem; width: 82vw;">
                <div class="row text-start p-2" style="display: inline-block">
                    <h4><span id="selected-count">{{$selectedCount}}</span> laporan dipilih</h4>
                </div>
                <div class="row">
                    <form action="{{route('manager.updateHotTopic')}}" method="POST">
                        @csrf
                        @if(count($selectedLaporans) > 0)
                        <div class="row text-center">
                            <table class="table align-middle">
                                <thead style="border-bottom-width: 3px; border-top-width: 3px;">
                                    <tr>
                                        <th scope="col">Kode Laporan</th>
                                        <th scope="col">Judul Laporan</th>
                                        <th scope="col">Tipe Kerusakan</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Kelurahan</th>
                                        <th scope="col">Kecamatan</th>
                                        <th scope="col">Kota</th>
                                        <th scope="col">Provinsi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table align-middle">
                                    @foreach ($selectedLaporans as $selected)
                                    <tr id="report-{{ $selected->id }}">
                                        <td>{{$selected->report_code}}</td>
                                        <td>{{$selected->title}}</td>
                                        <td>{{$selected->damage_type->name}}</td>
                                        <td>{{$selected->address}}</td>
                                        <td>{{$selected->kelurahan->name}}</td>
                                        <td>{{$selected->kelurahan->kecamatan->name}}</td>
                                        <td>{{$selected->kelurahan->kecamatan->kota->name}}</td>
                                        <td>{{$selected->kelurahan->kecamatan->kota->provinsi->name}}</td>
                                        <td>
                                            <button class="btn-remove" data-id="{{ $selected->id }}"
                                                style="border: none">
                                                <span class="material-symbols-outlined align-middle"
                                                    style="color: #A50000;">delete</span>
                                                <h6 style="color: black; display: inline;">Hapus</h6>
                                            </button>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p>Silakan pilih laporan terlebih dahulu</p>
                        @endif
                        <div class="row mb-4 ms-3 mt-2">
                            <div class="col-lg-3">
                                <h4 style=" margin-left: -1rem">Pilih Hot
                                    Topic</h4>
                                <select class="form-select" name="report_selected"
                                    style="background-color: #F2F2F2; margin-left: -0.7rem;" id=""
                                    name="hot_topic_selected">
                                    <option selected>Pilih...</option>
                                    @foreach ($hot_topics as $item)
                                    <option value="{{ $item->id }}" style="color: black;">
                                        {{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-lg-2">
                                <div class="button">
                                    <button type="submit" class="btn btn-m rounded bottom-button">Tambahkan
                                        ke
                                        Kasus</button>
                                </div>
                            </div>
                        </div>
                        <input class="reports" type="hidden" name="reports">
                    </form>
                </div>
            </div>
            <div class="col-lg-10 mt-3">
                <div>
                    {{$selectedLaporans -> links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        const reports = localStorage.getItem('report_is_checked');
        $(".reports").val(reports);
    });
</script>
<script>
    function removeLocalStorage(){
        // check param page url
        const url = new URL(window.location.href);
            const urlParams = new URLSearchParams(url.search);
            const paramPage = urlParams.get('page');
            if(paramPage === null) {
                // if refresh page => clear localStorage
                localStorage.removeItem('report_is_checked');
            }
            else{
                collectReportData();
            }
    }

    function checkData(){
        // to keep storing the prev values from prev pages
        // check the value from localStorage

        let checkedValues = localStorage.getItem('report_is_checked') ? localStorage.getItem('report_is_checked').split(',') : [];

        const checkedSelected = $(".report-check");

        // re-set the checked values from localStorage
        checkedSelected.each(function() {
            if (checkedValues.includes($(this).val())) {
                $(this).prop("checked", true);
            }

        });

        checkedSelected.on("change", function() {
            const getValue = $(this).val();
            if ($(this).is(":checked")) {
                // save to array and localStorage
                // alert(getValue);
                if (!checkedValues.includes(getValue)) {
                    checkedValues.push(getValue);
                }

            } else {
                // remove from array and localStorage
                checkedValues = checkedValues.filter(value => value !== getValue);
            }

            // store the final checked values to localStorage
            localStorage.setItem('report_is_checked', checkedValues);
            collectReportData();
        });
    }


        function updateSelectedCount() {
        const count = $('#selected-count').text();
        $('#selected-count').text(parseInt(count) - 1);
    }

        function handleRemoveButtonClick() {
        $('.btn-remove').on('click', function() {
            const id = $(this).data('id');

            // remove the ID from localStorage
            let checkedValues = localStorage.getItem('report_is_checked') ? localStorage.getItem('report_is_checked').split(',') : [];
            checkedValues = checkedValues.filter(value => value !== id.toString());
            localStorage.setItem('report_is_checked', checkedValues);

            // remove the list item from the DOM(?)
            $(`#report-${id}`).remove();

            collectReportData();
            updateSelectedCount();
        });
    }

    $(document).ready(function() {

        // removeLocalStorage();

        checkData();

        handleRemoveButtonClick();


    });

</script>
@endsection