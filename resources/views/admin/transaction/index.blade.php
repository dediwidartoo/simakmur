@extends('template.app')

@section('pagetitle','Transaction')


@section('content')
<!-- Default box -->
    <div class="box box-primary">
        <div class="box-body">
           <div class="table">
               <table class="table table-striped table-hover table-responsive" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Transaksi</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    @foreach ($transactions as $index => $tr)
                        <tr>
                            <td>{{ $index + $transactions->firstItem() }}</td>
                            <td>{{ $tr->kode_transaksi }}</td>
                            <td>{{ ucfirst($tr->userRelation->nama) }}</td>
                            <td>{{ "Rp ". number_format($tr->total_akhir,0,'.','.') }}</td>
                            <td>{{ date('d-M-Y'), strtotime($tr->tgl_transaksi) }}</td>
                            <td>
                                @if ($tr->proof_of_payment != null )
                                    <img src="{{ asset('uploads/'.$tr->proof_of_payment) }}" alt="" height="100px" width="100px">
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                @if ($tr->status_transaksi == 'menunggu')
                                    <span class="label label-default">Menunggu</span>
                                @elseif ($tr->status_transaksi == 'tertunda')
                                <span class="label label-warning"> Tertunda</span>
                                @elseif ($tr->status_transaksi == 'diproses')
                                <span class="label label-primary"> Diproses</span>
                                @elseif ($tr->status_transaksi == 'dikirim')
                                <span class="label label-success"> Dikirim</span>
                                @else -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('transaction.show', $tr->id) }}" class="btn btn-xs btn-primary">
                                <span class="fa fa-external-link"></span></a>

                                @if ($tr->status_transaksi == 'tertunda')
                                    
                                
                                <a href="{{ route('transaction.status', $tr->id) }}" class="btn btn-xs btn-success">
                                    <span class="fa fa-check"></span>
                                </a>
                                @endif
                            </td>
                        </tr>
                        
                    @endforeach
                    <tbody>
                    </tbody>
                </table>

                <div class="pull-right">
                    {!! $transactions->links() !!}
                </div>
           </div>
        </div>
        <!-- /.box-body -->
@endsection