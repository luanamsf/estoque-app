<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatório de Clientes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($clientes->count())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aniversário</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->nome }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->cpf }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->telefone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->aniversario }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->observacao }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>Nenhum(a) cliente cadastrado(a).</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

