<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     *  Listar usuários registrados
     */
    public function list()
    {
        $users = User::all();
        return response()->json($users);
    }
    
    /**
     * Listar Usuarios escluidos 
     */
    public function softDelete()
    {
        try {
            $user = new User();
            $user->withTrashed()->get();
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        } 
    }

     /**
     *  Consultar dados do usuário
     */
    public function getUser($id)
    {
        try {
            $user =  (object) DB::table('users')
                ->select(DB::raw('users.id, users.email,users.name, users.dtinc,users.dtatualizacao, perfil.perfil'))
                ->join('perfil', 'users.perfil', '=', 'perfil.id')
                ->where('users.id', '=', $id)
                ->first();
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['message' => "Erro ao buscar dados do usuário.", 'error' => "$e"]);
        }
    }

    /**
     *  Registrar usuário
     */
    public function registerUser(UserFormRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->perfil = $request->perfil;
            $user->rg = $request->rg;
            $user->dtinc = date('Y-m-d H:i:s');
            $user->save();
            return response()->json(['message' => 'Salvo com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

    /**
     *  Atualizar o usuário
     */
    public function updateUser(Request $request, $id)
    {
        try {
            $dado = $id;
            $email = (object) DB::table('users')->where('email', $request->email)->first();

            if(isset($email->id)):
                if($email->id  != $id):
                    return response()->json(['message' => "Email já cadastrado!"]);
                endif;
            endif;

            $user =  (object) DB::table('users')
                    ->select(DB::raw('*'))
                    ->where('id', '=', $dado)
                    ->first();
           
            if(is_null($request->password)):
                $request->password = $user->password;
            else:
                $request->password =  Hash::make($request->password);
            endif;
            
            $date = date('Y/m/d H:i:s');
            DB::table('users')
                ->where('id', $id)
                ->update(array('dtatualizacao'=> $date, 'name' => $request->name, 'password' => $request->password, 'email' => $request->email));
            return response()->json(['message' => "Usuário atualizado com sucesso!"]);
        } catch (Exception $e) {
            return response()->json(['message' => "Erro ao tentar atualizar usuário.", 'error' => "$e"]);
        }   
     }

    /**
     *  Desativar o usuário
     */
    public function disableUser($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json(['message' => "Usuário excluído com sucesso!"]);
        } catch (Exception $e) {
            return response()->json(['message' => "Erro ao tentar desabilitar usuário.", 'error' => "$e"]);
        }   
     }
}
