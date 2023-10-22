<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendas') }}
        </h2>
    </x-slot>

    <script>
        function adicionarProduto() {
            var table = document.getElementById("produtosTable");
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);

            cell1.innerHTML = `
                <select name="produtosId" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required onchange="atualizarValorVenda(this)">
                    <option value="">Selecione um produto</option>
                    @foreach($produtosId as $produto)
                    <option value="{{ $produto->id }}" data-valor="{{ $produto->valorVenda }}">{{ $produto->produto }}</option>
                    @endforeach
                </select>
            `;

            cell2.innerHTML = `<input type="text"   name="valorVenda"      class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" readonly>`;
            cell3.innerHTML = `<input type="number" name="quantidade" id="quantidade${table.rows.length - 1}" class="border-gray-300 focus-border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required onchange="calcularValorTotalItem(this)">`;
            cell4.innerHTML = `<input type="text"   name="valorTotalItem"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" readonly>`;
            cell5.innerHTML = `<button type="button" border=0 onclick="removerProduto(this)"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16" color="darkred">@svg('fluentui-subtract-16')</svg></button>`;
        }

        function atualizarValorVenda(select) {
            var selectedOption = select.options[select.selectedIndex];
            var valorVenda = selectedOption.getAttribute('data-valor');
            var row = select.parentNode.parentNode;
            var valorVendaInput = row.querySelector('input[name="valorVenda"]');
            valorVendaInput.value = valorVenda;
        }

        function calcularValorTotalItem(inputQuantidade) {
            var row = inputQuantidade.parentNode.parentNode;
            var selectProduto = row.querySelector('select[name="produtosId"]');
            var selectedOption = selectProduto.options[selectProduto.selectedIndex];
            




            if (selectedOption) {
                var valorVenda = parseFloat(selectedOption.getAttribute('data-valor'));
                var quantidade = parseFloat(inputQuantidade.value);
                var valorTotalItemInput = row.querySelector('input[name="valorTotalItem"]');
                var valorTotalItem = quantidade * valorVenda;

                const moeda = {
                    style: 'currency',
                    currency: 'BRL', 
                };

                const formatoMoeda = new Intl.NumberFormat('pt-BR', moeda);
                
                if (!isNaN(valorTotalItem)) {
                    valorTotalItemInput.value = formatoMoeda.format(valorTotalItem);
                }
            }
        }

        function removerProduto(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);

        }
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('venda.sale') }}">
                        <table width="95%" align="center">
                            <tr>
                                <th align="left">Cliente</th>
                                <!-- <th width="10%"></th> -->
                                <th align="left">Vendedor</th>
                            </tr>
                            <tr>
                                <th>
                                    <select name="cliente_id" id="cliente_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione um cliente</option>
                                        @foreach($clientesId as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th width="40%">
                                    <select name="user_id" id="user_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione um vendedor</option>
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th align="left">Forma de Pagamento</th>
                                <th align="left" width="40%">Data da Venda</th>
                            </tr>
                            <tr>
                                <th>
                                    <select name="modoPagamento" id="modoPagamento" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione uma opção</option>
                                        <option value="cred vista">Crédito a vista</option>
                                        <option value="cred parc">Crédito Parcelado</option>
                                        <option value="deb">Débito</option>
                                        <option value="din vista">Dinheiro A vista</option>
                                        <option value="din parc">Dinheiro Parcelado</option>
                                    </select>
                                </th>
                                <th width="40%"><input type="date" name="data_venda" id="data_venda" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ date('Y-m-d') }}" readonly></th>
                            </tr>


                        </table>
                        <br>
                        <table width="95%" align="center" id="produtosTable">
                            <tr>
                                <th>Produto</th>
                                <th>Vl. Produto</th>
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