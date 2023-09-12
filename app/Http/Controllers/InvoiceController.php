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
use NumberToWords\NumberToWords;
use Symfony\Component\Console\Input\Input;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentYear = now()->year;
        $lastInvoice = Invoice::whereYear('created_at', $currentYear)->orderByDesc('created_at')->first();

        if ($lastInvoice) {
            $numero = $currentYear . '/' . str_pad($lastInvoice->id + 1, 3, '0', STR_PAD_LEFT);
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
        $date_echeance = $request->input('date_echeance');
        $tva = $request->input('tva');
        $total_ht=0;
        if ($request->input('type_produit')=='produit'){
            foreach($request->input('Products') as $product){
                $total_ht += $product['price']*$product['quantity'];
            }
        }else{
            foreach($request->input('Services') as $service){
                $total_ht += $service['price'];
            }
        }
        $total_tva = $total_ht +  $total_ht *$tva/100;
        $invoice = Invoice::create(['numero'=>$numero,'customer_id'=>$customer_id,'type'=>$type,'date'=>$date,'date_echeance'=>$date_echeance,'tva'=>$tva,'total_ht'=>$total_ht,'total_tva'=>$total_tva]);

        if($invoice){
            if ($request->input('type_produit')=='produit'){
                foreach($request->input('Products') as $product){
                    $invoice->orders()->save(new Order(['invoice_id'=>$invoice->id,'product_id'=>$product['product_id'],'quantite'=>$product['quantity'],'prix'=>floatval($product['price'])]));
                }
            }else{
                foreach($request->input('Services') as $service){
                    $invoice->orders()->save(new Order(['invoice_id'=>$invoice->id,'service_id'=>$service['service_id'],'prix'=>floatval($service['price'])]));
                }
            }
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
