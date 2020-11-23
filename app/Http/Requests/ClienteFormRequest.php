<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|max: 255',
            'cpf' => 'required|cpf|formato_cpf|unique:cliente',
            'nascimento' =>'required',
            'localnasc' => 'required',
        ];
    }
    
    public function messages(){
        return [
            'nome.required'=>'Nome obrigatório.',
            'name.max' => 'Nome deve conter no máximo 255 caracteres.',
            'cpf.unique' => 'CPF já cadastrado.',
            'nascimento.required'=>'Informe a data de nascimento.',
            'localnasc.unique' =>'Informe o local de nascimento.'
        ];
    }
}
