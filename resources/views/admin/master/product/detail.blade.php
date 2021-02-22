@extends('template.app')

@section('pagetitle','Detail Product')


@section('content')
<div class="box box-primary">
    <div class="box-body">
        <div>
            <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary">
                <span class="fa fa-arrow-left"></span> Kembali
            </a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt>Nama Produk</dt>
                    <dd> {{ ucfirst($produks->produk) }}</dd>

                    <dt>Harga Produk</dt>
                    <dd> {{ "Rp. ". number_format($produks->harga,0,'.','.') }}</dd>

                    <dt>Stok Produk</dt>
                    <dd> <label for="" class="text text-primary"> {{ $produks->stok }} </label></dd>

                    {{-- <dt>Description</dt>
                    <dd style="word-break: break-all;"> {{ str_limit($produks->description,500,' ...') }}</dd> --}}

                </dl>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <label for="">Deskripsi</label>
                <p class="text">{!! $produks->deskripsi !!}</p>
            </div>
        </div>

        {{-- <div class="row"> --}}
            <div class="table">
                <table class="table table-striped table-hover table-responsive" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks->imageRelation as $image)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src=" {{ URL::asset('uploads/'.$image->gambar) }} " alt="" width="240px" height="120px">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- </div> --}}

    </div>
</div>
@endsection
