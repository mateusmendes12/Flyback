@php
     $rotaAtual = Route::currentRouteName();
@endphp

@if (Str::startsWith($rotaAtual, 'flies.') && !Str::startsWith($rotaAtual, 'flies.index'))
     <a href="{{ route('flies.index', [], false) }}" class="block py-2 px-3 hover:text-green-600">Flies</a>
    
@endif
