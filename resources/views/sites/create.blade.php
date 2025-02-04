<x-app-layout>
    <br>
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-slate-700 mb-6">Agregar nuevo site</h2>
        <p class="text-lg text-slate-500 mb-4">Un site es una ubicación estratégica destinada a la distribución del servicio.</p>

        <form action="{{route('sites.store')}}" method="POST" class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf
            @method('POST')
            <div class="space-y-6">
                <div>
                    <label for="nombre" class="block text-lg font-medium text-slate-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="El Saucito" 
                           class="mt-2 w-full p-4 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition-colors" 
                           required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" 
                            class="w-full sm:w-auto px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
        
</x-app-layout>
