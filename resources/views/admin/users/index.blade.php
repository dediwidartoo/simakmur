@extends('index')

@section('title_header', 'Master User')

@section('desc_header', 'Daftar Anggota Kelompok Tani Makmur')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-book"></i> Master</a></li>
    <li class="active"><a href="#">Anggota</a></li>
@endsection

@section('customcss')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/jquery.dataTables.min.css') }}">
@endsection

@section('content')
<!-- Default box -->

    <div class="box box-primary">
        <div class="box-body">
           <div class="table">
               <table class="table table-striped table-hover table-responsive" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {!! $users->links() !!}
                </div>
           </div>
        </div>
    </div>
        <!-- /.box-body -->
@endsection