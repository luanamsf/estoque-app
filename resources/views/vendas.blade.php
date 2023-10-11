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

            cell1.innerHTML = `
            <select name="produtos[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                <option value="">Selecione um produto</option>
                @foreach($produtosId as $produto)
                <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                @endforeach
            </select>
        `;

            cell2.innerHTML = `<input type="number" name="quantidades[]" width="90%" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>`;
            cell3.innerHTML = `<button type="button" border=0 onclick="removerProduto(this)"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16" color="darkred">@svg('fluentui-subtract-16')</svg></button>`;
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
                                <th align="left">Data da Venda</th>
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
                                <!-- <th width="10%"></th> -->
                                <th width="40%">
                                    <select name="user_id" id="user_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecione um vendedor</option>
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    </select>
                                </th>
                                <th><input type="date" name="data_venda" id="data_venda" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" value="{{ date('Y-m-d') }}" readonly></th>
                            </tr>

                        </table>
                        <br>
                        <table width="95%" align="center" id="produtosTable">
                            <tr>
                                <th>Produtos</th>
                                <th>Quantidades</th>    
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