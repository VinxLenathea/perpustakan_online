<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use App\Models\Category;
use App\Models\categoryModel;
use App\Models\Subcategory;
use App\Models\subcategoryModel;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    // Menampilkan halaman utama library
    public function index()
    {
        $documents = DocumentModel::all();
        $categories = categoryModel::all();
        $subcategories = subcategoryModel::all();

        return view('library', compact('documents', 'categories', 'subcategories'));
    }

    // Form tambah buku/documents
    public function create()
    {
        $categories = categoryModel::all();
        $subcategories = subcategoryModel::all();

        return view('library', compact('categories', 'subcategories'));
    }

    // Proses simpan ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'year_published' => 'nullable|digits:4',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
        }

        DocumentModel::create([
            'title' => $request->title,
            'author' => $request->author,
            'year_published' => $request->year_published,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'file_url' => $filePath
        ]);

        return redirect()->route('library')->with('success', 'Data berhasil ditambahkan!');
    }
    public function destroy($id)
        {
            $document = DocumentModel::findOrFail($id);
            $document->delete();

            return redirect()->route('library')->with('success', 'Data berhasil dihapus!');
        }

}
