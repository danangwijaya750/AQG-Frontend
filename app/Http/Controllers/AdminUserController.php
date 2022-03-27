<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::all()->load('studies', 'quiz');

        return view('admin.user.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'instance' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'role_id' => ['required'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'instance' => $request['instance'],
            'profession' => $request['profession'],
            'role_id' => $request['role_id'],
            'password' => Hash::make($request['password']),
        ]);

        return RedirectHelper::redirectRouteStatus('admin.user.index', 'success', 'Pengguna berhasil ditambah !');

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
        $user = User::findOrFail($id);

        $data['user'] = $user->load('studies', 'quiz');

        return view('admin.user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,'.$user->id,
            ],
            'instance' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'password' => ['nullable','string', new Password, 'confirmed'],
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }


        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'instance' => $request['instance'],
            'profession' => $request['profession'],
            'role_id' => $request['role_id'],
        ]);
        if ($request->password != null) {
            $user->update([
                'password' =>Hash::make($request['password']),
            ]);
        }
        return RedirectHelper::redirectRouteStatus('admin.user.index', 'success', 'Data berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return RedirectHelper::redirectRouteStatus('admin.user.index', 'success', 'Data berhasil dihapus !');

    }
}
