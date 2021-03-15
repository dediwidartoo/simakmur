@extends('template.app')

@section('pagetitle','Buat Artikel')

@push('customcss')
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"></script>
@endpush

@section('content')
<!-- Default box -->
    <div class="box box-primary">
        <div class="box-body">
            <div>
                <a href="{{ route('artikel.create') }}" class="btn btn-sm btn-primary">
                    <span class="fa fa-plus"></span> Tambah data
                </a> 
            </div> <br>
           <div class="table">
             <table class="table  table-striped table-hover table-responsive" id="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Nama Kategori</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                  </tr>
              </thead>

              <tbody>
                @foreach ($artikel as $value)
                <tr>
                    <td>{{  $loop->index + 1 }}</td>
                    <td>{{ ucfirst($value->judul)}}</td>
                    <td><img src="{{ asset('uploads/'.$value->gambar) }}" width="50px" height="50px" ></td>
                    <td>{{ $value->Kategori->nama_kategori }}</td>
                    <td>{{ date('d M Y', strtotime($value->created_at)) }}</td>
                    <td>
                        <a href="{{ route('artikel.edit', $value->id) }}" class="btn btn-info"><span class="fa fa-edit"> Edit</span></a>
    
                        <a href="javascript:void(0)" onclick="$(this).find('form').submit()" class="btn btn-danger">
                                <span class="fa fa-trash"></span>
                                <form action="{{ route('artikel.destroy', $value->id) }}" method="POST">
                                     @csrf
                                     @method('DELETE')
                                </form>
                         </td>
                </tr>
                @endforeach
                    
            </tbody>
          </table>
          <div class="pull-right">
            {!! $artikel->links() !!}
          </div>
        </div>
      </div>
        <!-- /.box-body -->
@endsection