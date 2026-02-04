<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view("admin.menus.index", compact("menus"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $categories = Category::all();
       return view('admin.menus.create' ,compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuStoreRequest $request)
{
    $imagePath = $request->file('image')->store('menus', 'public');

   $menu = Menu::create([
    'name' => $request->name,
    'description' => $request->description,
    'image' => $imagePath,
    'price' => $request->price,
    'status' => $request->status ?? 'available',
]);


    if ($request->has('categories')) {
        $menu->categories()->attach($request->categories);
    }

    return to_route('admin.menues.index');
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
    public function edit(Menu $menu)
{
    $categories = Category::all();
    return view('admin.menus.edit', compact('menu', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
       $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required'
    ]);

    $image = $menu->image;
    if ($request->hasFile('image')) {
       
        Storage::disk('public')->delete($menu->image);
        $image = $request->file('image')->store('menus', 'public');
    }

   
    $menu->update([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $image,  // either old or new path
        'price'=> $request->price,
        'status' => $request->status

    ]);


     if ($request->has('categories')) {
        $menu->categories()->sync($request->categories);
    }
return to_route('admin.menues.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
{
    // delete the image
    Storage::disk('public')->delete($menu->image);

    // detach related categories
    $menu->categories()->detach();

    // delete menu
    $menu->delete();

    return to_route('admin.menues.index');
}

}
