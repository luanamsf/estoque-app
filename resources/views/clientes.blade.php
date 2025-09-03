<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .collapsible-content {
            display: none;
        }

        .icon-default {
            fill: currentColor;
        }

        .bi-person-add:hover {
            fill: darkgreen;
        }

        .custom-btn-ok {
            background-color: #4CAF50 !important;
            color: white !important;
            border: none !important;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .custom-btn-ok:hover {
            background-color: #45a049 !important;
            
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Clientes') }}
            </h2>
        </x-slot>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <script>
            console.log('Sessão detectada: {{ session("success") }}');
            Swal.fire({
                icon: 'success',
                title: 'Operação concluída!',
                text: '{{ session("success") }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'custom-btn-ok'
                }
            });
        </script>
        @endif
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="font-semibold text-xl mb-4">{{ __('Cadastrar cliente') }}</h2>
                        <button onclick="toggleCollapsible()" class="bg-blue-500 hover:bg-blue-700 text-gray font-bold py-4 px-4 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                            </svg>
                        </button>
                        <div id="collapsible-section" class="collapsible-content">
                            <form method="POST" action="{{ route('cliente.clients') }}">
                                @csrf
                                <table width="90%" align="center">
                                    <tr>
                                        <th colspan="4" align="left">Nome</th>
                                        <th align="left">CPF</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"><input type="text" name="nome" id="nome" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus" required></th>
                                        <th><input type="text" name="cpf" id="cpf" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="000.000.000-00" oninput="this.value = formatCnpjCpf(this.value)" autofocus="autofocus"></th>
                                    </tr>
                                    <tr>
                                        <th align="left">Telefone</th>
                                        <th align="left">E-mail</th>
                                        <th align="left">Aniversário</th>
                                    </tr>
                                    <th><input type="text" name="telefone" id="telefone" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="61 99999-9999" autofocus="autofocus"></th>
                                    <th colspan="2"><input type="email" name="email" id="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
                                    <th><input type="date" name="aniversario" id="aniversario" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="6" align="left">Endereço</th>
                                    </tr>
                                    <tr>
                                        <th colspan="6"><input type="text" name="endereco" id="endereco" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="6" align="left">Observação</th>
                                    </tr>
                                    <tr>
                                        <th colspan="6"><input type="text" name="observacao" id="observacao" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
                                    </tr>
                                </table>
                                <br>
                                <div class="mb-4" align="center">
                                    <x-primary-button type="submit" class="btn btn-primary">Salvar</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="font-semibold text-xl mb-4">Carteira de Clientes</h2>
                        @if ($clientes->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-mail</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Endereço</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aniversário</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observação</th>
                                    <!-- Adicione mais colunas para outros campos aqui -->
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->cpf }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->telefone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->endereco }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->aniversario }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->observacao }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Nenhum(a) cliente cadastrado(a).</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script>
        function toggleCollapsible() {
            var icon = document.querySelector('.bi-person-add');
            icon.classList.toggle('icon-active');
            var collapsible = document.getElementById('collapsible-section');
            if (collapsible.style.display === 'none') {
                collapsible.style.display = 'block';
            } else {
                collapsible.style.display = 'none';
            }
        }
    </script>
</body>