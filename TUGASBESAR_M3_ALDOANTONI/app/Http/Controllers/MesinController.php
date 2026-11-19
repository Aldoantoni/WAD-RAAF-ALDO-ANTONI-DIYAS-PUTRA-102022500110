<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MesinController extends Controller
{
    public function index(Request $request)
    {
        $data_mesin = DB::select("SELECT * FROM mesin ORDER BY id DESC");
        
        $edit_data = null;
        if ($request->has('edit')) {
            $id_edit = $request->query('edit');
            $edit_data = DB::selectOne("SELECT * FROM mesin WHERE id = ?", [$id_edit]);
            if ($edit_data) {
                $edit_data = (array) $edit_data;
            }
        }

        return view('laundry', compact('data_mesin', 'edit_data'));
    }

    public function simpan(Request $request)
    {
        $id = $request->input('id');
        $kode = trim($request->input('kode'));
        $jenis = $request->input('jenis');
        $merek = trim($request->input('merek'));
        $kapasitas = $request->input('kapasitas');
        $status = $request->input('status');

        if (!empty($id)) {
            DB::update(
                "UPDATE mesin SET kode = ?, jenis = ?, merek = ?, kapasitas = ?, status = ? WHERE id = ?",
                [$kode, $jenis, $merek, $kapasitas, $status, $id]
            );
        } else {
            DB::insert(
                "INSERT INTO mesin (kode, jenis, merek, kapasitas, status) VALUES (?, ?, ?, ?, ?)",
                [$kode, $jenis, $merek, $kapasitas, $status]
            );
        }

        return redirect()->route('mesin.index');
    }

    public function hapus($id)
    {
        DB::delete("DELETE FROM mesin WHERE id = ?", [$id]);
        return redirect()->route('mesin.index');
    }
}
