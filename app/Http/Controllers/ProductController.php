<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\SimpleExcel\SimpleExcelWriter;
use PDF;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:produit');
        $this->middleware('permission:creer')->only(['create','store']);
        $this->middleware('permission:editer')->only(['edit','update']);
        $this->middleware('permission:archiver')->only(['destroy']);
        $this->middleware('permission:archive')->only(['archive']);
        $this->middleware('permission:restaurer')->only(['restore']);
    }
    public function index()
    {
        $user = Auth::user();

        // $products = Product::whereHas('company', function ($query) use ($user) {
        //     $query->where('company_id', $user->company_id);
        // })->paginate(5);

        // return view('product.index', compact('products'));
        $categories = Category::all();
        $products= Product::paginate(5);
        $tab='index';
        return view('products.index',compact('products','categories','tab'));
    }

    public function archive()
    {
        $products= Product::onlyTrashed()->paginate(5);
        $tab = 'archive';
        return view('products.archive',compact('products','tab'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'designation' => 'required|min:2|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif',

        ]);
        $product = new Product();
        $product->designation= $request->input('designation');
        $product->category_id= $request->input('categorie');
        $product->company_id=Auth::user()->company->id;
        $product->stock= 0;
        $product->stock_alert= $request->input('stock_alert');
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('products_pictures');
            $product->photo = $path;
        }
        if($product->save()){
            Session::flash('status', "Le produit a été ajouté avec succès.");
        }
        return redirect()->route('product.index');

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
        return view('products.edit',[
            'product'=> Product::find($id),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'designation' => 'required|min:2|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        $product = Product::find($id);
        $product->designation= $request->input('designation');
        $product->category_id= $request->input('categorie');
        $product->stock_alert= $request->input('stock_alert');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('products_pictures');
            $product->photo = $path;
        }

        if($product->save()){
            Session::flash('status', "Le produit a été modifié avec succès");
        }
        return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $orders = $product->orders;
        $purchaseItems = $product->purchaseItems;


        if ($product->delete()) {
            foreach ($orders as $order) {
                $order->delete();
            }
            foreach ($purchaseItems as $purchaseItem) {
                $purchaseItem->delete();
            }

            Session::flash('status', "Le produit a été archivé avec succès");
        }

        return redirect()->route('product.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $number = $request->input('number');
        $tab='index';
        $products = Product::select('products.*')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->where('categories.categorie', 'LIKE', "%$keyword%")
        ->orWhere('products.designation', 'LIKE', "%$keyword%")
        ->orWhere('products.stock', 'LIKE', "%$keyword%")
        ->orWhere('products.stock_alert', 'LIKE', "%$keyword%")
        ->paginate($number)
        ->appends(['keyword' => $keyword, 'number' => $number]);

        return view('products.index', compact('products', 'tab'));
    }

    public function searchArchive(Request $request)
    {
        $keyword = $request->input('keyword');
        $number = $request->input('number');
        $tab='archive';
        $products = Product::onlyTrashed()
        ->select('products.*')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where(function ($query) use ($keyword) {
            $query->where('categories.categorie', 'LIKE', "%$keyword%")
                  ->orWhere('products.designation', 'LIKE', "%$keyword%")
                  ->orWhere('products.stock', 'LIKE', "%$keyword%")
                  ->orWhere('products.stock_alert', 'LIKE', "%$keyword%");
        })
        ->paginate($number)
        ->appends(['keyword' => $keyword, 'number' => $number]);


        return view('products.archive', compact('products', 'tab'));
    }

    public function restore($id)
    {

        $product = Product::onlyTrashed()->findOrFail($id);
        $orders = $product->orders()->withTrashed()->get();
        $purchaseItems = $product->purchaseItems()->withTrashed()->get();

        if ($product->restore()) {
            foreach ($orders as $order) {
                $order->restore();
            }
            foreach ($purchaseItems as $purchaseItem) {
                $purchaseItem->restore();
            }
        }

        return redirect()->back();
    }

    public function exportExcel()
    {
        $products = Product::select('id','designation','stock','stock_alert')->get();

        $excel = SimpleExcelWriter::streamDownload('products.xlsx');

        $excel->addRows($products->toArray());

        $excel->toBrowser();
    }
    public function exportPdf()
    {
    $products = Product::all();

    $pdf = PDF::loadView('pdf.pdf-products', ['products' => $products]);

    return $pdf->download('producs.pdf');
    }
}
