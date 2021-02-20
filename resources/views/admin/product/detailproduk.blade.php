@extends('index')

@section("title_header")
    Detail Produk {{ ucfirst($produks->produk) }}
@endsection

@section('desc_header', 'Detail Produk yang anda pilih')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-book"></i> Master</a></li>
    <li><a href="#">Produk</a></li>
    <li class="active"><a href="#">Detail Produk</a></li>
@endsection

@section('customcss')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/jquery.dataTables.min.css') }}">
@endsection

@section('content')
<!-- Default box -->
    <div class="box box-primary">
        <div class="box-body">
            <div>
                <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm"> <span class="fa fa-angle-left"></span> Kembali</a>
            </div>
            <br>
           <div class="table">
               <table class="table table-striped table-hover table-responsive" id="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No.</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produks->imageRelation as $data)
                        <tr>
                            <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                            <td>
                                <img src="{{ asset('uploads/'.$data->gambar) }}" alt="{{ $data->gambar }}" height="250px">
                            </td>
                        </tr>
                        @empty
                        <tr> <td colspan="2" style="text-align:center"> Gambar tidak ada </td></tr>
                        @endforelse
                    </tbody>
                </table>
           </div>
        </div>
        <!-- /.box-body -->
    </div>
<!-- /.box -->
@endsection
@section('customjavascript')
    <script type="text/javascript" src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
@endsection