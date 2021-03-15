@extends('template.app')

@section('pagetitle','Tulis Artikel')

@push('customcss')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endpush

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      
    </div>
    <!-- /.box-header -->
    <div class="box-body pad">
      <form action="{{ route('artikel.store') }}" enctype="multipart/form-data" method="POST">
        @method('POST')
        @csrf
        <div class="form-group">
          <label>Judul Artikel</label>
          <input type="text" class="form-control" name="judul">
        </div>
        <div class="form-group">
          <label>Gambar</label>
          <input type="file" class="form-control" name="gambar">
        </div>
        <div class="form-group">
          <label>Kategori Artikel</label>
          <select name="kategori_id" class="form-control">
              @foreach ($kategori as $item)
                <option value={{$item->id}}>{{$item->nama_kategori}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Isi Artikel</label>
           <textarea name="body" id="editor1" class="textarea" placeholder="Place some text here"
                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
          </textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Tambah Artikel</button>
          <a href="{{ URL::previous() }}" class="btn btn-danger">Kembali</a>
        </div>

      </form>
    </div>
  </div>
</div>
  <!-- /.box -->
  @endsection
  @push('datatables')
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
  <script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      //CKEDITOR.replace('editor1')
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
    })
  </script>
  @endpush