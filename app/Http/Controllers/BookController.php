<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $book = Book::with('category')->paginate(6); // Assuming you want 4 categories per page
        $page = $book->currentPage();
        return view('books.index', compact('book', 'page'));
    }

    public function create(){
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $existingCode = Book::where('isbn', $request->isbn)->exists();
        if ($existingCode) {
            return redirect()->route('book.create')->with('error', 'ISBN code already exists!');
        }

        $book = new Book();
        $book->subject = $request->subject;
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->record_date = $request->record_date;
        $book->status = 'active';
        $book->category_id = $request->category_id;
        $book->save();

        return redirect()->route('book.create')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('categories','book'));
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully.');
    }

    public function update(Request $request, Book $book)
    {

        $book->update([
            'subject' => $request->subject,
            'isbn' => $request->isbn,
            'title' => $request->title,
            'record_date' => $request->record_date,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('book.index')->with('success', 'Book updated successfully.');
    }
}
