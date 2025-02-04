<x-app-layout>
    <br>
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-slate-700 mb-6">Agregar nuevo cliente</h2>
        <p class="text-lg text-slate-500 mb-4">Por favor, completa los siguientes campos para registrar un nuevo cliente.
        </p>

        <form action="{{route('clientes.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="space-y-6">

                <input type="text" name="site_id" value="{{$id}}" id="" hidden>
                <!-- Nombre y Apellidos -->
                <div class="block text-lg font-medium text-slate-700">
                    <div class="col-span-1">
                        <label for="nombre" class="block text-lg font-medium text-slate-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre del cliente"
                            class="mt-2 w-full p-4 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label for="no_cliente" class="block text-lg font-medium text-slate-700">NO. Cliente</label>
                        <input type="text" name="no_cliente" id="no_cliente"
                            value="{{ old('no_cliente', $noClienteSiguiente) }}" placeholder="NO. Cliente"
                            class="mt-2 w-full p-4 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>



                    <div class="col-span-1">
                        <label for="pago" class="block text-lg font-medium text-slate-700">Pago</label>
                        <input type="text" name="pago" id="pago" placeholder="Pago"
                            class="mt-2 w-full p-4 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                </div>

                <div class="col-span-1">
                    <label for="ip_cliente" class="block text-lg font-medium text-slate-700">IP Cliente</label>
                    <input type="text" name="ip_cliente" id="ip_cliente"
                        value="{{ old('ip_cliente', $siguienteIp) }}" placeholder="IP Cliente"
                        class="mt-2 w-full p-4 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>

                <!-- Fechas: Instalación, Facturación y Corte -->
                <div class="col-span-1">
                    <div class="col-span-1">
                        <label for="fecha_pago" class="block text-lg font-medium text-slate-700">Fecha de pago</label>
                        <input type="date" name="fecha_pago" id="fecha_pago"
                            class="mt-2 w-full p-4 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                            required>
                    </div>
                </div>


                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
