
<style>
    .collapsible-content {
        display: none;
    }
</style>

<script>
    function toggleCollapsible() {
        var collapsible = document.getElementById('collapsible-section');
        if (collapsible.style.display === 'none') {
            collapsible.style.display = 'block';
        } else {
            collapsible.style.display = 'none';
        }
    }
</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
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
                    <h2 class="font-semibold text-xl mb-4">{{ __('Cadastro de Clientes') }}</h2>
                    <button onclick="toggleCollapsible()" class="bg-blue-500 hover:bg-blue-700 text-gray font-bold py-4 px-4 rounded">
                        Incluir
                    </button>
                    <div id="collapsible-section" class="collapsible-content">
                    <form method="POST" action="{{ route('cliente.clients') }}">
                        @csrf
                        <div class="mb-4 flex">
                            <div class="mr-4 w-1/2">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-input" required>
                            </div>
                            <div class="w-1/2">
                                <label for="telefone">Telefone:</label>
                                <input type="text" name="telefone" id="telefone" class="form-input" required>
                            </div>
                        </div>
                        <div class="mb-4 flex">
                            <div class="mr-4 w-1/2">
                                <div class="mb-4">
                                    <label for="aniversario">Aniversário:</label>
                                    <input type="date" name="aniversario" id="aniversario" class="form-input" required>
                                </div>
                            </div>
                            <div class="mr-4 w-1/2">
                                <div class="mb-4">
                                    <label for="observacao">Observação:</label>
                                    <input type="text" name="observacao" id="observacao" class="form-input">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-primary-button type="submit" class="btn btn-primary">Salvar</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl mb-4">Carteira de Clientes</h2>
                    @if ($clientes->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aniversário</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observação</th>
                                <!-- Adicione mais colunas para outros campos aqui -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->nome }}</td>
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