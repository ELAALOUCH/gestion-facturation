<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie' => 'required|string|min:2|max:255',
        ]);

        $category = new Category();
        $category->categorie = $request->categorie;
        if ($category->save())
        {
            Session::flash('status', "la catégorie a été ajoutée");

        }
        return redirect()->route('category.index');

    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('categories.edit',[
            'category' =>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'categorie' => 'required|string|min:2|max:255',
        ]);
        $category = Category::find($id);
        $category->categorie = $request->categorie;
        if ($category->save())
        {
            Session::flash('status', "la catégorie a été modifiée");

        }
        return redirect()->route('category.index');


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if ((Category::where('id', $id)->delete()))
        {
            Session::flash('status', "la catégorie a été supprimée");
        }
        return redirect()->route('category.index');

    }
}
