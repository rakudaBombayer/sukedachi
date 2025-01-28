<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string|max:255',
            'file_name' => 'required|string|max:255',
        ]);

        Image::create($request->all());
        return redirect()->route('images.index');
    }

    public function show(Image $image)
    {
        return view('images.show', compact('image'));
    }

    public function edit(Image $image)
    {
        return view('images.edit', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'file_path' => 'required|string|max:255',
            'file_name' => 'required|string|max:255',
        ]);

        $image->update($request->all());
        return redirect()->route('images.index');
    }

    public function destroy(Image $image)
    {
        $image->delete();
        return redirect()->route('images.index');
    }
}