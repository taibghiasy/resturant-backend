<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Storage;

class MenuApiController extends Controller
{
    public function index()
    {
        return MenuResource::collection(Menu::with('categories')->get());
    }

    public function show(Menu $menu)
    {
        return new MenuResource($menu->load('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:4096',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',
            'status' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu = Menu::create($data);

        if (!empty($data['categories'])) {
            $menu->categories()->attach($data['categories']);
        }

        return new MenuResource($menu->load('categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:4096',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',
            'status' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        if (isset($data['categories'])) {
            $menu->categories()->sync($data['categories']);
        }

        return new MenuResource($menu->load('categories'));
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->categories()->detach();
        $menu->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }
}
