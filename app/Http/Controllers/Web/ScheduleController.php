<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Schedule::latest()->paginate(10);
        // dd($jadwal);
        return view('admin.schedule.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Schedule::create($request->all());
        return redirect()->route('jadwal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = Schedule::find($id);
        return view('admin.schedule.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jadwal=Schedule::find($id);
        $jadwal->update([
            'nama_agenda'   => $request->nama_agenda,
            'tangggal'          => $request->tangggal,
            'waktu'   => $request->waktu,
            'lokasi'   => $request->lokasi,
            'catatan'   => $request->catatan
        ]);

        return redirect()->route('jadwal.index');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Schedule::find($id);
        if (!$jadwal) {
            return redirect()->back();
        }

        $jadwal->delete();
        return redirect()->route('jadwal.index');
    }

    public function updateProcess($id)
    {
        $plan = Schedule::where('id',$id)->where('is_done',0)->first();

        $plan->update([
            'is_done' => 1
        ]);

        return redirect()->back()->with([
            'status' => [
                'code'  => 200,
                'deskripsi' => 'Success'
            ]
        ]);
    }
}
