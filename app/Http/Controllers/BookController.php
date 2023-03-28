<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->middleware('can:delete-book')->only(['destroy']);
        $this->middleware('can:create-book')->only(['store']);
        $this->middleware('can:edit-book')->only(['update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'publisher' => 'required',
            'published_date' => 'required',
            'page_count' => 'required',
            'language' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $image_name);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'publisher' => $request->publisher,
            'published_date' => $request->published_date,
            'description' => $request->description,
            'page_count' => $request->page_count,
            'language' => $request->language,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'image' => $image_name, 
        ]);

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if(!$book)
            return response()->json([
                'message' => 'Book not found',
            ], 404);
        return response()->json([
            'book' => $book,
            'message' => 'Book found successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $book = Book::find($id);
        if(!$book)
            return response()->json([
                'message' => 'Book not found',
            ], 404);

            if($request->hasFile('image')){

                //delete old image
                $oldImage = public_path('images/').$book->image;
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }

                //upload new image
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $image_name);
                $book->image = $image_name;
            }
          


        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'publisher' => $request->publisher,
            'published_date' => $request->published_date,
            'description' => $request->description,
            'page_count' => $request->page_count,
            'language' => $request->language,
            'user_id' => 1,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'image' =>$book->image, 
        ]);
        
        return response()->json([
            'message' => 'Book updated successfully',
            'book' => $book,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        $image = public_path('images/').$book->image;
        if (file_exists($image)) {
            unlink($image);
        }

        return response()->json([
            'message' => 'Book deleted successfully',
            'book' => $book,
        ]);

        if(!$book)
        return response()->json([
            'message' => 'Book not found',
        ], 404);
    }

}
