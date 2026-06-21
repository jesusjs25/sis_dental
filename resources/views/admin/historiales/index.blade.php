@extends('adminlte::page')



@section('content_header')
    <h1><b>Historiales Clínicos</b></h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Historiales Clínicos</h3>

                        <!-- /.card-tools -->
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="card-tools">
                                <a href="{{url('/admin/historiales/ver_reservas',Auth::user()->id)}}" class="btn btn-success"> <i class="fas fa-calendar-check"></i> Ver Reservas</a>
                            </div>
                        </div>
              <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    
@stop