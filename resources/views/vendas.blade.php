<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendas') }}
        </h2>
    </x-slot>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
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

            // Adicione o conteúdo das células
            calcularValorTotalVenda();

            var produtoSelect = document.createElement("select");
            produtoSelect.name = "produto_id[]";
            produtoSelect.className = "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full";
            produtoSelect.required = true;
            produtoSelect.onchange = function() {
                atualizarValorVenda(this);
            };

            cell1.appendChild(produtoSelect);

            cell1.innerHTML = `
                <select name="produto_id[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required onchange="atualizarValorVenda(this)">
                    <option value="">Selecione um produto</option>
                    @foreach($produtosId as $produto)
                        <option value="{{ $produto->id }}" 
                            @if($produto->quantidade == 0) 
                                disabled 
                            @endif
                            data-valor="{{ $produto->valorVenda }}">
                            {{ $produto->produto }} ({{ $produto->quantidade }})
                        </option>
                    @endforeach
                </select>
            `;

            cell2.innerHTML = `<input type="text" name="valorVenda[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" readonly>`;
            cell3.innerHTML = `<input type="number" name="quantidade[]" id="quantidade${table.rows.length - 1}" class="border-gray-300 focus-border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required onchange="calcularValorTotalItem(this)">`;
            cell4.innerHTML = `<input type="text" name="valorTotalItem[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" readonly>`;
            cell5.innerHTML = `<button type="button" onclick="removerProduto(this); calcularValorTotalVenda();">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16" color="darkred">@svg('fluentui-subtract-16')</svg>
            </button>`;
        }

        function atualizarValorVenda(select) {
            var selectedOption = select.options[select.selectedIndex];
            var valorVenda = selectedOption.getAttribute('data-valor');
            var row = select.parentNode.parentNode;

            // Corrija o seletor para encontrar o campo 'valorVenda'
            var valorVendaInput = row.querySelector('input[name="valorVenda[]"]');
            valorVendaInput.value = valorVenda;
        }

        function calcularValorTotalItem(inputQuantidade) {
            var row = inputQuantidade.parentNode.parentNode;
            var selectProduto = row.querySelector('select[name="produto_id[]"]');
            var selectedOption = selectProduto.options[selectProduto.selectedIndex];

            if (selectedOption) {

                var quantidadeDisponivel = parseFloat(selectedOption.text.match(/\((\d+)\)/)[1]);
                var quantidadeInserida = parseFloat(inputQuantidade.value);

                if (!isNaN(quantidadeInserida) && quantidadeInserida > quantidadeDisponivel) {
                    alert("A quantidade inserida é maior do que a quantidade disponível em estoque. Por favor, insira uma quantidade válida.");
                    inputQuantidade.value = "";
                    return;
                }

                var valorVenda = parseFloat(selectedOption.getAttribute('data-valor'));
                var quantidade = parseFloat(inputQuantidade.value);
                var valorTotalItemInput = row.querySelector('input[name="valorTotalItem[]"]');
                var valorTotalItem = quantidade * valorVenda;

                if (!isNaN(valorTotalItem)) {
                    valorTotalItemInput.value = valorTotalItem.toFixed(2);
                }
            }

            calcularValorTotalVenda();
        }

        function removerProduto(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            calcularValorTotalVenda();
        }

        function calcularValorTotalVenda() {
            var totalVenda = 0;
            var valorTotalItemInputs = document.getElementsByName('valorTotalItem[]');

            for (var i = 0; i < valorTotalItemInputs.length; i++) {
                var valorTotalItem = parseFloat(valorTotalItemInputs[i].value.replace(/[^\d.,-]/g, '').replace(',', '.'));

                if (!isNaN(valorTotalItem)) {
                    totalVenda += valorTotalItem;
                }
            }

            // Atualize o campo 'valorTotalVenda' com o valor total da venda
            var valorTotalVendaInput = document.getElementById('valorTotalVenda');
            valorTotalVendaInput.value = totalVenda.toFixed(2).replace(',', '.');
        }
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('venda.sale') }}">
                        @csrf
                        <table width="95%" align="center">
                            <tr>
                                <th align="left" colspan="2">Cliente</th>
                                <!-- <th width="10%"></th> -->
                                <th align="left">Vendedor</th>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <select name="cliente_id" id="cliente_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione um cliente</option>
                                        @foreach($clientesId as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <select name="user_id" id="user_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione um vendedor</option>
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th align="left" width="30%">Forma de Pagamento</th>
                                <th align="left" width="30%">Data da Venda</th>
                                <th align="left">Valor Total</th>
                            </tr>
                            <tr>
                                <th width="30%">
                                    <select name="modoPagamento" id="modoPagamento" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione uma opção</option>
                                        <option value="cred vista">Crédito a vista</option>
                                        <option value="cred parc">Crédito Parcelado</option>
                                        <option value="deb">Débito</option>
                                        <option value="din vista">Dinheiro A vista</option>
                                        <option value="din parc">Dinheiro Parcelado</option>
                                    </select>
                                </th>
                                <th width="30%"><input type="date" name="dataVenda" id="dataVenda" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ date('Y-m-d') }}" readonly></th>
                                <th><input type="text" name="valorTotalVenda" id="valorTotalVenda" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full readonly" readonly required></th>
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