<div class="mt-6 ml-10 flex justify-center items-center space-x-4">
    <!-- Botão Curtir -->
    <button
        wire:click="like"
        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-600 transition"
    >
        Curtir
    </button>   

    <!-- Botão Ver mais centralizado -->
    <a href="{{ route('flies.show', $fly, false) }}" 
       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-lg shadow hover:bg-green-600 focus:ring-2 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition">
        Ver mais
    </a>

    <!-- Botão Descurtir -->
    <button
        wire:click="unlike"
        class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-lg shadow hover:bg-red-600 transition"
    >
        Descurtir
    </button>
</div>
