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
        @include('includes.alert')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width:5%">No</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th style="text-align:center; width:15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($listUser) > 0)
                                    @foreach($listUser as $i => $rowUser)
                                    <tr>
                                        <td style="text-align:center">{{ $i+1 }}</td>
                                        <td>{{ $rowUser->name }}</td>
                                        <td>{{ $rowUser->email }}</td>
                                        <td style="text-align:center;">
                                            <form method="post" action="{{ url('user/delete/'.$rowUser->id) }}">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ url('user/edit/'.$rowUser->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                                                <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this data?')" type="submit"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4" style="text-align:center;"><i>Data Kosong</i></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


@endsection