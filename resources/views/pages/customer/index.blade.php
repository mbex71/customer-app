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
        <!-- filter -->
        <div class="row">
            <div class="col-xs-8">
                <div class="box">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Filter</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="searchGender" placeholder="Fill Gender" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Age</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="searchAge" placeholder="Fill age" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Income</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="searchIncome" placeholder="Fill Income" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Profession</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="searchProfession" placeholder="Fill Profession" />
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                        <button class="btn btn-primary btn-sm pull-right" onclick="goAddCustomer()"><i class="fa fa-plus"></i> Create</button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="table_customer" class="table table-bordered table-striped responsive">
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
                                        <th style="text-align:center; width:10%">Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function goAddCustomer() {
            window.location.href = "{{ url('customer/create') }}";
        }

        function goEditCustomer(id) {
            window.location.href = "{{ url('customer/edit/') }}/" + id;
        }

        function goDeleteCustomer(id) {
            if (confirm("Are you sure to delete this data?")) {
                $.ajax({
                    url: "{{ url('customer/delete/') }}/" + id,
                    type: "POST", // use the POST method
                    data: {
                        _method: "DELETE", // add the method spoofing field
                        _token: $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function() {
                        alert("Data has been deleted.");
                        location.reload();
                    },
                    error: function() {
                        alert("An error occurred while deleting the data.");
                    }
                });
            }
        }
    </script>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js '></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // ajax
            var customerTable = $('#table_customer').DataTable({
                processing: true,
                serverSide: true,
                searching: false,

                ajax: {
                    url: "{{ route('getCustomer') }}",
                    data: function(data) {
                        data.searchGender = $('#searchGender').val();
                        data.searchAge = $('#searchAge').val();
                        data.searchIncome = $('#searchIncome').val();
                        data.searchProfession = $('#searchProfession').val();
                    }
                },
                columns: [{
                        data: 'id',
                        className: 'dt-center'
                    },
                    {
                        data: 'gender'
                    },
                    {
                        data: 'age'
                    },
                    {
                        data: 'income',
                        className: 'dt-right'
                    },
                    {
                        data: 'spending_score',
                    },
                    {
                        data: 'profession'
                    },
                    {
                        data: 'work_experience',
                        className: 'dt-center',
                        orderable: false
                    },
                    {
                        data: 'family_size',
                        className: 'dt-center',
                        orderable: false
                    },
                    {
                        data: 'aksi',
                        orderable: false
                    },
                ]
            });

            $('#searchGender').keyup(function() {
                customerTable.draw();
            });
            $('#searchAge').keyup(function() {
                customerTable.draw();
            });
            $('#searchIncome').keyup(function() {
                customerTable.draw();
            });
            $('#searchProfession').change(function() {
                customerTable.draw();
            });

        });
    </script>

</div>


@endsection