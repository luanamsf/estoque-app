<!-- TODO: ACRESCENTAR A ROTINA DE EXCLUSÃO DE PRODUTOS CASO NÃO EXISTA MOVIMENTAÇÃO EM ESTOQUE -->
<!-- TODO: ACRESCENTAR CAMPO DE STATUS (ATIVO E INATIVO) QUANDO O PRODUTO DEIXA DE SER COMERCIALIZADO, MAS QUE TEM MOVIMENTAÇÃO ANTERIOR NO ESTOQUE. -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estoque') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($produtos->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produto</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pç. Custo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vl. Venda</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qtde</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                                <!-- Adicione mais colunas para outros campos aqui -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($produtos as $produto)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->produto }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->codigo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->tipo->descricao_tipo }}</td>
                                @if ($produto->fornecedor)
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->fornecedor->nomeFantasia }}</td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap">--</td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->valorCusto }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->valorVenda }}</td>
                                @if ( $produto->quantidade === "0")
                                <td class="px-6 py-4 whitespace-nowrap text-red-600">{{ $produto->quantidade }}</td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->quantidade }}</td>
                                @endif
                                @if ( $produto->quantidade === "0")
                                <td class="px-6 py-4 whitespace-nowrap text-red-600">Indisponível</td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap text-green-600">Disponível</td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('produto.edit', $produto->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>Nenhum produto cadastrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>