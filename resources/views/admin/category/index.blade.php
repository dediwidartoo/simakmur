@extends('template.app')

@section('pagetitle','Kategori Artikel')

@push('customcss')
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"></script>
@endpush

@section('content')
<!-- Default box -->
    <div class="box box-primary">
        <div class="box-body">
            <div>
                <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">
                    <span class="fa fa-plus"></span> Tambah data
                </a>
            </div>
           <div class="table">
               <table class="table table-striped table-hover table-responsive" id="table">
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
                      <a href="{{ route('category.edit', $value->id) }}" class="btn btn-info"><span class="fa fa-edit"> Edit</span></a>
                      <a href="javascript:void(0)" onclick="$(this).find('form').submit()" class="btn btn-danger">
                        <span class="fa fa-trash"></span>
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
          <div class="pull-right">
            {!! $kategori->links() !!}
          </div>
        </div>
      </div>
        <!-- /.box-body -->
@endsection