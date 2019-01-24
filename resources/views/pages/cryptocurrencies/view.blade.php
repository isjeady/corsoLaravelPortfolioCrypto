@extends('layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Cryptocurrencies
            </h1>

            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboardAlias') }}"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li>
                    <a href="{{ route('cryptocurrenciesRoute') }}"><i class="fa fa-dashboard"></i> CryptoCurrencies</a>
                </li>
                <li class="active">
                    View
                </li>
            </ol>
        </section>

        <section class="content">
        <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                    <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">
                           View Crypto
                        </h3>
                        </div>

                        <!-- /.box-header -->
                        <!-- form start -->


                        <div class="view-crypto">
                            <h5><b>Id: </b>{{ $recordToView->id }}</h5>
                            <h5><b>Name id: </b>{{ $recordToView->name_id }}</h5>
                            <h5><b>Site Store: </b><a href="{{ $recordToView->site_store }}" target="_blank" >{{ $recordToView->site_store }}</a></h5>
                            <h3>{{ $recordToView->symbol }} - {{ $recordToView->name }}</h3>
                            <hr>
                            <h3><b>My Token: </b></h3>
                            <div class="callout callout-success">
                                    <h4>{{ $recordToView->my_token }}</h4>
                            </div>
                            <h3><b>Price: </b></h3>
                            <div class="callout callout-success">
                                    <h4>{{ $recordToView->price }}</h4>
                            </div>
                            <h3><b>My Gain: </b>{{ $recordToView->my_gain }}</h3>
                            <hr>
                            <h3><b>Percent Change 24h:</b></h3>
                            <div class="box-body">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="{{ $recordToView->percent_change_24h }}"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $recordToView->percent_change_24h }}%">
                                        <span>{{ $recordToView->percent_change_24h }}% Percent Change 24h</span>
                                      </div>
                                    </div>
                            </div>
                            <hr>
                            <h3><b>Percent Change 7d:</b></h3>
                            <div class="box-body">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="{{ $recordToView->percent_change_7d }}"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $recordToView->percent_change_7d }}%">
                                        <span>{{ $recordToView->percent_change_7d }}% Percent Change 7d</span>
                                      </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
    </div>
    <!-- /.content-wrapper -->

    <style>
        .custom-paginate{
            float: right;
            padding: 15px 15px 0px 0px;
        }
        form.form.custom-form {
            padding: 50px;
        }
        .btn-app-custom {
            border-radius: 3px;
            position: relative;
            padding: 0px 0px;
            margin: 0 0 10px 10px;
            min-width: 15px;
            height: 0px;
            text-align: center;
            color: #666;
            border: 0px solid #ddd;
            background-color: #fff;
            font-size: 10px;
        }
        .view-crypto {
            padding: 50px;
        }
    </style>
@endsection
