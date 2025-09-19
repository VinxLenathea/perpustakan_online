<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    /**
     * Tampilkan halaman utama library dengan pencarian, filter, dan pagination
     */
    public function index(Request $request)
    {
        // Awali dengan query builder
        $query = DocumentModel::with(['category']);

        // 🔍 Search keyword
        if ($request->filled('keyword') && $request->filled('filter')) {
            $keyword = $request->keyword;
            $filter = $request->filter;

            if ($filter == 'judul') {
                $query->where('title', 'LIKE', "%{$keyword}%");
            } elseif ($filter == 'penulis') {
                $query->where('author', 'LIKE', "%{$keyword}%");
            } elseif ($filter == 'tahun') {
                $query->where('year_published', 'LIKE', "%{$keyword}%");
            }
        }

        // 📂 Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // ✅ Pagination (10 data per halaman)
        $documents = $query->paginate(10)->withQueryString();

        $categories = CategoryModel::all();
        $subcategories = SubcategoryModel::all();

        return view('library', compact('documents', 'categories', 'subcategories'));
    }

    /**
     * Form tambah document
     */
    public function create()
    {
        $categories = CategoryModel::all();
        $subcategories = SubcategoryModel::all();

        return view('library_create', compact('categories', 'subcategories'));
    }

    /**
     * Simpan document baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'author'          => 'required|string|max:255',
            'year_published'  => 'required|integer|min:1900|max:2099',
            'category_id'     => 'required|exists:categories,id',
            'subcategory_id'  => 'nullable|exists:subcategories,id',
            'file'            => 'nullable|mimes:pdf,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
        }

        DocumentModel::create([
            'title'          => $request->title,
            'author'         => $request->author,
            'year_published' => $request->year_published,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'file_url'       => $filePath,
        ]);

        return redirect()->route('library')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Form edit document
     */
    public function edit($id)
    {
        $document = DocumentModel::findOrFail($id);
        $categories = CategoryModel::all();
        $subcategories = SubcategoryModel::all();

        return view('library_edit', compact('document', 'categories'));
    }

    /**
     * Update document
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'author'          => 'required|string|max:255',
            'year_published'  => 'required|integer|min:1900|max:2099',
            'category_id'     => 'required|exists:categories,id',
            'subcategory_id'  => 'nullable|exists:subcategories,id',
            'file'            => 'nullable|mimes:pdf,png|max:2048',
        ]);

        $document = DocumentModel::findOrFail($id);

        $document->title          = $request->title;
        $document->author         = $request->author;
        $document->year_published = $request->year_published;
        $document->category_id    = $request->category_id;
        $document->subcategory_id = $request->subcategory_id;

        // 📂 Jika ada file baru
        if ($request->hasFile('file')) {
            // hapus file lama (jika ada)
            if ($document->file_url && Storage::disk('public')->exists($document->file_url)) {
                Storage::disk('public')->delete($document->file_url);
            }

            // simpan file baru
            $path = $request->file('file')->store('documents', 'public');
            $document->file_url = $path;
        }

        $document->save();

        return redirect()->route('library')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Hapus document
     */
    public function destroy($id)
    {
        $document = DocumentModel::findOrFail($id);

        // hapus file di storage juga
        if ($document->file_url && Storage::disk('public')->exists($document->file_url)) {
            Storage::disk('public')->delete($document->file_url);
        }

        $document->delete();

        return redirect()->route('library')->with('success', 'Data berhasil dihapus!');
    }
}
