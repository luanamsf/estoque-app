<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('venda.sale') }}">
                        <table width="90%" align="center">
                            <tr>
                                <th align="left">Cliente</th>
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
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>