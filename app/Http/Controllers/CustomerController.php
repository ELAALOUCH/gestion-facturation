<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\SimpleExcel\SimpleExcelWriter;
use PDF;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:client');
        $this->middleware('permission:creer')->only(['create','store']);
        $this->middleware('permission:editer')->only(['edit','update']);
        $this->middleware('permission:archiver')->only(['destroy']);
        $this->middleware('permission:archive')->only(['archive']);
        $this->middleware('permission:restaurer')->only(['restore']);
    }
    public function index()
    {
        $customers= Customer::paginate(5);
        $tab='index';
        return view('customers.index',compact('customers','tab'));
    }
    public function create()
    {
        return view('customers.create');
    }

    public function archive()
    {
        $customers= Customer::onlyTrashed()->paginate(5);
        $tab = 'archive';
        return view('customers.archive',compact('customers','tab'));
    }

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
        $customer = new Customer();
        $customer->ice = $request->input('ice');
        $customer->nom = $request->input('nom');
        $customer->telephone = $request->input('telephone');
        $customer->ville = $request->input('ville');
        $customer->email = $request->input('email');
        $customer->site_web = $request->input('site_web');
        $customer->adresse = $request->input('adresse');
        $customer->save();
        if ($customer->save()) {
            Session::flash('status', "Le client a été ajouté avec succès ");
        }
        return redirect()->route('customer.index');

    }

    public function edit(string $id)
    {
        return view('customers.edit',[
            'customer' =>Customer::find($id)
        ]);
    }
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
        $customer = Customer::find($id);
        $customer->ice = $request->input('ice');
        $customer->nom = $request->input('nom');
        $customer->telephone = $request->input('telephone');
        $customer->email = $request->input('email');
        $customer->ville = $request->input('ville');

        $customer->site_web = $request->input('site_web');
        $customer->adresse = $request->input('adresse');
        $customer->save();
        if ($customer->save()) {
            Session::flash('status', "Le client a été modifié avec succès");
        }
        return redirect()->route('customer.index');
      }

      public function destroy(string $id)
      {
          $customer = Customer::find($id);

          if ($customer) {
              $customer->invoices()->delete();

              $customer->delete();

              Session::flash('status', "Le client a été supprimé");
          }

          return redirect()->route('customer.index');
      }


      public function restore($id)
      {
          $customer = Customer::withTrashed()->find($id);

          if ($customer) {
              $customer->restore();

              $customer->invoices()->restore();
          }

          return redirect()->back();
      }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $number = $request->input('number');
        $tab='index';
        $customers = Customer::where('email', 'LIKE', "%$keyword%")
                            ->orWhere('telephone', 'LIKE', "%$keyword%")
                            ->orWhere('code_client', 'LIKE', "%$keyword%")
                            ->orWhere('nom', 'LIKE', "%$keyword%")
                            ->orWhere('ice', 'LIKE', "%$keyword%")
                            ->orWhere('adresse', 'LIKE', "%$keyword%")
                            ->orWhere('ville', 'LIKE', "%$keyword%")
                            ->orWhere('site_web', 'LIKE', "%$keyword%")
                            ->paginate($number)
                            ->appends(['keyword' => $keyword, 'number' => $number]);

        return view('customers.index', compact('customers','tab'));
    }

    public function exportCustomers()
    {

    $customers = Customer::select('code_client','ice','nom','telephone','adresse','ville','site_web')->get();

    $excel = SimpleExcelWriter::streamDownload('customers.xlsx');

    $excel->addRows($customers->toArray());

    $excel->toBrowser();

    }

    public function exportPdf()
    {
    $customers = Customer::all();

    $pdf = PDF::loadView('pdf.pdf-customers', ['customers' => $customers]);

    return $pdf->download('customers.pdf');
    }

}
