<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro de Produtos') }}
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
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('produto.store') }}">
                        @csrf
                        <table width="90%" align="center">
                            <tr>
                                <th align="left" colspan="2">Produto</th>
                                <th align="left">Código</th>
                            </tr>
                            <tr>
                                <th colspan="2"><input type="text" name="produto" id="produto" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></th>
                                <th><input type="text" name="codigo" id="codigo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></th>
                            </tr>
                            <tr>
                                <th align="left">Tipo</th>
                                <th align="left">Marca</th>
                                <th align="left">Unidade</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="tipo" id="tipo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></th>
                                <th>
                                <select name="fornecedor_id" id="fornecedor_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione uma marca</option>
                                        @foreach($FornecedoresId as $fornecedor)
                                        <option value="{{ $fornecedor->id }}">{{ $fornecedor->nomeFantasia }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th><input type="text" name="unidade" id="unidade" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></th>
                            </tr>
                            <tr>
                                <th align="left">Preço de Custo</th>
                                <th align="left">Valor de Venda</th>
                                <th align="left">Quantidade</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="valorCusto" id="valorCusto" placeholder="0,00" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></th>
                                <th><input type="text" name="valorVenda" id="valorVenda" placeholder="0,00" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></th>
                                <th><input type="number" name="quantidade" id="quantidade" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></th>
                            </tr>
                            <tr>
                                <th align="left">Disponível</th>
                            </tr>
                            <tr>
                                <th>
                                    <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </th>
                            </tr>
                        </table>
                        <br>
                        <div class="mb-4">
                            <x-primary-button type="submit" class="btn btn-primary">Salvar</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>