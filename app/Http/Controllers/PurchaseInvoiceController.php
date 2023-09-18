<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseItem;
use App\Models\Service;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session  ;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

use function PHPSTORM_META\type;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = PurchaseInvoice::paginate(5);
        $tab='index';


        return view('purchase-invoices.index',compact('invoices','tab'));
    }

    public function archive()
    {

        $invoices= PurchaseInvoice::onlyTrashed()->paginate(5);
        $tab = 'archive';
        return view('purchase-invoices.archive',compact('invoices','tab'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentDate=Carbon::today()->toDateString();
        $suppliers = Supplier::all();
        $products = Product::all();
        $services = Service::all();
        return view('purchase-invoices.create',compact('suppliers','currentDate','products','services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fournisseur' => 'required',
            'date' => 'required|date',
            'etat_paiement' => 'required',
            'type' => 'required',
            'moyen_paiement' =>'required_if:etat_paiement,1',
            'n_cheque' => '',
            'n_virement' => '',
            'document' => 'file|mimes:pdf,jpeg,png,gif'
        ]);
        $invoice = PurchaseInvoice::create(['supplier_id' => $request->input('fournisseur'),'date'=>$request->input('date'),'date_echeance'=>$request->input('date_echeance'),'etat_paiement'=>$request->input('etat_paiement'),'moyen_paiement'=>$request->input('moyen_paiement'),'no_cheque'=>$request->input('n_cheque'),'no_virement'=>$request->input('n_virement'),'type'=>$request->input('type')]);
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('purchase_invoices');
            $invoice->document = $path;
            $invoice->save();
        }
        if ($request->input('type')=='produit'){
            if($request->input('Products'))
            {
                $products = $request->input('Products');

                foreach($products as $product){
                    $invoice->purchaseItems()->save(new PurchaseItem(['invoice_id'=>$invoice->id,'product_id'=>$product['product_id'],'quantite'=>$product['quantity'],'prix_unitaire'=>floatval($product['price'])]));
                }
            }
            Session::flash('status', "la facture a été ajoutée avec succès");
            return redirect()->route('purchase.index');

        }else{
            $serivce = Service::create([
                'nom' => $request->input('nom'),
                'description' =>  $request->input('description'),
                'type' => 'acheté',
                'supplier_id' => $request->input('fournisseur'),
                'prix' => floatval( $request->input('prix') ),
            ]);
            if($serivce){
                $invoice->purchaseItems()->save(new PurchaseItem(['invoice_id'=>$invoice->id,'service_id'=>$serivce->id]));
            }

            Session::flash('status', "la facture a été ajoutée");

        }
        return redirect()->route('purchase.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice=PurchaseInvoice::find($id);
        return view('purchase-invoices.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $invoice=PurchaseInvoice::find($id);
        $suppliers = Supplier::all();
        return view('purchase-invoices.edit',compact('suppliers','invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice= PurchaseInvoice::findOrFail($id);

        $invoice->supplier_id=$request->input('fournisseur');
        $invoice->date=$request->input('date');
        $invoice->date_echeance=$request->input('date_echeance');
        if($request->input('etat_paiement') == 'Payée' ){
            $invoice->etat_paiement='Payée';
            if($request->input('moyen_paiement')=='chèque'){
                $invoice->moyen_paiement='chèque';
                if($request->input('n_cheque')){
                    $invoice->no_cheque=$request->input('n_cheque');
                    $invoice->no_virement=null;

                }

            }elseif($request->input('moyen_paiement')=='virement'){
                $invoice->moyen_paiement='virement';
                if($request->input('n_virement')){
                    $invoice->no_virement=$request->input('n_virement');
                    $invoice->no_cheque=null;

                }
            }
            else{
                $invoice->moyen_paiement='espèce';
                $invoice->no_cheque=null;
                $invoice->no_virement=null;


            }
      }else{
        $invoice->etat_paiement='En attente';
        $invoice->moyen_paiement=null;
        $invoice->no_cheque=null;
        $invoice->no_virement=null;
      }

      if($request->hasFile('document')){
        if($invoice->document){
            Storage::delete($invoice->document);
        }
        $path = $request->file('document')->store('purchase_invoices');
        $invoice->document = $path;
      }

      if($invoice->save()){
        Session::flash('status', "la facture a été modifiée avec succès");
      }
      return redirect()->route('purchase.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice=PurchaseInvoice::findOrfail($id);
        if (($invoice->delete()))
        {
         $invoice->purchaseItems()->delete();
            Session::flash('status', "la facture a été supprimée avec succès ");
        }
        return redirect()->route('purchase.index');
    }

    public function forcedelete(string $id)
    {
        if(PurchaseInvoice::find($id)->forcedelete()){
            return redirect()->route('purchase.index');
        }
    }

    public function download(string $id)
    {
        $invoice = PurchaseInvoice::find($id);
        return Storage::download($invoice->document);
    }

    public function restore($id)
    {
        $invoice = PurchaseInvoice::onlyTrashed()->find($id);

        if ($invoice) {
            $invoice->restore();
        }

        return redirect()->back();
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $number = $request->input('number');
        $tab='index';
        $invoices = PurchaseInvoice::where('date', 'LIKE', "%$keyword%")
        ->orWhere('date_echeance', 'LIKE', "%$keyword%")
        ->orWhere('type', 'LIKE', "%$keyword%")
        ->orWhere('date', 'LIKE', "%$keyword%")
        ->orWhere('date_echeance', 'LIKE', "%$keyword%")
        ->orWhere('etat_paiement', 'LIKE', "%$keyword%")


        ->orWhereHas('supplier', function ($query) use ($keyword) {
            $query->where('nom', 'LIKE', "%$keyword%");
        })
        ->paginate($number)
        ->appends(['keyword' => $keyword, 'number' => $number]);

    return view('purchase-invoices.index', compact('invoices','tab'));
    }

}
