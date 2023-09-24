<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\SimpleExcel\SimpleExcelWriter;
use PDF;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:fournisseur');
        $this->middleware('permission:creer')->only(['create','store']);
        $this->middleware('permission:editer')->only(['edit','update']);
        $this->middleware('permission:archiver')->only(['destroy']);
        $this->middleware('permission:archive')->only(['archive']);
        $this->middleware('permission:restaurer')->only(['restore']);
    }

    public function index()
    {
        $suppliers= Supplier::paginate(5);
        $tab='index';
        return view('suppliers.index',compact('suppliers','tab'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    public function archive()
    {
        $suppliers= Supplier::onlyTrashed()->paginate(5);
        $tab = 'archive';
        return view('suppliers.archive',compact('suppliers','tab'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ice' => 'required|string',
            'nom' => 'required|string',
            'telephone' => 'size:10',
            'site_web' => 'nullable|string',
            'email' => 'email',
            'adresse' => 'string|max:255',
            'ville'=>'required|string|max:255'
        ]);
        $supplier = new Supplier();
        $supplier->ice = $request->input('ice');
        $supplier->nom = $request->input('nom');
        $supplier->telephone = $request->input('telephone');
        $supplier->ville = $request->input('ville');
        $supplier->email = $request->input('email');
        $supplier->site_web = $request->input('site_web');
        $supplier->adresse = $request->input('adresse');
        $supplier->save();
        if ($supplier->save()) {
            Session::flash('status', "Le fournisseur a été ajouté avec succès ");
        }
        return redirect()->route('supplier.index');
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
            'ice' => 'required|string',
            'nom' => 'required|string',
            'telephone' => 'size:10',
            'site_web' => 'nullable|string',
            'email' => 'email',
            'adresse' => 'string|max:255',
            'ville'=>'required|string|max:255'
        ]);
        $supplier = Supplier::find($id);
        $supplier->ice = $request->input('ice');
        $supplier->nom = $request->input('nom');
        $supplier->telephone = $request->input('telephone');
        $supplier->email = $request->input('email');
        $supplier->ville = $request->input('ville');

        $supplier->site_web = $request->input('site_web');
        $supplier->adresse = $request->input('adresse');
        $supplier->save();
        if ($supplier->save()) {
            Session::flash('status', "Le fournisseur a été modifié avec succès");
        }
        return redirect()->route('supplier.index');
      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $supplier = Supplier::find($id);

    if ($supplier) {
        $supplier->purchaseInvoices()->delete();

        $supplier->delete();

        Session::flash('status', "Le fournisseur a été supprimé");
    }

    return redirect()->route('supplier.index');
}

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $number = $request->input('number');
        $tab='index';
        $suppliers = Supplier::where('email', 'LIKE', "%$keyword%")
                            ->orWhere('telephone', 'LIKE', "%$keyword%")
                            ->orWhere('nom', 'LIKE', "%$keyword%")
                            ->orWhere('ice', 'LIKE', "%$keyword%")
                            ->orWhere('adresse', 'LIKE', "%$keyword%")
                            ->orWhere('ville', 'LIKE', "%$keyword%")
                            ->orWhere('site_web', 'LIKE', "%$keyword%")
                            ->paginate($number)
                            ->appends(['keyword' => $keyword, 'number' => $number]);

        return view('suppliers.index', compact('suppliers','tab'));
    }

    public function searchArchive(Request $request)
    {
        $keyword = $request->input('keyword');
        $number = $request->input('number');
        $tab='archive';
        $suppliers = Supplier::onlyTrashed()->where('email', 'LIKE', "%$keyword%")
                            ->orWhere('telephone', 'LIKE', "%$keyword%")
                            ->orWhere('nom', 'LIKE', "%$keyword%")
                            ->orWhere('ice', 'LIKE', "%$keyword%")
                            ->orWhere('adresse', 'LIKE', "%$keyword%")
                            ->orWhere('ville', 'LIKE', "%$keyword%")
                            ->orWhere('site_web', 'LIKE', "%$keyword%")
                            ->paginate($number)
                            ->appends(['keyword' => $keyword, 'number' => $number]);

        return view('suppliers.archive', compact('suppliers','tab'));
    }

    public function restore($id)
    {
        $supplier = Supplier::withTrashed()->find($id);

        if ($supplier) {
            $supplier->restore();

            $supplier->purchaseInvoices()->restore();
        }

        return redirect()->back();
    }



    public function exportExcel()
    {
    $suppliers = Supplier::select('ice','nom','telephone','adresse','ville','site_web')->get();

    $excel = SimpleExcelWriter::streamDownload('suppliers.xlsx');

    $excel->addRows($suppliers->toArray());

    $excel->toBrowser();
    }

    public function exportPdf()
    {
    $suppliers = Supplier::all();

    $pdf = PDF::loadView('pdf.pdf-suppliers', ['suppliers' => $suppliers]);

    return $pdf->download('suppliers.pdf');
    }

}
