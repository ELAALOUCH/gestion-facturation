<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers= Supplier::paginate(5);
        return view('suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ice' => 'required|string|size:15',
            'nom' => 'required|string|max:255',
            'telephone' => 'size:10',
            'site_web' => 'nullable|string',
            'email' => 'email',
            'adresse' => 'string|max:255',

        ]);
        $supplier = new Supplier();
        $supplier->ice = $request->input('ice');
        $supplier->nom = $request->input('nom');
        $supplier->telephone = $request->input('telephone');
        $supplier->email = $request->input('email');
        $supplier->site_web = $request->input('site_web');
        $supplier->adresse = $request->input('adresse');
        $supplier->save();
        if ($supplier->save()) {
            Session::flash('status', "Le fournissure a été ajouté ");
        }
        return redirect()->route('supplier.index');
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
        return view('suppliers.edit',[
            'supplier' =>Supplier::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'ice' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'size:10',
            'site_web' => 'nullable|string',
            'email' => 'email',
            'adresse' => 'string|max:255',

        ]);
        $supplier = Supplier::find($id);
        $supplier->ice = $request->input('ice');
        $supplier->nom = $request->input('nom');
        $supplier->telephone = $request->input('telephone');
        $supplier->email = $request->input('email');
        $supplier->site_web = $request->input('site_web');
        $supplier->adresse = $request->input('adresse');
        $supplier->save();
        if ($supplier->save()) {
            Session::flash('status', "Le fournissure a été modifié ");
        }
        return redirect()->route('supplier.index');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ((Supplier::where('id', $id)->delete()))
        {
            Session::flash('status', "Le fournisseur a été supprimé");
        }
        return redirect()->route('supplier.index');

    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $number = $request->input('number');

        $suppliers = Supplier::where('email', 'LIKE', "%$keyword%")
                            ->orWhere('telephone', 'LIKE', "%$keyword%")
                            ->orWhere('adresse', 'LIKE', "%$keyword%")
                            ->orWhere('site_web', 'LIKE', "%$keyword%")
                            ->paginate($number)
                            ->appends(['keyword' => $keyword, 'number' => $number]);

        return view('suppliers.index', compact('suppliers'));
    }

}
