<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUsers;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $model; 
    public function __construct(Users $users)
    {
        $this->model = $users; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response($this->model->all()); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'username'=> 'required|string',
            'usercpf'=> 'required|string|unique:users,usercpf',
            'useremail'=> 'required|string|unique:users,useremail',
            'password'=> 'required|string',
            'userphone'=> 'required|string',
            'userstatus' => 'required|string',

        ], [
            'usercpf.unique' => 'CPF já cadastrada.',
            'useremail.unique' => 'Email já cadastrado.',
        ]);     
        Users::create([
            'username' => $data['username'],
            'usercpf' => $data['usercpf'], 
            'useremail' => $data['useremail'], 
            'password' => bcrypt($data['password']), 
            'userphone' => $data['userphone'], 
            'userstatus' => $data['userstatus'],
            'role'=> 'string'

        ]);

        return response()->json(['message'=> 'Cadastro realizado com sucesso!'], 201); 
    }

    public function login_user(LoginUsers $request){
        $input = $request -> validated(); 
        $credentials = [
            'useremail' => $input['useremail'],
            'password' => $input['password'],
        ];

        if(!$token = auth('users')->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401); 
        };

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Users::find($id);
        if(!$user){
            return response()->json(['error'=> 'User Not Found'],404);
        }
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $user = Users::findOrFail($id);

        $data = $request->validate([
            'username'=> 'required|string',
            'useremail'=>'required|string',
            'role'=>'required|string'
        ]);

     
        $user->update($data);
        return response()->json($user,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Users::findOrfail($id);
        $user->delete();
        return response()->noContent();
    }
}
