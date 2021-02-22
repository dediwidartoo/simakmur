@extends('template.app')

@section('pagetitle','Master Product')

@section('content')
<!-- Default box -->
    <div class="box box-primary">
        <div class="box-body">
            <div>
                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">
                    <span class="fa fa-plus"></span> Tambah data
                </a>
            </div>
           <div class="table">
               <table class="table table-striped table-hover table-responsive" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produks as $index => $item)
                            <tr>
                                <td>{{ $index + $produks->firstItem() }}</td>
                                <td>{{ ucfirst($item->produk) }}</td>
                                <td>{{ "Rp. ".number_format($item->harga,0,'.','.') }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <img src=" {{ URL::asset('uploads/'.$item->latestImage()->first()->gambar) }} " alt="" width="240px" height="120px">
                                </td>
                                <td>
                                    <a href=" {{ route('product.show',$item->id) }} " class="btn btn-xs btn-primary"> <span class="fa fa-external-link"></span> </a>
                                    <a href="{{ route('product.edit',$item->id) }}" class="btn btn-xs btn-success"> <span class="fa fa-edit"></span></a>

                                    <a href="javascript:void(0)" onclick="$(this).find('form').submit()"
                                        class="btn btn-xs btn-danger">
                                        <span class="fa fa-trash"></span>

                                        <form action="{{ route('product.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pull-right">
                    {!! $produks->links() !!}
                </div>
           </div>
        </div>
        <!-- /.box-body -->
@endsection