<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    
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
    <script src="https://kit.fontawesome.com/b2f358b760.js" crossorigin="anonymous"></script>
    <div class="max-w-[1280px] mx-auto">
        <div class="block mb-4 mx-auto border-slate-300 pb-2 max-w-[360px]"></div>
        <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Clientes</h3>
                        <p class="text-slate-500">Aquí están todos tus clientes!</p>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                        <input type="text" id="search-input" class="w-full p-2 border border-slate-300 rounded-lg"
                            placeholder="Buscar por nombre o no. cliente..." onkeyup="filterTable()" />
                        <a href="{{ route('clientes.create', $id) }}"
                            class="flex select-none items-center gap-2 rounded bg-slate-800 py-2.5 px-4 text-xs font-semibold text-white shadow-md shadow-slate-900/10 transition-all hover:shadow-lg hover:shadow-slate-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true" stroke-width="2" class="w-4 h-4">
                                <path
                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                </path>
                            </svg>
                            Agregar cliente
                        </a>
                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            Importar
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Importar Clientes
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="default-modal" aria-label="Close">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4">
                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            Por favor, ten todos tus clientes bien organizados y asegúrate de que todos
                                            sus datos estén correctamente escritos.
                                        </p>
                                        <form action="{{ route('clientes.import') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="space-y-4">
                                                <label for="file"
                                                    class="block text-lg font-medium text-slate-700">Selecciona un
                                                    archivo para importar</label>
                                                <input type="file" name="file" id="file"
                                                    class="mt-2 w-full p-4 border border-slate-300 rounded-lg" required>
                                                <input type="hidden" name="site_id" value="{{ $id }}">
                                            </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit"
                                            class="mt-4 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700">
                                            Importar
                                        </button>
                                        <button type="button"
                                            class="ml-4 mt-4 px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600"
                                            data-modal-hide="default-modal">
                                            Cancelar
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>






                    </div>
                </div>
            </div>


            <div class="p-0 overflow-x-auto">
                <!-- Contenedor con scroll -->
                <div class="overflow-y-auto" style="max-height: 400px;">
                    <table id="clientes-table" class="w-full mt-4 text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th
                                    class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                                    <p
                                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                                        Nombre completo</p>
                                </th>
                                <th
                                    class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                                    <p
                                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                                        NO.Cliente</p>
                                </th>
                                <th
                                    class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                                    <p
                                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                                        Día de facturación</p>
                                </th>
                                <th
                                    class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                                    <p
                                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                                        Pago</p>
                                </th>
                                <th
                                    class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                                    <p
                                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                                        ip</p>
                                </th>
                                <th
                                    class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                                    <p
                                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                                        Pago</p>
                                </th>
                                <th
                                    class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                                    <p
                                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                                        Pagar</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="p-4 border-b border-slate-200">
                                        <div class="flex items-center gap-3">

                                            <a href="{{ route('clientes.pagos', $cliente->id) }}">
                                                <div class="flex flex-col">
                                                    <p class="text-sm font-semibold text-slate-700">
                                                        {{ $cliente->nombre }} </p>
                                                    <p class="text-sm text-slate-500"><a target="_blank"
                                                            href="http://{{ $cliente->ip }}">{{ $cliente->ip }}</a>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </td>

                                    <td class="p-4 border-b border-slate-200">
                                        <p class="text-sm text-slate-500">{{ $cliente->no_cliente }}</p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="text-sm text-slate-500">{{ $cliente->fecha_pago }}</p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="text-sm text-slate-500">{{ $cliente->pago }}</p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="text-sm text-slate-500">{{ $cliente->ip }}</p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="text-sm text-slate-500">{{ $cliente->pago }}</p>
                                    </td>

                                    <td class="p-4 border-b border-slate-200">
                                        <button id="open-payment-modal-{{ $cliente->id }}"
                                            class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-slate-900 transition-all hover:bg-slate-900/10 active:bg-slate-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="button">
                                            <span
                                                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                <i class="fa-solid fa-dollar-sign fa-xl"></i>
                                            </span>
                                        </button>
                                        <div
                                            id="payment-modal-{{ $cliente->id }}"class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
                                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                                <h3 class="text-lg font-semibold text-slate-800 mb-4">Registrar Pago
                                                </h3>

                                                <form action="{{ route('clientes.pago') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="text" name="id_cliente" value="{{$cliente->id}}" hidden id="">
                                                    <div class="mb-4">
                                                        <label for="amount"
                                                            class="block text-sm text-slate-700">Monto</label>
                                                        <input type="number" id="amount" name="amount"
                                                            class="w-full p-2 border border-slate-300 rounded mt-1"
                                                            required>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="payment_date"
                                                            class="block text-sm text-slate-700">Fecha de pago</label>
                                                        <input type="date" id="payment_date" name="payment_date"
                                                            class="w-full p-2 border border-slate-300 rounded mt-1"
                                                            required>
                                                        <script>
                                                            const today = new Date().toISOString().split('T')[0];
                                                            document.getElementB yId('payment_date').value = today;
                                                        </script>
                                                    </div>



                                                    <div class="mb-4">
                                                        <label for="payment_method"
                                                            class="block text-sm text-slate-700">Método de pago</label>
                                                        <select id="payment_method" name="payment_method"
                                                            class="w-full p-2 border border-slate-300 rounded mt-1"
                                                            required>
                                                            <option value="efectivo">Efectivo</option>
                                                            <option value="transferencia">Transferencia</option>
                                                        </select>
                                                    </div>


                                                    <div class="flex justify-end gap-2">
                                                        <button type="submit"
                                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Registrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="flex items-center justify-between p-3">
                <p class="block text-sm text-slate-500">Página {{ $clientes->currentPage() }} de
                    {{ $clientes->lastPage() }}</p>
                <div class="flex gap-1">
                    {{ $clientes->links('pagination::tailwind') }}
                </div>
            </div>

        </div>
    </div>

    <script>
        // Función para abrir el modal
        document.querySelectorAll('[id^="open-payment-modal-"]').forEach(button => {
            button.addEventListener('click', () => {
                const clienteId = button.id.split('-')[3]; // Obtener el cliente ID
                const modal = document.getElementById('payment-modal-' +
                clienteId); // Obtener el modal correspondiente
                modal.classList.remove('hidden'); // Mostrar el modal
            });
        });

        // Función para cerrar el modal
        document.querySelectorAll('[id^="close-payment-modal-"]').forEach(button => {
            button.addEventListener('click', () => {
                const clienteId = button.id.split('-')[3]; // Obtener el cliente ID
                const modal = document.getElementById('payment-modal-' +
                clienteId); // Obtener el modal correspondiente
                modal.classList.add('hidden'); // Ocultar el modal
            });
        });

        // Opcional: Cerrar el modal si el usuario hace clic fuera del modal
        window.addEventListener('click', (event) => {
            document.querySelectorAll('[id^="payment-modal-"]').forEach(modal => {
                if (event.target === modal) {
                    modal.classList.add('hidden'); // Ocultar el modal
                }
            });
        });


        function filterTable() {
            const input = document.getElementById('search-input');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('clientes-table');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) { // Empieza desde 1 para saltar la cabecera
                let cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(filter)) {
                        found = true;
                        break;
                    }
                }

                rows[i].style.display = found ? '' : 'none';
            }
        }
    </script>

</x-app-layout>
