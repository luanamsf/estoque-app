<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro') }}
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
                    <h2 class="font-semibold text-xl mb-4">{{ __('Cadastro de Produtos') }}</h2>

                    <form method="POST" action="{{ route('produto.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="produto">Produto:</label>
                            <input type="text" name="produto" id="produto" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="codigo">Código:</label>
                            <input type="text" name="codigo" id="codigo" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="tipo">Tipo:</label>
                            <input type="text" name="tipo" id="tipo" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="marca">Marca:</label>
                            <input type="text" name="marca" id="marca" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="unidade">Unidade:</label>
                            <input type="text" name="unidade" id="unidade" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <!-- TODO: campo tipo float -->
                            <label for="valorCusto">Valor de Custo:</label>
                            <input type="text" name="valorCusto" id="valorCusto" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <!-- TODO: campo tipo float -->
                            <label for="valorVenda">Valor de Venda:</label>
                            <input type="text" name="valorVenda" id="valorVenda" class="form-input" required>
                        </div>

                        <!-- TODO: campo tipo int -->
                        <div class="mb-4">
                            <label for="quantidade">Quantidade:</label>
                            <input type="number" name="quantidade" id="quantidade" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <!-- TODO: campo tipo radio -->
                            <label for="status">Status:</label>
                            <input type="text" name="status" id="status" class="form-input" required>
                        </div>

                        <div class="mb-4">
                        <x-primary-button type="submit" class="btn btn-primary">Salvar</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>