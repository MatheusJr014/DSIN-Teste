<?php

namespace App\Http\Controllers;

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
            'password' => $data['password'], 
            'userphone' => $data['userphone'], 
            'userstatus' => $data['userstatus']

        ]);

        return response()->json(['message'=> 'Cadastro realizado com sucesso!'], 201); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
