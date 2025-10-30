<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fly;
use Illuminate\Support\Facades\DB;

class flyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    
    {
        $flies=Fly::paginate(10);
      
        // //retorna também os parâmetros de busca na 
        // // paginação
        // // $pages=[];
        // // for($page=1; $page <= $flies->lastPage(); $page++){
        // //     $pages[]=$page;

        // // }

        // // pode retornar quantos likes e deslikes uma fly tem

        //  // usa query builder
         
        return view('flies.index', compact('flies'));
// $flies = DB::table('flies')
//     ->join('fly_votes', 'flies.id', '=', 'fly_votes.fly_id')
//     ->select(
//         'flies.id',
//         'flies.title',
//         'flies.description',  // Incluindo 'description'
//         'flies.created_at',
//         'flies.updated_at',
//         DB::raw('SUM(CASE WHEN fly_votes.type_vote = "like" THEN 1 ELSE 0 END) as likes_count'),
//         DB::raw('SUM(CASE WHEN fly_votes.type_vote = "dislike" THEN 1 ELSE 0 END) as dislikes_count')
//     )
//     ->groupBy('flies.id', 'flies.title', 'flies.description', 'flies.created_at', 'flies.updated_at')  // Incluindo todas as colunas
//     ->paginate(10);


        return view('flies.index', compact('flies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flies.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'category' => 'required|string',
        'status' => 'string', // opcional, se não enviado usaremos default
    ]);

    Fly::create([
        'title' => $request->title,
        'description' => $request->description,
        'category' => $request->category,
        'status' => $request->status ?? 'analysis',
        'user_id'=> auth()->id(),
    ]);

    return redirect()->route('flies.index')
        ->with('success', 'Fly created successfully.');
}

    public function show(Fly $fly)
    {
        return view('flies.show', compact('fly'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fly $fly)
    {
        return view('flies.edit', compact('fly'));
        if(!Fly::find($fly)){
            return redirect()->route('flies.index')
                ->with('error', 'Fly not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required | text',
            'category' => 'required|',
            'status' => 'required|enum:analysis,approved,rejected',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fly $fly)
    {
        $fly->delete();
        return redirect()->route('flies.index')
            ->with('success', 'Fly deleted successfully');
    }
}
