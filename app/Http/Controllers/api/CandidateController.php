<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Candidates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidates::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $candidates
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
            'id_selections' => 'required',
            'name' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'photo' => 'required',
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
            $candidates = Candidates::create([
                'id_selections' => $request->input('id_selections'),
                'name' => $request->input('name'),
                'visi' => $request->input('visi'),
                'misi' => $request->input('misi'),
                'photo' => $request->input('photo'),
            ]);

            if ($candidates) {
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
            'id_selections' => 'required',
            'name' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'photo' => 'required',
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
            $candidates = Candidates::findOrFail($id);
            $candidates->update([
                'id_selections' => $request->input('id_selections'),
                'name' => $request->input('name'),
                'visi' => $request->input('visi'),
                'misi' => $request->input('misi'),
                'photo' => $request->input('photo'),
            ]);

            if ($candidates) {
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Successfully updated candidate',
                        'data' => $candidates
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Failed to update candidate'
                    ],
                    401
                );
            }
        }
    }

    public function destroy(string $id)
    {
        $candidates = Candidates::findOrFail($id);
        $candidates->delete();

        if ($candidates) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Successfully deleted candidate'
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Failed to delete candidate'
                ],
                401
            );
        }
    }
}
