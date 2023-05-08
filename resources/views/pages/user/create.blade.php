@extends('layouts.app', ['title' => $title])

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <br>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    
                    <form class="form-horizontal" method="post" action="{{ url('user/store') }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" placeholder="Fill Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" placeholder="Fill Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Fill Password">
                                </div>
                            </div>
                            
                        </div>
                        <div class="box-footer">
                            <a href="{{ url('user') }}" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection