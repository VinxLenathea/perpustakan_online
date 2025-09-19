<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoryModel;
use App\Models\documentModel;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total dokumen
        $totalDocuments = documentModel::count();

        // Hitung dokumen per kategori
        $categories = categoryModel::withCount('documents')->get();

        return view('dashboard', compact('totalDocuments', 'categories'));
    }
}
