@extends('template.app')

@push('customcss')
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"></script>
@endpush

  @section('pagetitle','Buat Artikel')

  @section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <div class="pull-left">
          <a href="{{ route('artikel.create') }}" class="btn btn-info">Tambah Data</a>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Gambar</th>
          <th>Nama Kategori</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($artikel as $value)
            <tr>
                <td>{{  $loop->index + 1 }}</td>
                <td>{{ ucfirst($value->judul)}}</td>
                <td><img src="https://cdn4.iconfinder.com/data/icons/user-avatar-flat-icons/512/User_Avatar-04-512.png" width="50px" height="50px" ></td>
                <td>{{ $value->Kategori->nama_kategori }}</td>
                <td>
                    <a href="#" class="btn btn-info">Edit</a>

                    <a href="javascript:void(0)" onclick="$(this).find('form').submit()" class="btn btn-danger">
                            <span class="fa fa-trash"></span>
                            <form action="#" method="POST">
                                 @csrf
                                 @method('DELETE')
                            </form>
                     </td>
            </tr>
            @endforeach
                
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  @push('datatables')
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/datatables.bootstrap.min.js') }}"></script>
  @endpush
  @push('customdatatables')
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
  @endpush
  @endsection