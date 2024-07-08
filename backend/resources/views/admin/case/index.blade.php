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

    .detail .material-symbols-outlined{
        font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
    color: #D8A4A4;
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

    .actions {
        display: flex;
        justify-content: space-between; /* Distributes space evenly */
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
                <div class="button-header col-12 col-md-11">
                    <a href="{{ route('case.create') }}">
                        <button class="button-add">
                            Tambah +
                        </button>
                    </a>
                   
                </div>
            </div>
            <div class="row mb-3">
                <div class="reportbox col-12 col-md-11 ">
                    <div class="report border-0">
                        <div class="report-body py-2">
                            <div class="table-header py-2 px-3">
                                <div class="table-title">
                                    <h5>Kasus</h5>
                                </div>
                            </div>
                            <table class="report-table ">              
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Address</th>
                                        <th>Created by</th>
                                        <th>Damage ID</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->created_by }}</td>
                                    <td>{{ $item->damage_type_id }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="actions col-12 col-md-12">
                                            <div class="detail ">
                                                <a href="{{ route('case.details', $id = $item->id) }}">
                                                    <span class="material-symbols-outlined">
                                                        info
                                                     </span>
                                                </a>
                                            </div>
                                            <div class="edit">
                                                <a href="{{ route('case.edit', $id = $item->id) }}">
                                                    <span class="material-symbols-outlined">
                                                        edit
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="delete">
                                                <a href="{{ route('case.destroy', $id = $item->id) }}">
                                                    <span class="material-symbols-outlined">
                                                        delete
                                                    </span>
                                                </a>
                                            </div>
                                            
                                        </div>
                                     
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="pagination col-12 col-md-10 ">
                        {{ $data->links('vendor.pagination.custom') }}
                    </div>
                </div>
           
        </div>
    
    
</body>
</html>
@endsection