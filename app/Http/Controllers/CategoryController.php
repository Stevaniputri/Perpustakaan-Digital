<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function generatePDF($view, $data, $filename)
    {

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view($view, $data)->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($filename);
    }

    public function exportCategoriesPDF()
    {
        $categories = Category::all();
        return $this->generatePDF('pdf.category', compact('categories'), 'categorys.pdf');
    }

    public function category()
    {
        $dataCategories = Category::all();
        return view('Book.category', compact('dataCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category')->with('success', 'Berhasil menambahkan kategori');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category')->with('success', 'Berhasil memperbarui kategori');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::where('id', '=', $id)->delete();
        return redirect()->back();
    }
}
