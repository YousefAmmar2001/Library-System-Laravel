<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('books')->get();
        return response()->view('cms.categories.index', ['categories' => $categories]);
        // return response()->view('cms.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|min:3|max:20',
            'description' => 'nullable|string|min:3|max:50',
            'visible' => 'in:on|string'
        ], [
            'name.required' => 'Please, enter category name'
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->is_visible = $request->has('visible');
        $isSaved = $category->save();
        if ($isSaved) {
            // return redirect()->route('categories.index');
            session()->flash('message', 'Category saved successfully');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response()->view('cms.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:20',
            'description' => 'nullable|string|min:3|max:50',
            'visible' => 'in:on|string'
        ]);

        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->is_visible = $request->has('visible');
        $isSaved = $category->save();
        if ($isSaved) {
            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $deleted = $category->delete();
        if ($deleted) {
            return redirect()->back();
        }
    }
}
