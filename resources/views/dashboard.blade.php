<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://kit.fontawesome.com/b2f358b760.js" crossorigin="anonymous"></script>
    <div>
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50  dark:text-green-400" role="alert">
                <span class="font-medium">¡Éxito!</span> {{ session('success') }}
            </div>
        @endif
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700">
            </h2>
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($sites as $site)
                    <a href="{{ route('clientes.index', $site->id) }}">
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
                            <!-- Ícono inicial (a la izquierda) -->
                            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                            <!-- Contenido central -->
                            <div class="flex-1">
                                <p class="mb-2 text-sm font-medium text-green-600">
                                    Online
                                </p>
                                <p class="text-lg font-semibold text-gray-700">
                                    {{ $site->nombre }}
                                </p>
                            </div>
                            <!-- Ícono a la derecha -->
                            <div class="p-2 text-green-500 bg-green-100 rounded-full">
                                <form action="{{ route('mikrotik') }}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <button type="submit" class="block">
                                        <input type="text" name="site_id" value="{{ $site->id }}" hidden>
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path fill="green"
                                                d="M256 64l128 0 0 64-128 0 0-64zM240 0c-26.5 0-48 21.5-48 48l0 96c0 26.5 21.5 48 48 48l48 0 0 32L32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l96 0 0 32-48 0c-26.5 0-48 21.5-48 48l0 96c0 26.5 21.5 48 48 48l160 0c26.5 0 48-21.5 48-48l0-96c0-26.5-21.5-48-48-48l-48 0 0-32 256 0 0 32-48 0c-26.5 0-48 21.5-48 48l0 96c0 26.5 21.5 48 48 48l160 0c26.5 0 48-21.5 48-48l0-96c0-26.5-21.5-48-48-48l-48 0 0-32 96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-256 0 0-32 48 0c26.5 0 48-21.5 48-48l0-96c0-26.5-21.5-48-48-48L240 0zM96 448l0-64 128 0 0 64L96 448zm320-64l128 0 0 64-128 0 0-64z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
</x-app-layout>
