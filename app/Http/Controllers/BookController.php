<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('category')->get();
        return response()->view('cms.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_visible', true)->get();
        return response()->view('cms.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'year' => 'required|numeric|digits:4',
            'language' => 'required|string|in:en,ar',
            'quantity' => 'required|integer|min:1',
            'visible' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png|size:2048',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        if (!$validator->fails()) {
            $book = new Book();
            $book->name = $request->get('name');
            $book->year = $request->get('year');
            $book->language = $request->get('language');
            $book->quantity = $request->get('quantity');
            $book->is_visible = $request->get('visible');
            // $book->image = $request->get('image');
            $book->category_id = $request->get('category_id');
            // $isSaved = Category::findOrFail($request->get('category_id'))->books()->save($book);
            $isSaved = $book->save();
            return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Failed to create new book!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::where('is_visible', true)->get();
        return response()->view('cms.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'year' => 'required|numeric|digits:4',
            'language' => 'required|string|in:en,ar',
            'quantity' => 'required|integer|min:1',
            'visible' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png|size:2048',
            'category_id' => 'required|integer|exists:categories,id'
        ]);
        if (!$validator->fails()) {
            $book->name = $request->get('name');
            $book->year = $request->get('year');
            $book->language = $request->get('language');
            $book->quantity = $request->get('quantity');
            $book->is_visible = $request->get('visible');
            // $book->image = $request->get('image');
            $book->category_id = $request->get('category_id');
            $isSaved = $book->save();
            return response()->json([
                'message' => $isSaved ? 'Book updated successfully' : 'Failed to update book'
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $deleted = $book->delete();
        return response()->json([], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
