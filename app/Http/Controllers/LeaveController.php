<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return response()->json([
            'solde_conges' => $user->solde_conges
        ]);
    }

    public function requestLeave(Request $request)
    {
        $request->validate([
            'jours' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $joursDemandes = $request->jours;

        if ($joursDemandes > $user->solde_conges) {
            return response()->json([
                'error' => 'Solde de congés insuffisant'
            ], 422);
        }

        $user->solde_conges -= $joursDemandes;
        $user->save();

        return response()->json([
            'message'      => 'Demande acceptée',
            'nouveau_solde' => $user->solde_conges
        ]);
    }
}