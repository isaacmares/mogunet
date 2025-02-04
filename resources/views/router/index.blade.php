<x-app-layout>

    @if (session('success'))
    <br>
    <div class="p-4 mb-8 text-sm text-green-800 rounded-lg bg-green-50 dark:text-green-400" role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif


    @if (session('error'))
    <br>
    <div class="p-4 mb-8 text-sm text-green-800 rounded-lg bg-green-50 dark:text-green-400" role="alert">
        <span class="font-medium">{{ session('error') }}</span>
    </div>
    @endif
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>

    <div class="bg-gray-100 font-sans">
        <div class="container mx-auto p-4">
            <h1 class="text-3xl font-bold text-center mb-8">Monitor de Conexiones <div class="flex justify-center mt-4">
                    <button data-modal-target="agregar_router" data-modal-toggle="agregar_router"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Agregar router
                    </button>
                </div>
            </h1>

            @if ($mikrotiks->isEmpty())
            <p class="text-center text-red-500">No hay MikroTiks disponibles.</p>
            <!-- Main modal -->

            @else
            <!-- Tabla de MikroTik -->
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">IP</th>
                        <th class="border border-gray-300 px-4 py-2">Puerto</th>
                        <th class="border border-gray-300 px-4 py-2">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mikrotiks as $mikrotik)
                    <tr class="bg-white">
                        <td class="border border-gray-300 px-4 py-2">{{ $mikrotik->ip }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $mikrotik->puerto }}</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold 
                                    {{ $mikrotik->status == 'En línea' ? 'text-green-500' : 'text-red-500' }}">
                            {{ $mikrotik->status }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Contenedor principal con dos columnas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                @foreach ($mikrotiks as $mikrotik)
                <!-- Tarjeta de Información del MikroTik -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Información del MikroTik</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600">Nombre del MikroTik:</p>
                            <p class="font-bold">{{ $mikrotik->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">IP del MikroTik:</p>
                            <p class="font-bold">{{ $mikrotik->ip }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Puerto:</p>
                            <p class="font-bold">{{ $mikrotik->puerto }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Estado de la Conexión:</p>
                            <p
                                class="font-bold {{ $mikrotik->status == 'En línea' ? 'text-green-500' : 'text-red-500' }}">
                                {{ $mikrotik->status }}
                            </p>
                            <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                Conexión Mikrotik
                            </button>
                            <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Conexión Mikrotik
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="static-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Conexión Mikrotik </span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <div
                                                class="w-full p-3 border border-gray-300 rounded-md bg-gray-900 text-white font-mono text-sm overflow-auto">
                                                <pre><code class="whitespace-pre-wrap">/interface ovpn-client remove [find where name~"{{ $mikrotik->nombre }}-SaturnoVPN"];
/interface ovpn-client add comment="{{ $mikrotik->nombre }}-SaturnoVPN" connect-to="mogunet.gdcwisp.com" name="{{ $mikrotik->nombre }}" user="{{ $mikrotik->nombre }}" password="MOGU_3456TIK" disabled=no cipher=blowfish128 port=1194;</code></pre>
                                            </div>

                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button data-modal-hide="static-modal" type="button"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                                Aceptar</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            @endif
        </div>
    </div>

    <div id="agregar_router" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm white:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t white:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 white:text-white">
                        Agregar router en {{ $site->nombre }}
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="agregar_router">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('mikrotik.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <label for="nombre"
                                class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Nombre
                                del router</label>
                                <input type="text" name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark"
                                placeholder="Fibra óptica" required 
                                pattern="[A-Za-z0-9]+" 
                                oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '')"
                            />  
                            <br>
                            <label for="user"
                            class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Usuario
                            del router</label>
                            <input type="text" name="user" id="user"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark"
                                placeholder="Usuario" required 
                                pattern="[A-Za-z0-9]+" 
                                oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '')"
                            />        
                            <br>  
                            <label for="pass"
                            class="block mb-2 text-sm font-medium text-gray-900 white:text-white">Contraseña
                            del router</label>
                            <input type="text" name="pass" id="pass"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark"
                                placeholder="Contraseña" required 
                                pattern="[A-Za-z0-9]+" 
                                oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '')"
                            />                                    
                        </div>
                        <input type="text" name="id_site" hidden value="{{ $site->id }}">
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>