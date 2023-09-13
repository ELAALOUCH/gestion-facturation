<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->company){
            return view('companies.info',['tab'=>'company']);
        }
        $company = Auth::user()->company;
        $tab = 'company';
        return view('companies.show',compact('company','tab'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tab = 'company';

        return view('companies.create',compact('tab'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ice' => 'required|string',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|size:10',
            'site_web' => 'nullable|string',
            'email' => 'required|email',
            'adresse' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'if' => 'required|string',
            'cnss' => 'required|string',
            'rib' => 'required|string',
            'rc' => 'required|string',
            'patente'=>'required|string',
        ]);
        $company = new Company();
        $company->ice = $request->input('ice');
        $company->nom = $request->input('nom');
        $company->telephone = $request->input('telephone');
        $company->email = $request->input('email');
        $company->site_web = $request->input('site_web');
        $company->adresse = $request->input('adresse');
        $company->if = $request->input('if');
        $company->cnss = $request->input('cnss');
        $company->rib = $request->input('rib');
        $company->rc = $request->input('rc');
        $company->patente = $request->input('patente');

        $company->save();

        if ($company->save()) {
            $user = User::find(Auth::user()->id);
            $user->company()->associate($company)->save();

            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->store('logo');

                $company->logo = $path;
                $company->save();
            }
            Session::flash('status', "Les informations sur l'entreprise ont été ajoutées avec succès");

            return redirect()->route('company.index');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('companies.edit',[
            'company' => Company::find($id),
            'tab'=>'company'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'ice' => 'required|string',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|size:10',
            'site_web' => 'nullable|string',
            'email' => 'required|email',
            'adresse' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'if' => 'required|string',
            'cnss' => 'required|string',
            'rib' => 'required|string',
            'rc' => 'required|string',
            'patente'=>'required|string',
        ]);

        $company = Company::find($id);
        $company->ice = $request->input('ice');
        $company->nom = $request->input('nom');
        $company->telephone = $request->input('telephone');
        $company->email = $request->input('email');
        $company->site_web = $request->input('site_web');
        $company->adresse = $request->input('adresse');
        $company->if = $request->input('if');
        $company->cnss = $request->input('cnss');
        $company->rib = $request->input('rib');
        $company->rc = $request->input('rc');
        $company->patente = $request->input('patente');
        if($company->save()){

        if ($request->hasFile('logo')) {
                    if($company->logo ){
                        Storage::delete($company->logo);
                        $path = $request->file('logo')->store('logo');
                        $company->logo = $path;
                        $company->save();
                    }
        }

         Session::flash('status', 'Les informations de la société ont été modifiées avec succès');

        }
        return redirect()->route('company.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Company::where('id', Auth::user()->company_id)->delete()){
            $user = User::find(Auth::user()->id);
            $user->company_id = NULL;
            $user->save();
            Session::flash('status', "L'entreprise a été suprimée");
        }
        return redirect()->route('company.index');


    }
}
