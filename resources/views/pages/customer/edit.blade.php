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
                    
                    <form class="form-horizontal" method="post" action="{{ url('customer/update/'.$customer->id) }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Gender</label>
                                <div class="col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="Male" {{ ($customer->gender == 'Male') ? 'checked' : '' ; }}>Male
                                        </label>
                                        <label>
                                            <input type="radio" name="gender" value="Female" {{ ($customer->gender == 'Female') ? 'checked' : '' ; }}>Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Age</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="age" placeholder="Enter a number" value="{{ $customer->age }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Annual Income</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="income" placeholder="Enter a number" value="{{ $customer->income }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Spending Score</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="spending_score" placeholder="1 - 100" value="{{ $customer->spending_score }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Profession</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="profession" placeholder="Job Profession" value="{{ $customer->profession }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Work Experience</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="work_experience" placeholder="Enter a number" value="{{ $customer->work_experience }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Family Size</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="family_size" placeholder="Enter a number" value="{{ $customer->family_size }}">
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <a href="{{ url('customer') }}" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection