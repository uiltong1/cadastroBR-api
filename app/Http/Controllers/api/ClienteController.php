<?php

namespace App\Http\Controllers\api;

use App\Cliente;
use App\Telefone;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class ClienteController extends Controller
{
     /**
     *  Listar clientes registrados
     */
    public function list()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    /**
     *  Consultar dados do usuário
     */
    public function getCliente($id)
    {
        try {
            $user =  (object) DB::table('cliente')
                ->select(DB::raw('cliente.id, cliente.nome, cliente.cpf, cliente.rg,cliente.dtcadastro, 
                                 cliente.dtatualizacao, cliente.usratualizacao, cliente.localnasc,cliente.nascimento, cliente.usrinc, users.name as usrincluir,
                                 users.email as emailincluir, cliente.usratualizacao, usralt.name usralt, usralt.email as emailalt'))
                ->join('users', 'cliente.usrinc', '=', 'users.id')
                ->leftjoin('users as usralt', 'cliente.usratualizacao', '=', 'usralt.id')
                ->where('cliente.id', '=', $id)
                ->first();
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['message' => "Erro ao buscar dados do usuário.", 'error' => "$e"]);
        }
    }

    /** 
     *  Registrar clientes
     */
    public function registerCliente(ClienteFormRequest $request)
    {
        try {
            $date = date('Y-m-d H:i:s');
            $cliente = new Cliente();
            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->nascimento = $request->nascimento;
            $cliente->localnasc = $request->localnasc;
            $cliente->usrinc = $request->usrinc;
            $cliente->dtcadastro = $date;
            $cliente->save();

            $dados = DB::table('cliente')
            ->select('id')
            ->where('cpf', '=', $request->cpf)
            ->first();


            foreach($request->telefone as $index => $value){
                $telefone = new Telefone();
                $telefone->cliente = $dados->id;
                $telefone->numero = $value;
                $telefone->usrinc = $request->usrinc;
                $telefone->usratualizacao = $request->usratualizacao;
                $telefone->dtinc = $date;
                $telefone->save();
            }


            return response()->json(['message' => 'Salvo com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

    /**
     *  Atualizar dados do cliente
     */
    public function updateCliente(Request $request, $id)
    {
        try{
            $cliente = new Cliente();
            $dados = (object) $request->all();
            $cliente = $cliente->find($id);
            $update = $cliente->update(get_object_vars($dados));
            
            if ($update):
                return response()->json(['message' => 'Dados atualizados com êxito!']);
            else:
                return response()->json(['message' => 'Os dados não foram atualizados!']);
            endif;

         } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

}
