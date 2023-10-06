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

                    <form method="POST" action="{{ route('cliente.clients') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="telefone">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="aniversario">Aniversario:</label>
                            <input type="date" name="aniversario" id="aniversario" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="observacao">Observação:</label>
                            <input type="text" name="observacao" id="observacao" class="form-input">
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
