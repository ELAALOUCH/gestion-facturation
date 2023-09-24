<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role');
        $this->middleware('permission:creer')->only(['create','store']);
        $this->middleware('permission:editer')->only(['edit','update']);
        $this->middleware('permission:voir')->only(['show']);
        $this->middleware('permission:supprimer')->only(['destroy']);

    }
    public function index()
    {
        $roles = Role::where('name', '!=', 'owner')->paginate(5);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'permissions' => ['array'],

        ]);

        if($request->input('roles')){

            foreach ($request->input('roles') as $permission) {
                if (is_array($permission)) {
                    Permission::insert($permission);
                } elseif (is_object($permission)) {
                    Permission::insert($permission->toArray());
                }
            }

            $role = Role::create(['name' => $request->input('name')]);
            $role->givePermissionTo($request->input('roles'));
            return redirect()->route('roles.index')->with('status', 'Rôle créé avec succès');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show',compact('role'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $role = Role::findOrFail($id);
        return view('roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles')->ignore($id), // Ignore le rôle actuel avec l'ID $id
            ],
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('roles'));
        return redirect()->route('roles.index')->with('status', 'Rôle mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('roles.index')->with('status', 'Rôle supprimé avec succès.');
    }
}
