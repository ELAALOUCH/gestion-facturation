<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user');
        $this->middleware('permission:creer')->only(['create','store']);
        $this->middleware('permission:editer')->only(['edit','update']);
        $this->middleware('permission:supprimer')->only(['destroy']);

    }
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            $roles = Role::all();
            return view('users.create',compact('roles'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'same:confirm'],
            'role'=> ['required']

        ]);
            $user = User::create([
                'name' => $request->nom,
                'username' => $request->username,

                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_id'=>Auth::user()->company_id,
            ]);

            if ($user){

                $ownerRole = Role::where('name', $request->input('role'))->first();
                $user->assignRole($ownerRole);
                Session::flash('status', "L'utilisateur a été ajouté ");
            }
            return redirect()->route('user.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrfail($id);
        $roles = Role::all();

        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'role'=> ['required']
            ]);

            $user = User::findorFail($id);
            $user->name= $request->input('nom');
            $user->email= $request->input('email');
            $user->username= $request->input('username');


            if ($user->save()){

                $ownerRole = Role::where('name', $request->input('role'))->first();
                $user->assignRole($ownerRole);
                Session::flash('status', "L'utilisateur a été modifié ");
            }
            return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(User::findOrFail($id)->delete()){
            Session::flash('status', "L'utilisateur a été supprimé ");
        }
        return redirect()->route('user.index');

    }


}
