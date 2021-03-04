@extends('template.app')

@section('pagetitle','Buat kategori')

  @section('content')
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Kategori</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="{{ route('category.store') }}" method="POST">
            @method('POST')
            @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Kategori</label>
              <input type="text" class="form-control" name="nama_kategori" placeholder="Kategori"  value="{{ old('nama_kategori') }}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail2">Slug</label>
                <input type="text" class="form-control" name="slug" placeholder="Slug Kategori"  value="{{ old('nama_kategori') }}">
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><span class="fa fa-plus-square" aria-hidden="true"> Submit</span></button>
            <a href="{{ route('category.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left" aria-hidden="true"> Kembali</span></a>

          </div>
        </form>
      </div>
    </div>
  </div>
      <!-- /.box -->

  @endsection