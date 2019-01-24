@extends('layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Cryptocurrencies - {{ $date }}
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardAlias') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">CryptoCurrencies</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Cryptocurrencies</h3>
                    </div>

                    <div class="box-tools custom-paginate">
                        <button type="button" onclick="window.location='{{ route("cryptocurrenciesRoute.new")}}'" class="btn btn-block btn-success">New</button>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                    <table class="table">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th>My Token</th>
                            <th>My Gain</th>
                            <th>% 24h</th>
                            <th>% 7Days</th>
                            <th style="width: 10px">View</th>
                            <th style="width: 10px">Edit</th>
                            <th style="width: 10px">Del</th>
                        </tr>

                        @foreach($cryptoCurrenciesValues as $key=>$crypto)
                            <tr id="crypto_row_{{ $crypto->id }}">
                                <td>{{ $crypto->id }}.</td>
                                <td>{{ $crypto->name }}</td>
                                <td>{{ $crypto->symbol }}</td>
                                <td>
                                    {{ $crypto->my_token }} <small> {{ $crypto->symbol }}</small>
                                    <h5>Price: {{ $crypto->price }} &euro;</h5>  
                                    <h5>Current Price: {{ $crypto->current_price }} &euro;</h5>
                                 </td>
                                <td>
                                    <h4>{{ $crypto->my_gain }} &euro;</h4> 
                                    {{ ($crypto->total != 0) ? round((($crypto->my_gain*100) / $crypto->total),2) : '0' }}%
                                    @if($crypto->total != 0)
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-{{ round((($crypto->my_gain*100) / $crypto->total),2) >=0 ? 'success' : 'danger' }}" style="width: {{ ($crypto->total != 0) ? abs(round((($crypto->my_gain*100) / $crypto->total),2)) : '0' }}%"></div>
                                        </div>
                                    @else
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 0%"></div>
                                        </div>
                                    @endif
                                    
                                </td>
                                <td><span class="badge bg-{{ $crypto->percent_change_24h >=0 ? 'green' : 'red' }}">{{ $crypto->percent_change_24h }}%</span></td>
                                <td><span class="badge bg-{{ $crypto->percent_change_7d >=0 ? 'green' : 'red' }}">{{ $crypto->percent_change_7d }}%</span></td>
                                <td style="width: 10px">
                                    <a class="btn btn-app btn-app-custom"  href="{{ route("cryptocurrenciesRoute.get" , $crypto->id) }}">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </a>
                                </td>
                                <td style="width: 10px">
                                    <a class="btn btn-app btn-app-custom" href="{{ route("cryptocurrenciesRoute.edit" , $crypto->id) }}">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </td>
                                <td style="width: 10px">
                                <a class="btn btn-app btn-app-custom delete-crypto" data-toggle="modal" data-target="#modal-delete" data-key="{{ $crypto->id }}">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>

                    <div class="box-tools custom-paginate">
                        {{ $cryptoCurrenciesValues->links() }}
                    </div>

                </div>
            </div>

          </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal modal-danger fade in" id="modal-delete" style="padding-right: 17px;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Delete Crypto</h4>
            </div>
            <div class="modal-body">
              <p>Vuoi eliminare il record ?</p>
              {!! Form::open(['class' => 'form custom-form']) !!}
               {!! Form::hidden('key',null, ['id' => 'id_crypto_delete']) !!}
              {!! Form::close() !!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline delete-crypto-form">Delete</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <style>
        .custom-paginate{
            float: right;
            padding: 15px 15px 15px 0px;
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


@section('script_page')
<script type="text/javascript">
    $(document).ready(function(){

        $('.delete-crypto').click(function(e){
            e.preventDefault();
            var key = $(this).data('key');
            console.log("mi hai cliccato l'id:" + key);
            $('#id_crypto_delete').val(key);
        });


        $('.delete-crypto-form').click(function(e){
            e.preventDefault();
            var _token = $('[name="_token"]').val();
            var key = $('#id_crypto_delete').val();

            console.log("confermi delete :" + key);

            $.ajax({
                url : '{{ url('cryptocurrencies/') }}/' + key,
                type : 'delete',
                data : { _token : _token },
                success : function(msg){
                    console.log('del success');
                    $('#crypto_row_' + key).hide();
                    $('#modal-delete').modal('toggle');
                },
                error : function(data){
                }
            });


        });
    });
</script>
@endsection



