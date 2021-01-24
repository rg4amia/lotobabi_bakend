@extends('layouts.master')

@section('title') Ecole @endsection

@section('subTitle') Creation @endsection

@section('css')
    <style>

        .choose_file{
            position:relative;
            display:inline-block;
            border-radius:8px;
            border:#ebebeb solid 1px;
            width:250px;
            padding: 4px 6px 4px 8px;
            font: normal 14px Myriad Pro, Verdana, Geneva, sans-serif;
            color: #7f7f7f;
            margin-top: 2px;
            background:white
        }
        .choose_file input[type="file"]{
            -webkit-appearance:none;
            position:absolute;
            top:0; left:0;
            opacity:0;
        }

    </style>
@endsection
@section('content')
    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                {{ Form::model($ecole,['route'=>'ecole.update', 'files'=>true]) }}
                {{Form::hidden('_method','PUT')}}
                {{ Form::hidden('id', $ecole->id) }}
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="name">NOM ETABLISSEMENT</label>
                            <input type="text" name="nometab" value="{{$ecole->nometab}}" class="form-control" id="nometab" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="slug">CODE</label>
                            <input type="text" name="code" value="{{$ecole->code}}"  class="form-control" id="code"  required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="slug">GENRE</label>
                            <input type="text" name="genre"  value="{{$ecole->genre}}"  class="form-control" id="genre"  required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="slug">DREN</label>
                            <input type="text" name="dren" value="{{$ecole->dren}}"  class="form-control" id="dren" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="slug">COMMUNE</label>
                            <input type="text" name="commune"  value="{{$ecole->commune}}" class="form-control" id="commune" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="slug">CYCLE</label>
                            <input type="text" name="cycle" value="{{$ecole->cycle}}"  class="form-control" id="cycle" required>
                        </div>
                    </div>
                </div>

                <button id="save" type="submit" class="btn btn-info btn-icon-split mt-3">
                    <span class="icon text-white-50">
                        <i class="feather icon-save"></i>
                    </span>
                    <span class="text">Modifier</span>
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </section>

@endsection


