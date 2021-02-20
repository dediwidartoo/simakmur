@extends('index')

@section('title_header', 'Master Produk')

@section('desc_header', 'Barang Kebutuhan pertanian')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-book"></i> Master</a></li>
    <li class="active"><a href="#">Produk</a></li>
@endsection

@section('customcss')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/jquery.dataTables.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Default box -->
    <div class="box box-primary">
        <div class="box-body">
        
             <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            
            <div>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-insert">
                    <span class="fa fa-plus"></span> Tambah Data
                </button>
            </div>

            <br>

           <div class="table">
               <table class="table table-striped table-hover table-responsive" id="table">
                    <thead>
                        <tr>
                            <th style="text-align: left;">No.</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th class="text-center nosort">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $result)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ ucfirst($result->produk) }}</td>
                                <td>Rp. {{ number_format($result->harga,0,'.','.') }}</td>
                                <td>{{ ($result->stok) }}</td>
                                <td>{!! str_limit($result->deskripsi,30,'...') !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('product.show',$result->id) }}" class="btn btn-primary btn-xs">
                                        <span class="fa fa-external-link"></span>
                                    </a>
                                    <a href="#modal-edit" class="btn btn-warning btn-xs edit" data-toggle="modal"
                                    data-id="{{ $result->id }}" data-produk="{{ $result->produk }}" data-harga="{{ $result->harga }}" data-stok="{{ $result->stok }}" data-deskripsi="{{ $result->deskripsi }}"
                                    >
                                        <span class="fa fa-edit"></span>
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

           <!-- Modal insert-->
            <div id="modal-insert" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Tambah Data</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('product.toko') }}" method="post" class="form" enctype="multipart/form-data">

                                @csrf

                                <div class="form-group">
                                    <label for="">Nama Produk <span class="label-required">*</span></label>
                                    <input type="text" name="produk" class="form-control input-sm" placeholder="Nama Produk..." required maxlength="60" value="{{ old('product') }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Harga <span class="label-required">*</span></label>
                                    <input type="number" name="harga" class="form-control input-sm" placeholder="Harga Produk..." required min="0" max="9999999999" value="{{ old('price') }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Stok <span class="label-required">*</span></label>
                                    <input type="number" name="stok" class="form-control input-sm" placeholder="Stok Produk..." required min="0" max="9999999999" value="{{ old('stock') }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Gambar</label>
                                    <input type="file" name="images[]" id="images" class="form-control input-sm" multiple accept="images/*">
                                </div>

                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea id="summernote" class="summernote form-control" name="deskripsi">{{ old('description') }}</textarea>
                                </div>

                                <hr>
                                <input type="submit" value="Simpan" class="btn btn-success btn-md">
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            {{-- #############blade --}}

            <!-- Modal edit-->
            <div id="modal-edit" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Produk</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('product.update') }}" method="post" class="form" enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="id" id="id-product" value="">
                                <div class="form-group">
                                    <label for="">Nama Produk <span class="label-required">*</span></label>
                                    <input type="text" name="produk" id="product" class="form-control input-sm" placeholder="Nama Produk..." required maxlength="60" value="{{ old('product') }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Harga <span class="label-required">*</span></label>
                                    <input type="number" name="harga" id="price" class="form-control input-sm" placeholder="Harga Produk..." required min="0" max="9999999999" value="{{ old('price') }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Stok <span class="label-required">*</span></label>
                                    <input type="number" name="stok" id="stock" class="form-control input-sm" placeholder="Stok Produk..." required min="0" max="9999999999" value="{{ old('stock') }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Gambar</label>
                                    <input type="file" name="images[]" id="images" class="form-control input-sm" multiple accept="images/*">
                                </div>

                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea id="summernote-edit" class="summernote form-control" name="deskripsi" id="description">{{ old('description') }}</textarea>
                                </div>

                                <hr>
                                <input type="submit" value="Ubah" class="btn btn-primary btn-md ">
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ###############js
            $('#table').on('click', '.edit', function() {

                const id = $(this).data('id');
                const product = $(this).data('product');
                const price = $(this).data('price');
                const stock = $(this).data('stock');
                const description = $(this).data('description');

                $('#modal-edit').find('#id-product').val(id);
                $('#modal-edit').find('#product').val(product);
                $('#modal-edit').find('#stock').val(stock);
                $('#modal-edit').find('#price').val(price);
                $('#modal-edit').find('#id').val(id);
                $('#summernote-edit').summernote('code', description);
            }); --}}

        </div>
        <!-- /.box-body -->
    </div>
<!-- /.box -->
@endsection
@section('customjavascript')
    <script type="text/javascript" src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                lang: 'id-ID' // default: 'en-US'
            });

            $('#table').on('click', '.edit', function() {
                const id        = $(this).data('id');
                const produk    = $(this).data('produk');
                const harga     = $(this).data('harga');
                const stok      = $(this).data('stok');
                const deskripsi = $(this).data('deskripsi');

                $('#modal-edit').find('#id-product').val(id);
                $('#modal-edit').find('#product').val(produk);
                $('#modal-edit').find('#stock').val(stok);
                $('#modal-edit').find('#price').val(harga);
                $('#modal-edit').find('#id').val(id);
                $('#summernote-edit').summernote('code', deskripsi);
            });
        });
    </script>
@endsection