<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar entrada') }}
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
    <script>
        function adicionarProduto() {
            var table = document.getElementById("produtosTable");
            var newRow = table.insertRow(table.rows.length);

            // Define as células da nova linha
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);

            calcularValorTotalEntrada();

            cell1.innerHTML = `
                <select name="produto_id[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required onchange="atualizarValorEntrada(this)">
                    <option value="">Selecione um produto</option>
                    @foreach($produtosId as $produto)
                    <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                    @endforeach
                </select>
            `;

            cell2.innerHTML = `<input type="text"   name="valorEntrada[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="0.00">`;
            cell3.innerHTML = `<input type="number" name="quantidade[]" id="quantidade${table.rows.length - 1}" class="border-gray-300 focus-border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required onchange="calcularValorTotalItem(this)">`;
            cell4.innerHTML = `<input type="text"   name="valorTotalItem[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" readonly>`;
            cell5.innerHTML = `<button type="button" onclick="removerProduto(this); calcularValorTotalEntrada();">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16" color="darkred">@svg('fluentui-subtract-16')</svg>
            </button>`;
        }

        function calcularValorTotalItem(inputQuantidade) {
            var row = inputQuantidade.parentNode.parentNode;
            var valorEntradaInput = row.querySelector('input[name="valorEntrada[]"]');
            var quantidade = parseFloat(inputQuantidade.value);

            if (!isNaN(quantidade)) {
                var valorEntrada = parseFloat(valorEntradaInput.value);
                var valorTotalItemInput = row.querySelector('input[name="valorTotalItem[]"]');
                var valorTotalItem = quantidade * valorEntrada;

                if (!isNaN(valorTotalItem)) {
                    valorTotalItemInput.value = valorTotalItem.toFixed(2);
                }
            }
            calcularValorTotalEntrada();
        }

        function removerProduto(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            calcularValorTotalEntrada();
        }

        function calcularValorTotalEntrada() {
            var totalEntrada = 0;
            var valorTotalItemInputs = document.getElementsByName('valorTotalItem[]');

            for (var i = 0; i < valorTotalItemInputs.length; i++) {
                var valorTotalItem = parseFloat(valorTotalItemInputs[i].value.replace(/[^\d.,-]/g, '').replace(',', '.'));

                if (!isNaN(valorTotalItem)) {
                    totalEntrada += valorTotalItem;
                }
            }

            var valorTotalEntradaInput = document.getElementById('valorTotalEntrada');
            valorTotalEntradaInput.value = totalEntrada.toFixed(2).replace(',', '.');
        }
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('entrada.entry') }}">
                        @csrf
                        <table width="95%" align="center">
                            <tr>
                                <th align="left" colspan="3">Fornecedor</th>
                                <th align="left">Usuário</th>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    <select name="fornecedor_id" id="fornecedor_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione um fornecedor</option>
                                        @foreach($fornecedoresId as $fornecedor)
                                        <option value="{{ $fornecedor->id }}" data-margem="{{ $fornecedor->margem }}">
                                            {{ $fornecedor->razaoSocial }}
                                        </option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <select name="user_id" id="user_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione um usuário</option>
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th align="left" width="20%">Nota Fiscal</th>
                                <th align="left" width="10%">Série</th>
                                <th align="left" width="30%">Data de Entrada</th>
                                <th align="left">Valor Total</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="notaFiscal" id="notaFiscal" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"></th>
                                <th><input type="text" name="serieNF" id="serieNF" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"></th>
                                <th width="30%"><input type="date" name="dataEntrada" id="dataEntrada" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ date('Y-m-d') }}" readonly></th>
                                <th><input type="text" name="valorTotalEntrada" id="valorTotalEntrada" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full readonly" readonly required></th>
                            </tr>
                        </table>
                        <br>
                        <table width="95%" align="center" id="produtosTable">
                            <tr>
                                <th>Produto</th>
                                <th>Vl. Unitário</th>
                                <th>Quantidade</th>
                                <th>Vl. Calc</th>
                            </tr>
                        </table>
                        <br>
                        <table width="95%" align="center">
                            <tr>
                                <th>
                                    <button onclick="adicionarProduto()" align="left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16" color="darkgreen">
                                            @svg('eos-add-shopping-cart-o')
                                        </svg>
                                    </button>
                                </th>
                            </tr>
                        </table>
                        <br>
                        <div class="mb-4" align="center">
                            <x-primary-button type="submit" class="btn btn-primary" align="center">Salvar</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>