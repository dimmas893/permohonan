<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{

    // set index page view
    public function index()
    {
        return view('layanan.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Layanan::all();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Id Layanan</th>
                <th>Nama Layanan</th>
                <th>Info Layanan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->id_layanan . '</td>
                <td>' . $emp->nama_layanan . '</td>
                <td>' . $emp->info_layanan . '</td>
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
            'id_layanan' => $request->id_layanan,
            'nama_layanan' => $request->nama_layanan,
            'info_layanan' => $request->info_layanan,
        ];
        Layanan::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Layanan::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $emp = Layanan::find($request->emp_id);

        $empData = [
            'id_layanan' => $request->id_layanan,
            'nama_layanan' => $request->nama_layanan,
            'info_layanan' => $request->info_layanan,
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
        $emp = Layanan::find($id);
        Layanan::destroy($id);
    }
}

