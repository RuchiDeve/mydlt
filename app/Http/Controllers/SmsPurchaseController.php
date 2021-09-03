<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SmsPurchaseController extends Controller
{
    public function purchaseSms(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $request->validate([
            'proof' => 'required|file|max:1024'
        ]);

        $proof = $request->file('proof');
        $proof_path = $proof->store('uploads/proofs');

        $user->smsPurchases()->create([
            'payment_proof' => $proof_path,
            'units' => $request->get('units')
        ]);

        return back();
    }
}
