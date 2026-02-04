<?php

namespace App\Http\Controllers;

use App\Models\SignatureDish;
use Illuminate\Http\Request;

class SignatureDishController extends Controller
{
    public function index()
    {
        $dishes = SignatureDish::orderBy('id','desc')->get();
        return view('admin.signature_dishes.index', compact('dishes'));
    }

    public function create()
    {
        return view('admin.signature_dishes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/signature_dishes'), $imageName);
            $data['image_url'] = '/uploads/signature_dishes/'.$imageName;
        }

        SignatureDish::create($data);

        return redirect()->route('admin.signature-dishes.index')->with('success', 'Signature dish added successfully!');
    }

    public function edit(SignatureDish $signatureDish)
    {
        return view('admin.signature_dishes.edit', compact('signatureDish'));
    }

    public function update(Request $request, SignatureDish $signatureDish)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/signature_dishes'), $imageName);
            $data['image_url'] = '/uploads/signature_dishes/'.$imageName;
        }

        $signatureDish->update($data);

        return redirect()->route('admin.signature-dishes.index')->with('success', 'Signature dish updated successfully!');
    }

    public function destroy(SignatureDish $signatureDish)
    {
        $signatureDish->delete();
        return redirect()->route('admin.signature-dishes.index')->with('success', 'Signature dish deleted successfully!');
    }
}
