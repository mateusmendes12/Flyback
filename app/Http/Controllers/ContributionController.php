<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function store(Request $request, $flyId)
        {
             $request->validate([
            'content' => 'required|string',
        ]);

        Fly::findOrFail($flyId); // garante que o Fly exista

        $contribution = Contribution::create([
            'fly_id' => $flyId,
            'user_id' => auth()->id(), // usuário autenticado
            'content' => $request->message
        ]);

        return response()->json([
            'content' => 'Contribuição criada com sucesso!',
            'data' => $contribution
        ]);
    }

    public function update(Request $request, $contributionId)
    {
        // Validate and update the specified contribution
            $request->validate([
                'content' => 'required|string',
            ]);
            // Lógica para atualizar a contribuição com ID $contributionId

    }

    public function destroy($contributionId)
    {
        // Delete the specified contribution
        Contributtion::findOrFail($contributionId)->delete();
    }
}
