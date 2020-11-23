<?php

namespace App\Http\Controllers\api;
use App\Telefone;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class TelefoneController extends Controller
{
    public function listTelefone($id)
    {
        {
            try {
                $telefones =  (object) DB::table('telefone')
                    ->select(DB::raw('*'))
                    ->where('telefone.cliente', '=', $id)
                    ->get();

                return response()->json($telefones);
            } catch (Exception $e) {
                return response()->json(['message' => "Erro ao buscar dados do usuário.", 'error' => "$e"]);
            }
        }
    
    }

    /**
     *  Adiciona Telefone
     */
    public function addTelefone(Request $request)
    {
        try{
            $date = date('Y/m/d H:i:s');
            $telefone = new Telefone();
            $telefone->cliente = $request->cliente;
            $telefone->numero = $request->numero;
            $telefone->usrinc = $request->usrinc;
            $telefone->dtinc = $date;
            $telefone->save();
            return response()->json(['message' => 'Salvo com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

     /**
     *  Remove Telefone
     */
    public function removeTelefone($id)
    {
        try {
            DB::table('telefone')->where('id', $id)->delete();
            return response()->json(['message' => "Telefone excluído com sucesso!"]);
        } catch (Exception $e) {
            return response()->json(['message' => "Erro ao tentar desabilitar usuário.", 'error' => "$e"]);
        }   
    }
}
