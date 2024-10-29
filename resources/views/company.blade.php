<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .collapsible-content {
            display: none;
        }

        .icon-default {
            fill: currentColor;
        }

        .bi-building-add:hover {
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
                {{ __('Informações da Empresa') }}
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
                    
                        <form method="POST" action="{{ route('company.save') }}">
                            @csrf
                            <table width="90%" align="center">
                                <tr>
                                    <th align="left">CNPJ</th>
                                    <th colspan="3" align="left">Razão Social</th>
                                </tr>
                                <tr>
                                    <th>
                                        <input type="text" name="cnpj" id="cnpj" 
                                               value="{{ $company->cnpj ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    </th>
                                    <th colspan="3">
                                        <input type="text" name="razaoSocial" id="razaoSocial" 
                                               value="{{ $company->razaoSocial ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    </th>
                                </tr>

                                <tr>
                                    <th align="left">Inscrição Estadual</th>
                                    <th colspan="3" align="left">Fantasia</th>
                                </tr>
                                <tr>
                                    <th>
                                        <input type="text" name="InscEstadual" id="InscEstadual" 
                                               value="{{ $company->inscricaoEstadual ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                    <th colspan="3">
                                        <input type="text" name="fantasia" id="fantasia" 
                                               value="{{ $company->fantasia ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                </tr>

                                <tr>
                                    <th colspan="2" align="left">Tipo da Empresa</th>
                                    <th colspan="2" align="left">Segmento</th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <select name="tipo" id="tipo" 
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                            <option value="">Selecione uma opção</option>
                                            <option value="ME" {{ (isset($company) && $company->tipo == 'ME') ? 'selected' : '' }}>Microempresa (ME)</option>
                                            <option value="EPP" {{ (isset($company) && $company->tipo == 'EPP') ? 'selected' : '' }}>Empresa de Pequeno Porte (EPP)</option>
                                            <option value="MEI" {{ (isset($company) && $company->tipo == 'MEI') ? 'selected' : '' }}>Microempreendedor Individual (MEI)</option>
                                            <option value="LTDA" {{ (isset($company) && $company->tipo == 'LTDA') ? 'selected' : '' }}>Sociedade Limitada (LTDA)</option>
                                            <option value="SA" {{ (isset($company) && $company->tipo == 'SA') ? 'selected' : '' }}>Sociedade Anônima (SA)</option>
                                        </select>
                                    </th>
                                    <th colspan="2">
                                        <input type="text" name="segmento" id="segmento" 
                                               value="{{ $company->segmento ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                </tr>

                                <tr>
                                    <th colspan="2" align="left">E-mail</th>
                                    <th align="left">Telefone</th>
                                    <th align="left">Website</th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <input type="email" name="email" id="email" 
                                               value="{{ $company->email ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                    <th>
                                        <input type="text" name="telefone" id="telefone" 
                                               value="{{ $company->telefone ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                    <th>
                                        <input type="text" name="website" id="website" 
                                               value="{{ $company->website ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                </tr>

                                <tr>
                                    <th colspan="4" align="left">Endereço</th>
                                </tr>
                                <tr>
                                    <th colspan="4">
                                        <input type="text" name="endereco" id="endereco" 
                                               value="{{ $company->endereco ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                </tr>

                                <tr>
                                    <th align="left">Bairro</th>
                                    <th align="left">Cidade</th>
                                    <th align="left">UF</th>
                                    <th align="left">CEP</th>
                                </tr>
                                <tr>
                                    <th>
                                        <input type="text" name="bairro" id="bairro" 
                                               value="{{ $company->bairro ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                    <th>
                                        <input type="text" name="cidade" id="cidade" 
                                               value="{{ $company->cidade ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                    <th>
                                        <input type="text" name="uf" id="uf" 
                                               value="{{ $company->uf ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                    <th>
                                        <input type="text" name="cep" id="cep" 
                                               value="{{ $company->cep ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                </tr>

                                <tr>
                                    <th colspan="2" align="left">Nome do Responsável</th>
                                    <th align="left">E-mail do Responsável</th>
                                    <th align="left">Telefone do Responsável</th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <input type="text" name="nomeResponsavel" id="nomeResponsavel" 
                                               value="{{ $company->nomeResponsavel ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                    <th>
                                        <input type="text" name="emailResponsavel" id="emailResponsavel" 
                                               value="{{ $company->emailResponsavel ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                    <th>
                                        <input type="text" name="telefoneResponsavel" id="telefoneResponsavel" 
                                               value="{{ $company->telefoneResponsavel ?? '' }}" 
                                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    </th>
                                </tr>
                            </table>

                            <div class="mb-4 mt-4" align="center">
                                <x-primary-button type="submit" class="btn btn-primary">Salvar</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
