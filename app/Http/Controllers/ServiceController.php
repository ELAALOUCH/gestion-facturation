<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tab='index';
        $services = Service::paginate(5);
        return view('services.index',compact('tab','services'));
    }

    public function archive()
    {
        $services= Service::onlyTrashed()->paginate(5);
        $tab = 'archive';
        return view('services.archive',compact('services','tab'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = new Service();
        $service->nom = $request->input('designation');
        $service->description = $request->input('description');
        $service->type = "interne";
        if($service->save()){

            Session::flash('status', "Le service a été ajouté avec succès.");
        }

        return redirect()->route('service.index');


    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::find($id);
        $service->nom = $request->input('designation');
        $service->description = $request->input('description');
        if($service->save()){

            Session::flash('status', "Le service a été modifié avec succès.");
        }

        return redirect()->route('service.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Service::findOrFail($id)->delete()){

            Session::flash('status', "Le service a été supprimé avec succès.");

        }
        return redirect()->route('service.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $number = $request->input('number');
        $tab='index';

        $services = Service::where('nom', 'LIKE', "%$keyword%")
        ->orWhere('description', 'LIKE', "%$keyword%")
        ->orWhere('type', 'LIKE', "%$keyword%")
        ->paginate($number)
        ->appends(['keyword' => $keyword, 'number' => $number]);

        return view('services.index', compact('services', 'tab'));
    }
    public function restore($id)
    {

        $service = Service::withTrashed()->find($id);

        if ($service) {
            $service->restore();
        }

        return redirect()->back();
    }

    public function forcedelete(string $id)
    {
        if(Service::find($id)->forcedelete()){
            return redirect()->route('invoice.index');
        }

    }

}
