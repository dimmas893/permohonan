<?php

namespace App\Http\Controllers;

use App\Models\Pemohon;
use App\Models\Pemohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemohonController extends Controller
{

    // set index page view
    public function index()
    {
        // $persyaratan = Persyaratan::all();
        // $layanan = Layanan::all();
        return view('pemohon.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Pemohon::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Nik</th>
                <th>No KK</th>
                <th>Nama Pemohon</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Email</th>
                <th>User Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nik . '</td>
                <td>' . $emp->no_kk . '</td>
                <td>' . $emp->nama_pemohon . '</td>
                <td>' . $emp->alamat . '</td>
                <td>' . $emp->no_hp . '</td>
                <td>' . $emp->email . '</td>
                <td>' . $emp->user->name . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editTUModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Tu ajax request
    public function store(Request $request)
    {

        $empData = [
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'nama_pemohon' => $request->nama_pemohon,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'id_user' => Auth::user()->id,
        ];
        $pemohon = Pemohon::create($empData);


        $p = 1 ;
        $create = [
            'id_permohonan' => $pemohon->nik,
            'id_pemohon' => $pemohon->id,
            'id_user' => $pemohon->id_user,
            'id_layanan' => $request->id_layanan,
            'tanggal' => $request->tanggal,
        ];
        $pemohonan = Pemohonan::create($create);

        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Pemohon::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Pemohon::find($request->emp_id);

        $empData = [
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'nama_pemohon' => $request->nama_pemohon,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ];
        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Tu ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Pemohon::find($id);
        Pemohon::destroy($id);
    }
}
