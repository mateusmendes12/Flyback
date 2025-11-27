<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContributionController extends Controller
{
    
    public function store(Request $request, $flyId)
    {
        // Validate and store the new contribution for the specified fly
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    }

    public function update(Request $request, $contributionId)
    {
        // Validate and update the specified contribution
    }

    public function destroy($contributionId)
    {
        // Delete the specified contribution
    }
}
