<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    // Exibe o formulário de edição ou criação
    public function edit(): View
    {
        // Recupera a empresa cadastrada, se existir
        $company = Company::first();

        return view('company', compact('company'));
    }

    // Salva ou atualiza os dados da empresa
    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cnpj' => 'required|unique:companies,cnpj,' . optional(Company::first())->id,
            'razaoSocial' => 'required|string|max:255',
            'fantasia' => 'nullable|string|max:255',
            'InscEstadual' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'tipo' => 'nullable|string|max:50',
            'segmento' => 'nullable|string|max:100',
            'nomeResponsavel' => 'nullable|string|max:255',
            'telefoneResponsavel' => 'nullable|string|max:20',
            'emailResponsavel' => 'nullable|string|max:255',
        ]);

        // Verifica se a empresa já existe
        $company = Company::first();

        if ($company) {
            // Atualiza a empresa existente
            $company->update($validated);
        } else {
            // Cria uma nova empresa
            Company::create($validated);
        }

        return redirect()->route('company.edit')->with('success', 'Dados da empresa salvos com sucesso.');
    }
}