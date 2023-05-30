<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voter;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VotingController extends Controller
{
    public function validateVoting(Request $request)
    {
        $validateData = $request->validate([
            'id_users' => 'required',
            'id_selections' => 'required',
            'is_voted' => 'required',
        ]);

        $voter = Voter::where('id_users', $validateData['id_users'])
            ->where('id_selections', $validateData['id_selections'])
            ->where('is_voted', $validateData['is_voted'])
            ->with(['user' => function ($query) {
                $query->select('id', 'username', 'email', 'NIS/NIP');
            }])
            ->get()
            ->makeHidden(['id', 'created_at', 'updated_at']);

        return response()->json([
            'success' => true,
            'message' => 'Data valid',
            'data' => $voter,
        ], 200);
    }

    public function countVoting()
    {
        $voters = Voter::where('is_voted', 'voted')
            ->with(['user' => function ($query) {
                $query->select('id', 'username', 'email', 'NIS/NIP');
            }])
            ->get()
            ->makeHidden(['id', 'created_at', 'id_users', 'updated_at', 'id_selections']);

        return response([
            'success' => true,
            'message' => 'List semua data seleksi yang aktif',
            'data' => $voters,
        ], 200);
    }

    public function uncountVoting()
    {
        $voters = Voter::where('is_voted', 'not voted')
            ->with(['user' => function ($query) {
                $query->select('id', 'username', 'email', 'NIS/NIP');
            }])
            ->get()
            ->makeHidden(['id', 'created_at', 'id_users', 'updated_at', 'id_selections']);

        return response([
            'success' => true,
            'message' => 'List semua data seleksi yang tidak aktif',
            'data' => $voters,
        ], 200);
    }

    public function votingHistory()
    {
        try {
            // Mendapatkan data pemilih
            $voter = Voter::where('is_voted', 'voted')
                ->with('selection')
                ->get()
                ->makeHidden(['id', 'created_at', 'updated_at']);

            // Logging riwayat pemilihan
            Log::info('Voting history', ['voter' => $voter]);

            return response([
                'success' => true,
                'message' => 'List semua data seleksi yang aktif',
                'data' => $voter,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Voting history', ['error' => $e->getMessage()]);

            return response([
                'success' => false,
                'message' => 'Gagal mendapatkan data pemilih',
                'data' => null,
            ], 500);
        }
    }

    public function statistic()
    {
        $totalPemilih = Voter::count();
        $totalPemilihTidakMemilih = Voter::where('is_voted', 'not voted')->count();
        $totalPemilihMemilih = Voter::where('is_voted', 'voted')->count();
        $persentasePemilih = ($totalPemilihMemilih / $totalPemilih) * 100;

        return response()->json([
            'total_pemilih' => $totalPemilih,
            'total_pemilih_tidak_memilih' => $totalPemilihTidakMemilih,
            'total_pemilih_memilih' => $totalPemilihMemilih,
            'persentase_pemilih' => $persentasePemilih . '%',
        ]);
    }
}
