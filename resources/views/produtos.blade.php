<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
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

                    <form method="POST" action="{{ route('produtos.store') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="produto" :value="__('Nome do Produto')" />
                                <x-text-input id="produto" name="produto" type="text" class="mt-1 block w-full" :value="old('produto')" required />
                                <x-input-error :messages="$errors->get('produto')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="codigo" :value="__('Código')" />
                                <x-text-input id="codigo" name="codigo" type="text" class="mt-1 block w-full" :value="old('codigo')" required />
                                <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tipo_id" :value="__('Tipo')" />
                                <select id="tipo_id" name="tipo_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Selecione um tipo</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('tipo_id') == $tipo->id ? 'selected' : '' }}>
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
                                        <option value="{{ $fornecedor->id }}" {{ old('fornecedor_id') == $fornecedor->id ? 'selected' : '' }}>
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
                                        <option value="{{ $unidade->id }}" {{ old('unidade_id') == $unidade->id ? 'selected' : '' }}>
                                            {{ $unidade->descricao_unidade }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('unidade_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="valorCusto" :value="__('Valor de Custo')" />
                                <x-text-input id="valorCusto" name="valorCusto" type="number" step="0.01" class="mt-1 block w-full" :value="old('valorCusto')" required />
                                <x-input-error :messages="$errors->get('valorCusto')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="valorVenda" :value="__('Valor de Venda')" />
                                <x-text-input id="valorVenda" name="valorVenda" type="number" step="0.01" class="mt-1 block w-full" :value="old('valorVenda')" required />
                                <x-input-error :messages="$errors->get('valorVenda')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="quantidade" :value="__('Quantidade')" />
                                <x-text-input id="quantidade" name="quantidade" type="number" class="mt-1 block w-full" :value="old('quantidade')" required />
                                <x-input-error :messages="$errors->get('quantidade')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="foto" :value="__('Foto do Produto')" />
                                <input type="file" id="foto" name="foto" accept="image/*" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Cadastrar Produto') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900">Lista de Produtos</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($produtos as $produto)
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-4">
                                        <img src="{{ $produto->foto_url }}" alt="{{ $produto->produto }}" class="w-full h-48 object-cover rounded-lg mb-4">
                                        <h4 class="text-lg font-semibold">{{ $produto->produto }}</h4>
                                        <p class="text-sm text-gray-600">Código: {{ $produto->codigo }}</p>
                                        <p class="text-sm text-gray-600">Tipo: {{ $produto->tipo->descricao_tipo }}</p>
                                        <p class="text-sm text-gray-600">Fornecedor: {{ $produto->fornecedor->nomeFantasia }}</p>
                                        <p class="text-sm text-gray-600">Unidade: {{ $produto->unidade->descricao_unidade }}</p>
                                        <p class="text-sm text-gray-600">Valor de Custo: R$ {{ number_format($produto->valorCusto, 2, ',', '.') }}</p>
                                        <p class="text-sm text-gray-600">Valor de Venda: R$ {{ number_format($produto->valorVenda, 2, ',', '.') }}</p>
                                        <p class="text-sm text-gray-600">Quantidade: {{ $produto->quantidade }}</p>
                                        
                                        <div class="mt-4 flex space-x-2">
                                            <a href="{{ route('produtos.edit', $produto) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                Editar
                                            </a>
                                            <form method="POST" action="{{ route('produtos.destroy', $produto) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 