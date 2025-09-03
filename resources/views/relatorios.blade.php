<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel') }}
        </h2>
    </x-slot>
    <br>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="font-size:1pc;">
                        Contas a pagar
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="font-size:1pc;">
                    <h3>Contas a Receber</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="font-size:1pc;">
                    <h3>Movimentações</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="font-size:1pc;">
                    <h3>Vendas Realizadas</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="font-size:1pc;">
                    <h3 class="flex items-center">
                        <a href="{{ route('relatorios.clientes') }}" class="flex-1">Clientes</a>
                        <a href="{{ route('relatorios.clientes.pdf') }}" class="ml-2" title="Exportar PDF">📄</a>
                        <a href="{{ route('relatorios.clientes.excel') }}" class="ml-2" title="Exportar Excel">📊</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
