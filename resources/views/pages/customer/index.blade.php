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
                <div class="box box-info">
                    <diV class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <input type="text" />
                            </div>
                        </div>
                    </diV>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Customer</h3>
                        <button class="btn btn-primary btn-sm pull-right" onclick="goAddCustomer()"><i class="fa fa-plus"></i> Create</button>
                    </div>
                    <div class="box-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align:center; width:5%">No</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Annual Income</th>
                                    <th>Spending Score</th>
                                    <th>Profession</th>
                                    <th>Work Experience</th>
                                    <th>Family Size</th>
                                    <th style="text-align:center; width:15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($listCustomers) > 0)
                                @foreach($listCustomers as $i => $rowCustomer)
                                <tr>
                                    <td style="text-align:center">{{ $i+1 }}</td>
                                    <td>{{ $rowCustomer->gender }}</td>
                                    <td>{{ $rowCustomer->age }}</td>
                                    <td style="text-align:right;">{{ $rowCustomer->income }}</td>
                                    <td>{{ $rowCustomer->spending_score }}</td>
                                    <td>{{ $rowCustomer->profession }}</td>
                                    <td>{{ $rowCustomer->work_experience }}</td>
                                    <td>{{ $rowCustomer->family_size }}</td>
                                    <td style="text-align:center;">
                                        <form method="post" action="{{ url('customer/delete/'.$rowCustomer->id) }}">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ url('customer/edit/'.$rowCustomer->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                                            <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this data? id: {{ $rowCustomer->id }}')" type="submit"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" style="text-align:center;"><i>Data Kosong</i></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function goAddCustomer() {
            window.location.href = "{{ url('customer/create') }}";
        }
    </script>

</div>


@endsection