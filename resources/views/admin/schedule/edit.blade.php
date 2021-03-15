@extends('template.app')

@section('pagetitle','Edit Jadwal Agenda Penyuluhan')

@push('customcss')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<link rel="stylesheet" href="{{asset('dist\air-datepicker\dist\css\datepicker.css')}}">
@endpush

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      
    </div>
    <!-- /.box-header -->
    <div class="box-body pad">
      <form action="{{ route('jadwal.update', $jadwal->id) }}" enctype="multipart/form-data" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>Nama Agenda</label>
            <input type="text" autocomplete="off" class="form-control" name="nama_agenda" placeholder="Nama kegiatan Penyuluhan" value="{{ $jadwal->nama_agenda }}">
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="text" autocomplete="off"
                class="datepicker-here form-control" name="tangggal" placeholder="tanggal kegiatan"
                data-language='en' value="{{$jadwal->tangggal->formatLocalized('%A, %d %B %Y')}}"/>
        </div>

        <div class="form-group">
            <label>Waktu</label>
            <input type="text" autocomplete="off" class="form-control" name="waktu" placeholder="contoh: pukul 08:00 WIB " value="{{$jadwal->waktu}}">
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" autocomplete="off" class="form-control" name="lokasi" placeholder="Tempat Kegiatan Penyuluhan Berlangsung" value="{{$jadwal->lokasi}}">
        </div>

        <div class="form-group">
            <label>Catatan (Optional)</label>
            <input type="text" autocomplete="off" class="form-control" name="catatan" placeholder="Tambahan berita" value="{{$jadwal->catatan}}">
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Edit Agenda</button>
          <a href="{{ URL::previous() }}" class="btn btn-danger">Kembali</a>
        </div>

      </form>
    </div>
  </div>
</div>
  <!-- /.box -->
  @endsection
  @push('customscript')
      <script src="{{ asset('dist\air-datepicker\dist\js\datepicker.js') }}"></script>
      <script src="{{ asset('dist\air-datepicker\dist\js\i18n\datepicker.en.js') }}"></script>
  @endpush
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