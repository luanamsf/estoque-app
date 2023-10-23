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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vl. Custo</th>
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
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produto->tipo }}</td>
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
                                @if ( $produto->status === "1")
                                <td class="px-6 py-4 whitespace-nowrap text-green-600">Disponível</td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap text-red-600">Indisponível</td>
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
<script>
    $(document).ready(function() {

        var margemPadrao = "";
        $('#margem').val(margemPadrao);

        $('#fornecedor_id').on('change', function() {
            var margemLucro = parseFloat($(this).find('option:selected').data('margem'));
            $('#margem').val(margemLucro);
        });

        $(document).ready(function() {
            $('#valorCusto').on('input', function() {
                var valorCusto = parseFloat($(this).val().replace(',', '.'));
                var margemLucro = parseFloat($('#margem').val());

                const moeda = {
                    style: 'currency',
                    currency: 'BRL',
                };

                const formatoMoeda = new Intl.NumberFormat('pt-BR', moeda);


                if (!isNaN(valorCusto) && !isNaN(margemLucro)) {
                    var margemLucro = ((100 - margemLucro) * 0.0100);
                    var valorVenda = formatoMoeda.format((valorCusto / margemLucro)); 
                    $('#valorVenda').val(valorVenda); 
                } else {
                    $('#valorVenda').val('');
                }
            });
        });
    });
</script>