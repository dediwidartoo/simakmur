@extends('template.app')

@section('pagetitle','Kategori Artikel')

@push('customcss')
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"></script>
@endpush

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <div class="pull-left">
          <a href="{{ route('category.create') }}" class="btn btn-md btn-primary"><span class="fa fa-plus"> Tambah</span> </a>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $index=>$value)
            <tr>
                <td>{{  $loop->index + 1 }}</td>
                <td>{{ ucfirst($value->nama_kategori)}}</td>
                <td>{{$value->slug}}</td>
                <td>
                  <a href="{{ route('category.edit', $value->id) }}" class="btn btn-xs btn-info"><span class="fa fa-edit"> Edit</span></a>
                  <a href="javascript:void(0)" onclick="$(this).find('form').submit()" class="btn btn-xs btn-danger">
                    <span class="fa fa-trash"> Hapus</span>
                    <form action="{{ route('category.destroy', $value->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                    </form>
                  </a>
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