<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fly;

class FlyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lista flies com contagem de likes e dislikes
        $flies = Fly::withCount([
            'votes as likes_count' => function ($query) {
                $query->where('type_vote', 'like');
            },
            'votes as dislikes_count' => function ($query) {
                $query->where('type_vote', 'dislike');
            }
        ])->orderBy('likes_count', 'desc')->get();

        return view('flies.index', compact('flies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'string', 
            'departament_id' => 'required|exists:departaments,id',
        ]);

        Fly::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'analysis',
            'user_id'=> auth()->id(),
            'departament_id' => $request->departament_id,
        ]);

        return redirect()->route('flies.index')
            ->with('success', 'Fly created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fly $fly)
    {
        // Carrega a contagem de votos para esta fly
        $fly->loadCount([
            'votes as likes_count' => function ($query) {
                $query->where('type_vote', 'like');
            },
            'votes as dislikes_count' => function ($query) {
                $query->where('type_vote', 'dislike');
            }
        ]);

        return view('flies.show', compact('fly'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fly $fly)
    {
        return view('flies.edit', compact('fly'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fly $fly)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:analysis,approved,rejected',
            'departament_id' => 'required|exists:departaments,id',
        ]);

        $fly->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'departament_id' => $request->departament_id,
        ]);

        return redirect()->route('flies.index')
            ->with('success', 'Fly updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fly $fly)
    {
        $fly->delete();

        return redirect()->route('flies.index')
            ->with('success', 'Fly deleted successfully.');
    }
}
