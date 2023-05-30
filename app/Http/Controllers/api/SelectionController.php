<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Selections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selection = Selections::latest()->get();
        return response([
            'success' => true,
            'message' => 'List semua data seleksi',
            'data' => $selection
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response(
                [
                    'status' => 'error',
                    'message' => $validator->errors()
                ],
                401
            );
        } else {
            $selection = Selections::create([
                'title' => $request->input('title'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'created_at' => $request->input('created_at'),
                'updated_at' => $request->input('updated_at'),
            ]);

            if ($selection) {
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Successfully created candidate'
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Failed to create candidate'
                    ],
                    401
                );
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response(
                [
                    'status' => 'error',
                    'message' => $validator->errors()
                ],
                401
            );
        } else {
            $selection = Selections::findOrFail($id);
            $selection->update([
                'title' => $request->input('title'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => $request->input('status'),
                'created_at' => $request->input('created_at'),
                'updated_at' => $request->input('updated_at'),
            ]);

            if ($selection) {
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Successfully updated selection',
                        'data' => $selection
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Failed to update selection'
                    ],
                    401
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $selection = Selections::findOrFail($id);
        $selection->delete();

        if ($selection) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Successfully deleted selection'
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Failed to delete selection'
                ],
                401
            );
        }
    }

    public function ShowActiveSelection()
    {
        $selection = Selections::where('status', 'active')->get();
        return response([
            'success' => true,
            'message' => 'List semua data seleksi yang aktif',
            'data' => $selection
        ], 200);
    }

    public function ShowInActiveSelection()
    {
        $selection = Selections::where('status', 'inactive')->get();
        return response([
            'success' => true,
            'message' => 'List semua data seleksi yang tidak aktif',
            'data' => $selection
        ], 200);
    }
}
