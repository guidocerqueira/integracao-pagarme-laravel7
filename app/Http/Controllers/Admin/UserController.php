<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();

            $userCreate = User::create($request->all());

            DB::commit();
            return redirect()->route('admin.user.edit', [
                'user' => $userCreate->id
            ])->with([
                'color' => 'success',
                'message' => 'Usuário cadastrado com sucesso!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            abort(404, 'Usuário não encontrado');
        }

        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            abort(404, 'Usuário não encontrado');
        }

        try {
            DB::beginTransaction();

            $user->fill($request->all());
            $user->save();

            DB::commit();
            return redirect()->route('admin.user.edit', [
                'user' => $user->id
            ])->with([
                'color' => 'success',
                'message' => 'Usuário atualizado com sucesso!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::id() == $id) {
            $json['error'] = true;
            $json['message'] = 'Não é possível excluir seu próprio cadastro!';
            return response()->json($json);
        }

        if ($user = User::where('id', $id)->delete()) {
            $json['delete'] = true;
            $json['redirect'] = route('admin.user.index');
            $json['message'] = 'Usuário removido com sucesso!';
            return response()->json($json);
        }

        $json['error'] = true;
        $json['message'] = 'Não foi possível excluir o usuário. Favor, tente novamente!';
        return response()->json($json);
    }
}
