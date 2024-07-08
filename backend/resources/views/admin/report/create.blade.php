@extends('layouts.admin')
@section('title')
    Laporan    
@endsection
@section('style')
    <style>
           
           .content {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
        transition: all 0.35s ease-in-out;
        background-color: #F1F1F1;
        min-width: 0;
    }

    .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
        color: #a50000;
        
    }


    .row{
        justify-content: center;
    }

    .actions{
        display: flex;
    }

    .edit .material-symbols-outlined{
        font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
    color: #949494;
    }

    .reportBox{
    display: flex;
    align-items: center; /* Align items vertically in the center */
    justify-content: space-between; 
    }

    .report{
        background-color: white;
    }

    .table-header{
        display: flex;
        border-bottom: 3px solid #EDEDED;
        /* background-color: #a50000; */
        align-items: center;
        /* margin-bottom: 3px; */
    }

    .table-title{
        width: 50%;
    }


    .table-button{
        width: 50%;
        display: flex;
        justify-content: end;
    }

    .table-title h5{
        font-weight: bold;
        font-size: 24px;
    }


    .report-table{
    width: 100%;    
    }

    .report-table th{
        border-bottom: 3px solid #EDEDED;
        text-align: center;
    }

    .report-table td{
        border-bottom: 1px solid #EDEDED;
        text-align: center;
    }

    .color-input {
        background-color: #F2F2F2; /* Light gray background */
        border: 1px solid #F2F2F2; /* Gray border */
        color: #000; /* Text color */
    }

    .actions {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        width: 100%;
        height: 100%;
    }
    
    .button-header{
        display: flex;
        justify-content: end;
        /* background-color: red; */
    }

    .button-add{
        border-radius: 15px;
        border-width: 0px;
        background-color: #a50000;
        width: 154px;
        height: 49px;
        color: white;
        font-size: 16px;
        font-weight: bold;
    }

    .button-seeAll{
        border-radius: 20px;
        border-width: 0px;
        background-color: #a50000;
        width: 92px;
        height: 43px;
        color: white;
        font-size: 16px;
        font-weight: bold;
    }


    .pagination{
        display: flex;
        justify-content: end;
        /* background-color: red; */
    }


    </style>    
@endsection
@section('content')
<div class="content">
    <div class="mb-3">
       
        <div class="row mb-3">
            <div class="reportbox col-12 col-md-11 ">
                <div class="report border-0">
                    <div class="report-body py-2">
                        <div class="row mb-3">
                            <div class="insert col-12 col-md-11">
                                <form action="{{ route('admin.report.store') }}" id="submit">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="title" class="form-control color-input" id="title" name="title" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="description" class="form-control color-input" id="description" name="description" required>
                                    </div>
                                  
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="address" class="form-control color-input" id="address" name="address"  required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control color-input" id="email" name="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kelurahan">Kelurahan:</label>
                                        <select class="form-control color-input" id="kelurahan" name="kelurahan" required>
                                            @foreach($data['kelurahan'] as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                        
                                    </div>

                                    <div class="mb-3">
                                        <label for="case">Kasus:</label>
                                        <select class="form-control color-input" id="case" name="case" required>
                                            @foreach($data['case'] as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                        
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label for="anonymous">Anonim:</label>
                                        <select class="form-control color-input" id="anonymous" name="anonymous" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select>
                        
                                    </div>


                                    <div class="mb-3">
                                        <label for="user">Dibuat oleh:</label>
                                        <select class="form-control color-input" id="user" name="user" required>
                                            @foreach($data['user'] as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                        
                                    </div>

                                    <div class="mb-3">
                                        <label for="damage_type">Tipe Kerusakan:</label>
                                        <select class="form-control color-input" id="damage_type" name="damage_type" required>
                                            @foreach($data['damage_type'] as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                        
                                    </div>
                                   
                                </form>
                            </div>
                           
                        </div>
                        <div class="row mb-3">
                            <div class="button-header col-12 col-md-11">
                                    <button class="button-add" type="submit" onclick="document.getElementById('submit').submit()">
                                        Tambah +
                                    </button>
                                </a>
                             
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection