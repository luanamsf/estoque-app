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
                            <th colspan="4"><input type="hidden" name="id" id="id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ isset($produto) ? old('produto', $produto->id) : old('id') }}" required></th>
                            </tr>
                            <tr>
                                <th align="left" colspan="3">Produto</th>
                                <th align="left">Código</th>
                            </tr>
                            <tr>
                                <th colspan="3"><input type="text" name="produto" id="produto" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ isset($produto) ? old('produto', $produto->produto) : old('produto') }}" required></th>
                                <th><input type="text" name="codigo" id="codigo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ isset($produto) ? old('produto', $produto->codigo) : old('codigo') }}" required></th>
                            </tr>
                            <tr>
                                <th align="left">Tipo</th>
                                <th align="left" colspan="2">Marca</th>
                                <th align="left">Unidade</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="tipo" id="tipo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ isset($produto) ? old('produto', $produto->tipo) : old('tipo') }}" required></th>
                                <th colspan="2">
                                    <select name="fornecedor_id" id="fornecedor_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione uma marca</option>
                                        @foreach($FornecedoresId as $fornecedor)
                                        <option value="{{ $fornecedor->id }}" data-margem="{{ $fornecedor->margem }}" {{ isset($produto) && $produto->fornecedor_id == $fornecedor->id ? 'selected' : '' }}>
                                            {{ $fornecedor->nomeFantasia }}
                                        </option>
                                        @endforeach
                                    </select>
                                </th>
                                <th><input type="text" name="unidade" id="unidade" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ isset($produto) ? old('produto', $produto->unidade) : old('unidade') }}" required></th>
                            </tr>
                            <tr>
                                <th align="left">Preço de Custo</th>
                                <th align="left">Margem(%)</th>
                                <th align="left">Valor de Venda</th>
                                <th align="left">Quantidade</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="valorCusto" id="valorCusto" placeholder="0,00" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ isset($produto) ? old('produto', $produto->valorCusto) : old('valorCusto') }}" required></th>
                                <th><input type="text" name="margem" id="margem" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ old('margem', isset($fornecedor) ? $fornecedor->margem : '') }}" readonly required></th>
                                <th><input type="text" name="valorVenda" id="valorVenda" placeholder="0,00" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full readonly" value="{{ isset($produto) ? old('produto', $produto->valorVenda) : old('valorVenda') }}" readonly required></th>
                                <th><input type="number" name="quantidade" id="quantidade" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ isset($produto) ? old('produto', $produto->quantidade) : old('quantidade') }}" required></th>
                            </tr>
                            <tr>
                                <th align="left">Disponível</th>
                            </tr>
                            <tr>
                                <th>
                                    <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ isset($produto) ? old('produto', $produto->status) : old('status') }}" required>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </th>
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
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        var margemPadrao = "{{ isset($produto) ? $produto->fornecedor->margem : 0 }}";
        $('#margem').val(margemPadrao);

        $('#fornecedor_id').on('change', function() {
            var margemLucro = parseFloat($(this).find('option:selected').data('margem'));
            $('#margem').val(margemLucro);
        });

        $(document).ready(function() {
            $('#valorCusto').on('input', function() {
                var valorCusto = parseFloat($(this).val().replace(',', '.'));
                var margemLucro = parseFloat($('#margem').val());

                // const moeda = {
                //     style: 'currency',
                //     currency: 'BRL',
                // };

                //const formatoMoeda = new Intl.NumberFormat('pt-BR', moeda);


                if (!isNaN(valorCusto) && !isNaN(margemLucro)) {
                    var margemLucro = ((100 - margemLucro) * 0.0100);
                    var valorVenda = ((valorCusto / margemLucro).toFixed(2));
                    $('#valorVenda').val(valorVenda);
                } else {
                    $('#valorVenda').val(''); // Se o valor de custo for inválido, limpa o campo de valor de venda
                }
            });
        });
    });
</script>