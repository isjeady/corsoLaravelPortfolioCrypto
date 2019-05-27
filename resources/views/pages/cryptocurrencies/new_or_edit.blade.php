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
                        {{ $newOrEdit ? 'New Crypto' : 'Edit Crypto' }}
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
                            {{ $newOrEdit ? 'New Crypto' : 'Edit Crypto' }}
                        </h3>
                        </div>

                        <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::open(array('route' => 'cryptocurrenciesRoute.save', 'class' => 'form custom-form')) !!}

                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <!-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif -->

                            <div class="form-group">
                                    {!! Form::hidden('id', $recordToEdit->id,
                                    array('','class'=>'form-control',)) !!}
                            </div>


                            <div class="form-group">
                                {!! Form::label('Name ID Crypto Coin [bitcoin] *') !!}
                                {!! Form::text('name_id', $recordToEdit->name_id,
                                array('',
                                'class'=>'form-control',
                                'placeholder'=>'name id')) !!}
                            </div>

                            @if ($errors->has('name_id'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('name_id') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="form-group">
                                {!! Form::label('Name Crypto Coin [bitcoin] *') !!}
                                {!! Form::text('name', $recordToEdit->name,
                                array('',
                                'class'=>'form-control',
                                'placeholder'=>'name')) !!}
                            </div>

                            @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('name') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                {!! Form::label('Symbol Crypto Coin [BTC]') !!}
                                {!! Form::text('symbol', $recordToEdit->symbol,
                                array('',
                                'class'=>'form-control',
                                'placeholder'=>'symbol')) !!}
                            </div>

                            @if ($errors->has('symbol'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('symbol') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                {!! Form::label('Site Store') !!}
                                {!! Form::text('site_store', $recordToEdit->site_store,
                                array('',
                                'class'=>'form-control',
                                'placeholder'=>'Site')) !!}
                            </div>

                            @if ($errors->has('site_store'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('site_store') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                {!! Form::label('My Token [12.33] *') !!}
                                {!! Form::text('my_token', $recordToEdit->my_token,
                                array('',
                                'class'=>'form-control',
                                'placeholder'=>'My Token')) !!}
                            </div>

                            @if ($errors->has('my_token'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('my_token') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                {!! Form::label('Fix My Price') !!}
                                {{ Form::checkbox('my_price', 1, $recordToEdit->my_price) }}
                            </div>

                            @if ($errors->has('my_price'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('my_price') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="form-group">
                                {!! Form::label('Price Buy Token') !!}
                                {!! Form::text('price', $recordToEdit->price,
                                array('',
                                'class'=>'form-control',
                                'placeholder'=>'Price')) !!}
                            </div>

                            @if ($errors->has('price'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('price') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <div class="form-group">
                            {!! Form::submit($newOrEdit ? 'Save !!!' : 'Update !!!' ,
                            array('class'=>'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
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
    </style>
@endsection
