@extends('template.app')

@section('pagetitle','Jadwal Penyuluhan')

@push('customcss')
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"></script>
@endpush

@section('content')
<!-- Default box -->
    <div class="box box-primary">
        <div class="box-body">
            <div>
                <a href="{{ route('jadwal.create') }}" class="btn btn-sm btn-primary">
                    <span class="fa fa-plus"></span> Tambah data
                </a> 
            </div> <br>
           <div class="table">
             <table class="table table-striped table-hover table-responsive" id="table">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Nama Agenda</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th width="170px">Aksi</th>
                  </tr>
              </thead>

              <tbody>
                @foreach ($jadwal as $value)
                <tr>
                    <td>{{  $loop->index + 1 }}</td>
                    <td>{{ ucfirst($value->nama_agenda)}}</td>
                    {{-- <td>{{ date('l, d F Y', strtotime($value->tanggal)) }}</td> --}}
                    <td>{{ $value->tangggal->formatLocalized('%A, %d %B %Y') }}</td>
                    <td>{{ $value->waktu }}</td>
                    <td>{{ str_limit($value->lokasi,20,'...') }}</td>
                    <td>
                      @if ($value->is_done > 0)
                      <span class="label label-success">Penyuluhan Selesai</span>
                      @else
                      <span class="label label-warning">belum Terlaksana</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('jadwal.edit', $value->id) }}" class="btn btn-info" title="Edit Agenda"><span class="fa fa-edit"> Edit</span></a>
                      
                      {{-- <a href=" {{ route('jadwal.show',$value->id) }} " class="btn btn-primary"> <span class="fa fa-external-link"></span> </a> --}}

                      <a href="javascript:void(0)" onclick="$(this).find('form').submit()" class="btn btn-danger" title="Hapus Agenda">
                        <span class="fa fa-trash"></span>
                        <form action="{{ route('jadwal.destroy', $value->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                        </form>
                      </a>

                      @if ($value->is_done == 0)
                      <a href="{{ route('jadwal.status', $value->id) }}" class="btn btn-success" title="Laksanakan?">
                          <span class="fa fa-check"></span>
                      </a>
                      @endif
                    </td>
                </tr>
                @endforeach
                    
            </tbody>
          </table>
          <div class="pull-right">
            {!! $jadwal->links() !!}
          </div>
        </div>
      </div>
        <!-- /.box-body -->
@endsection