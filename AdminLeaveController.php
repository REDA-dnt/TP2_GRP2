<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminLeaveController extends Controller
{

    public function credit(Request $request, User $user)
    {
        $request->validate([
            'jours' => 'required|integer|min:1',
        ]);

        $user->solde_conges += $request->jours;
        $user->save();

        return response()->json([
            'message'       => 'Crédit ajouté avec succès',
            'nouveau_solde' => $user->solde_conges
        ]);
    }

    public function debit(Request $request, User $user)
    {
        $request->validate([
            'jours' => 'required|integer|min:1',
        ]);

        if ($request->jours > $user->solde_conges) {
            return response()->json([
                'error' => 'Solde insuffisant pour ce débit'
            ], 422);
        }

        $user->solde_conges -= $request->jours;
        $user->save();

        return response()->json([
            'message'       => 'Débit effectué avec succès',
            'nouveau_solde' => $user->solde_conges
        ]);
    }
}