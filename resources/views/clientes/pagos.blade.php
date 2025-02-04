<x-app-layout>
    <!-- component -->
    <div class="max-w-[1280px] mx-auto">
        <br>
        <div class="relative flex flex-col w-full h-full overflow-hidden text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            <div class="flex flex-col md:flex-row space-x-0 md:space-x-6 p-4">
                <!-- Información del cliente (izquierda) -->
                <div class="w-full md:w-1/2 space-y-4 mb-6 md:mb-0">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Información del Cliente</h3>
                    
                    <div class="space-y-3">
                        <!-- Nombre del cliente -->
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                            <p class="text-lg text-gray-700"><strong>Nombre:</strong> {{$cliente->nombre}} {{$cliente->apellidos}}</p>
                        </div>
 
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                            <p class="text-lg text-gray-700"><strong>NO Cliente:</strong> {{$cliente->no_cliente}} </p>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                            <p class="text-lg text-gray-700"><strong>IP:</strong> {{$cliente->ip}} </p>
                        </div>
                    </div>
                </div>
                
                <!-- Tabla de pagos (derecha) -->
                <div class="w-full md:w-1/2 overflow-y-auto max-h-96">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Historial de Pagos</h3>
                    <table class="w-full text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-200 bg-slate-50">
                                    <p class="text-sm font-normal leading-none text-slate-500">
                                        Numero de factura
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-50">
                                    <p class="text-sm font-normal leading-none text-slate-500">
                                        Cliente
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-50">
                                    <p class="text-sm font-normal leading-none text-slate-500">
                                        Pago
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-50">
                                    <p class="text-sm font-normal leading-none text-slate-500">
                                        Dia de pago
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-50">
                                    <p class="text-sm font-normal leading-none text-slate-500">
                                        Metodo de pago
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pago)
                            <tr class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">MOG{{$pago->id}}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{$cliente->nombre}} {{$cliente->apellidos}}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">${{$pago->amount}}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{ $pago->payment_date }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{ $pago->payment_method }}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
</x-app-layout>
