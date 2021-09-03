<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;

class DomainPurchaseController extends Controller
{
    public function purchaseDomain(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $request->validate([
           'proof' => 'required|file|max:1024'
        ]);

        $proof = $request->file('proof');
        $proof_path = $proof->store('uploads/proofs');

        $user->domainSubscriptions()->create([
            'payment_proof' => $proof_path,
            'amount' => Settings::getDomainRate()
        ]);

        return back();
    }

}
