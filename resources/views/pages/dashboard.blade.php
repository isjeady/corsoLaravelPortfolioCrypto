@extends('layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>


        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                        <h3>{{ $totalElements }}</h3>

                        <p>Total Currencies</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('cryptocurrenciesRoute') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                        <h3>{{ $currentTotalBalance }} &euro;</h3>

                        <p>Balance</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('cryptocurrenciesRoute') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                 
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                        <h3>{{ $totalGain }} &euro;</h3>

                        <p>Gain </p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-glyphicon glyphicon-pencil"></i>
                        </div>
                        <a href="{{ route('cryptocurrenciesRoute') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                        <h3>{{ $startTotalBalance }} &euro;</h3>

                        <p>Start Balance</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('cryptocurrenciesRoute') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div style="width:70%;">
                    {!! $chartjsBalance->render() !!}
                </div>
            </div>

            <div class="row">
                <div style="width:70%;">
                    {!! $chartjsGain->render() !!}
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
