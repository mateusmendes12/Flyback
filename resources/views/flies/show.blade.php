@extends('layouts.main')

@section('title', 'Detalhes da Fly')

@section('content')
<div>
    <!-- Botão Contribuir no Canto Superior Direito -->
   <a href="{{ route('contributions.create', $fly) }}" class="fixed top-4 right-4 px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 z-50">
        Contribuir
    </a>
    <!-- Detalhes da Fly -->
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-xl shadow-lg mt-10">
        <h1 class="text-3xl font-extrabold mb-4 text-green-600 text-center">{{ $fly->title }}</h1>
        <p class="text-gray-700 mb-6">{{ $fly->description }}</p>
        <p class="text-sm text-gray-500">Criado em: {{ $fly->created_at->format('d/m/Y H:i') }}</p>
        
        <!-- Botão de Edição (apenas se o usuário for o criador da Fly) -->
        @if (auth()->check() && auth()->user()->id === $fly->user_id)
            <x-fly-edit :fly="$fly" />
        @endif
    </div>

    <!-- Comentários dos Contribuintes -->
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-xl shadow-lg mt-10">
        <h2 class="text-2xl font-bold mb-4 text-green-600 text-center">Comentários dos Contribuintes</h2>
        
        @if($contributions->count() > 0)
            <ul class="space-y-4">
                @foreach($contributions as $contribution)
                    <li class="border border-gray-300 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $contribution->title }}</h3>
                        <p class="text-gray-700 mt-2">{{ $contribution->description }}</p>
                        <p class="text-sm text-gray-500 mt-2">Comentado em: {{ $contribution->created_at->format('d/m/Y H:i') }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 text-center">Nenhum comentário disponível para esta Fly.</p>
        @endif
    </div>
</div>
@endsection
