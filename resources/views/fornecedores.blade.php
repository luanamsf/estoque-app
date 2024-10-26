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
            /* Verde */
            color: white !important;
            border: none !important;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .custom-btn-ok:hover {
            background-color: #45a049 !important;
            /* Verde mais escuro ao passar o mouse */
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Fornecedores') }}
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
            <div class="max-w-7xl mx-auto sm:px-12 lg:px-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="font-semibold text-xl mb-4">{{ __('Cadastrar fornecedor') }}</h2>
                        <button onclick="toggleCollapsible()" class="bg-blue-500 hover:bg-blue-700 text-gray font-bold py-4 px-4 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                            </svg>
                        </button>
                        <div id="collapsible-section" class="collapsible-content">
                            <form method="POST" action="{{ route('fornecedor.criaFornecedor') }}">
                                @csrf
                                <table width="100%" align="center">
                                    <tr>
                                        <th align="left">Nome Fantasia</th>
                                        <th colspan="2" align="left">Razão Social</th>
                                    </tr>
                                    <tr>
                                        <th><input type="text" name="nomeFantasia" id="nomeFantasia" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus" required></th>
                                        <th colspan="2"><input type="text" name="razaoSocial" id="razaoSocial" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
                                    </tr>
                                    <tr>
                                        <th align="left">CNPJ</th>
                                        <th align="left">Telefone</th>
                                        <th align="left">E-mail</th>
                                    </tr>
                                    <th><input type="text" name="cnpj" id="cnpj" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="00.000.000/0000-00" oninput="this.value = formatCnpjCpf(this.value)" autofocus="autofocus"></th>
                                    <th><input type="text" name="telefone" id="telefone" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="61 99999-9999" autofocus="autofocus"></th>
                                    <th><input type="text" name="email" id="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
                                    </tr>
                                    <tr>
                                        <th align="left">Observação</th>
                                        <th align="left">Margem(%)</th>
                                        <th align="left">Prazo(dias)</th>
                                    </tr>
                                    <tr>
                                        <th><input type="text" name="observacao" id="observacao" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
                                        <th><input type="text" name="margem" id="margem" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
                                        <th><input type="text" name="prazoPagamento" id="prazoPagamento" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" autofocus="autofocus"></th>
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
            <div class="max-w-7xl mx-auto sm:px-12 lg:px-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="font-semibold text-xl mb-4">Fornecedores</h2>
                        @if ($fornecedores->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome Fantasia</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Razão Social</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CNPJ</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-mail</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Margem</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prazo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observação</th>
                                    <!-- Adicione mais colunas para outros campos aqui -->
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($fornecedores as $fornecedor)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->nomeFantasia }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->razaoSocial }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->cnpj }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->telefone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->margem }} {{ __('%') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->prazoPagamento }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fornecedor->observacao }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Nenhum fornecedor cadastrado.</p>
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

        function formatCnpjCpf(value) {
            const CPF_LENGTH = 11;
            const cnpjCpf = value.replace(/\D/g, '');

            if (cnpjCpf.length === CPF_LENGTH) {
                return cnpjCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
            }

            return cnpjCpf.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
        }
    </script>
</body>