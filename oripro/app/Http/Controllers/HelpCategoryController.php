<?php

namespace App\Http\Controllers;

use App\Models\HelpCategory;
use Illuminate\Http\Request;

class HelpCategoryController extends Controller
{
    public function index()
    {
        $helpCategories = HelpCategory::all();
        return view('help_categories.index', compact('helpCategories'));
    }

    public function create()
    {
        return view('help_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        HelpCategory::create($request->all());
        return redirect()->route('help_categories.index');
    }

    public function show(HelpCategory $helpCategory)
    {
        return view('help_categories.show', compact('helpCategory'));
    }

    public function edit(HelpCategory $helpCategory)
    {
        return view('help_categories.edit', compact('helpCategory'));
    }

    public function update(Request $request, HelpCategory $helpCategory)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $helpCategory->update($request->all());
        return redirect()->route('help_categories.index');
    }

    public function destroy(HelpCategory $helpCategory)
    {
        $helpCategory->delete();
        return redirect()->route('help_categories.index');
    }
}
