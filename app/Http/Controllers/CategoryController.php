<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('viewAny', Category::class);
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
        // $this->authorize('create', Category::class);
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
        // $this->authorize('create', Category::class);
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:20',
            'description' => 'nullable|string|min:3|max:50',
            'visible' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $category = new Category();
            $category->name = $request->get('name');
            $category->description = $request->get('description');
            $category->is_visible = $request->get('visible');
            $isSaved = $category->save();
            return response()->json([
                'message' => $isSaved ? 'Category created successfully' : 'Failed to create category'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
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
        // $this->authorize('update', $category);
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
        // $this->authorize('update', $category);
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:20',
            'description' => 'nullable|string|min:3|max:50',
            'visible' => 'required|boolean'
        ]);
        if (!$validator->fails()) {
            $category->name = $request->get('name');
            $category->description = $request->get('description');
            $category->is_visible = $request->get('visible');
            $isSaved = $category->save();
            return response()->json([
                'message' => $isSaved ? 'Category updated successfully' : 'Failed to update category'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
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
        // $this->authorize('delete', $category);
        if ($category->books()->withTrashed()->exists()) {
            return response()->json([
                'title' => 'Wait! Cannot Delete',
                'icon'  => 'warning',
                'text'  => 'This category is linked to existing books. Please move or delete the books first.'
            ], Response::HTTP_BAD_REQUEST);
        }
        $isDeleted = $category->delete();
        return response()->json([
            'title' => $isDeleted ? 'Deleted successfully' : 'Deleting failed',
            'icon' => $isDeleted ? 'success' : 'error'
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
