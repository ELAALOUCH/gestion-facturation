<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use NumberToWords\NumberToWords;
use Symfony\Component\Console\Input\Input;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::paginate(5);
        $tab='index';

        return view('invoices.index',compact('invoices','tab'));
    }

    public function archive()
    {

        $invoices= Invoice::onlyTrashed()->paginate(5);
        $tab = 'archive';
        return view('invoices.archive',compact('invoices','tab'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentYear = now()->year;
        $lastInvoice = Invoice::withTrashed()->whereYear('created_at', $currentYear)->orderByDesc('created_at')->first();

        if ($lastInvoice) {
            // Obtenir le numéro après le dernier '/' dans la colonne 'number' de la dernière facture
            $lastInvoiceNumber = $lastInvoice->numero;
            $lastInvoiceNumber = intval(substr($lastInvoiceNumber, strpos($lastInvoiceNumber, '/') + 1));

            $numero = $currentYear . '/' . str_pad($lastInvoiceNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $numero = $currentYear . '/001';
        }

        $customers = customer::all();
        $currentDate=Carbon::today()->toDateString();
        $products = Product::all();
        $services = Service::all();

        return view('invoices.create',compact('customers','currentDate','numero','products','services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $numero=$request->input('numero');
        $customer_id = $request->input('client');
        $type = $request->input('type');
        $date = $request->input('date');
        $type_produit = $request->input('type_produit');
        $date_echeance = $request->input('date_echeance');
        $tva = $request->input('tva');
        $total_ht=0;
        if ($request->input('type_produit')=='produit'){
            foreach($request->input('Products') as $product){
                $total_ht += $product['price']*$product['quantity'];
            }
        }else{
            foreach($request->input('Services') as $service){
                $total_ht += $service['price']*$service['quantity'];
            }
        }
        $total_tva = $total_ht +  $total_ht *$tva/100;
        $invoice = Invoice::create(['numero'=>$numero,'customer_id'=>$customer_id,'type'=>$type,'date'=>$date,'date_echeance'=>$date_echeance,'tva'=>$tva,'total_ht'=>$total_ht,'total_tva'=>$total_tva,'type_produit'=>$type_produit,'etat_paiement'=>$request->input('etat_paiement'),'moyen_paiement'=>$request->input('moyen_paiement'),'no_cheque'=>$request->input('n_cheque'),'no_virement'=>$request->input('n_virement')]);

        if($invoice){
            if ($request->input('type_produit')=='produit'){
                foreach($request->input('Products') as $product){
                    $invoice->orders()->save(new Order(['invoice_id'=>$invoice->id,'product_id'=>$product['product_id'],'quantite'=>$product['quantity'],'prix'=>floatval($product['price'])]));
                }
            }else{
                foreach($request->input('Services') as $service){
                    $invoice->orders()->save(new Order(['invoice_id'=>$invoice->id,'service_id'=>$service['service_id'],'quantite'=>$service['quantity'],'prix'=>floatval($service['price'])]));
                }
            }
            Session::flash('status', "La facture a été ajoutée avec succès");
        }
        return redirect()->route('invoice.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Auth::user()->company;
        $invoice=Invoice::findOrFail($id);
        $numberToWords = new NumberToWords();

        $numberTransformer = $numberToWords->getNumberTransformer('fr');

        $integerPart = floor($invoice->total_tva);
        $decimalPart = round(($invoice->total_tva - $integerPart) * 100);

        $integerWords = $numberTransformer->toWords($integerPart);
        $decimalWords = $numberTransformer->toWords($decimalPart);
        return view('invoices.show',compact('invoice','company','integerWords','decimalWords'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customers = customer::all();
        $invoice = Invoice::findOrfail($id);
        return view('invoices.edit',compact('invoice','customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->customer_id = $request->input('client');
        $invoice->customer_id = $request->input('client');
        $invoice->date = $request->input('date');
        $invoice->date_echeance = $request->input('date_echeance');
        $invoice->type = $request->input('type');
        $invoice->tva = $request->input('tva');

        $invoice->total_tva = $invoice->total_ht +  $invoice->total_ht * $request->input('tva')/100;



        if($request->input('etat_paiement') == 'payé' ){
            $invoice->etat_paiement='payé';
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
            }
      }else{
        $invoice->etat_paiement='en attente';
        $invoice->moyen_paiement=null;
        $invoice->no_cheque=null;
        $invoice->no_virement=null;
      }

     if( $invoice->save()){
        Session::flash('status', "La facture a été modifié avec succès");
      }

      return redirect()->route('invoice.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Invoice::find($id)->delete()){
            return redirect()->route('invoice.index');
        }

    }

    public function forcedelete(string $id)
    {
        if(Invoice::find($id)->forcedelete()){

            Session::flash('status', "La facture a été supprimer avec succès");

            return redirect()->route('invoice.index');
        }

    }

    public function restore($id)
    {
        $invoice = Invoice::onlyTrashed()->find($id);

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
        $invoices = Invoice::where('numero', 'LIKE', "%$keyword%")
        ->orWhere('type', 'LIKE', "%$keyword%")
        ->orWhere('type_produit', 'LIKE', "%$keyword%")
        ->orWhere('date', 'LIKE', "%$keyword%")
        ->orWhere('date_echeance', 'LIKE', "%$keyword%")

        ->orWhere('etat_paiement', 'LIKE', "%$keyword%")
        ->orWhereHas('customer', function ($query) use ($keyword) {
            $query->where('nom', 'LIKE', "%$keyword%");
        })
        ->paginate($number)
        ->appends(['keyword' => $keyword, 'number' => $number]);

    return view('invoices.index', compact('invoices','tab'));
    }

}
