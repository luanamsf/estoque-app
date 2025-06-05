<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('produtos.update', $produto) }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="produto" :value="__('Nome do Produto')" />
                                <x-text-input id="produto" name="produto" type="text" class="mt-1 block w-full" :value="old('produto', $produto->produto)" required />
                                <x-input-error :messages="$errors->get('produto')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="codigo" :value="__('Código')" />
                                <x-text-input id="codigo" name="codigo" type="text" class="mt-1 block w-full" :value="old('codigo', $produto->codigo)" required />
                                <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tipo_id" :value="__('Tipo')" />
                                <select id="tipo_id" name="tipo_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Selecione um tipo</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_id', $produto->tipo_id) == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->descricao_tipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('tipo_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="fornecedor_id" :value="__('Fornecedor')" />
                                <select id="fornecedor_id" name="fornecedor_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Selecione um fornecedor</option>
                                    @foreach($fornecedores as $fornecedor)
                                        <option value="{{ $fornecedor->id }}" {{ old('fornecedor_id', $produto->fornecedor_id) == $fornecedor->id ? 'selected' : '' }}>
                                            {{ $fornecedor->nomeFantasia }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('fornecedor_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="unidade_id" :value="__('Unidade')" />
                                <select id="unidade_id" name="unidade_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Selecione uma unidade</option>
                                    @foreach($unidades as $unidade)
                                        <option value="{{ $unidade->id }}" {{ old('unidade_id', $produto->unidade_id) == $unidade->id ? 'selected' : '' }}>
                                            {{ $unidade->descricao_unidade }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('unidade_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="valorCusto" :value="__('Valor de Custo')" />
                                <x-text-input id="valorCusto" name="valorCusto" type="number" step="0.01" class="mt-1 block w-full" :value="old('valorCusto', $produto->valorCusto)" required />
                                <x-input-error :messages="$errors->get('valorCusto')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="valorVenda" :value="__('Valor de Venda')" />
                                <x-text-input id="valorVenda" name="valorVenda" type="number" step="0.01" class="mt-1 block w-full" :value="old('valorVenda', $produto->valorVenda)" required />
                                <x-input-error :messages="$errors->get('valorVenda')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="quantidade" :value="__('Quantidade')" />
                                <x-text-input id="quantidade" name="quantidade" type="number" class="mt-1 block w-full" :value="old('quantidade', $produto->quantidade)" required />
                                <x-input-error :messages="$errors->get('quantidade')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Atualizar Produto') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 