<?php

namespace App\Http\Controllers;

use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersyaratanController extends Controller
{

    // set index page view
    public function index()
    {
        return view('persyaratan.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Persyaratan::all();
        $p = 1;
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>nama</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->nama_persyaratan . '</td>
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


        if($request->file('upload_data')){

        $file = $request->file('upload_data');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);
            $empData = [
                'nama_persyaratan' => $request->nama_persyaratan,
                'entry_data' => $request->entry_data,
                'upload_data' => $fileName,
                'status' => $request->status
            ];

            Persyaratan::create($empData);
            return response()->json([
                'status' => 200,
            ]);
        }else{
            $empData = [
                'nama_persyaratan' => $request->nama_persyaratan,
                'entry_data' => $request->entry_data,
                'status' => $request->status
            ];

            Persyaratan::create($empData);
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    // handle edit an Tu ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Persyaratan::find($id);
        return response()->json($emp);
    }

    // handle update an Tu ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $emp = Persyaratan::find($request->emp_id);
        if ($request->hasFile('upload_data')) {
            $file = $request->file('upload_data');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($emp->image) {
                Storage::delete('public/images/' . $emp->image);
            }
        } else {
            $fileName = $request->emp_image;
        }
        $empData = [
            'nama_persyaratan' => $request->nama_persyaratan,
            'entry_data' => $request->entry_data,
            'upload_data' => $fileName,
            'status' => $request->status
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
        $emp = Persyaratan::find($id);
        if (Storage::delete('public/images/' . $emp->upload_data)) {
            Persyaratan::destroy($id);
        }
    }

}


