<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;


class BookController extends Controller implements HasMiddleware
{
    // call auth middleware
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    // display all Books
    public function list(): View
    {
        $items = Book::orderBy('name', 'asc')->get();
    
         return view(
            'book.list',
            [
                'title' => 'Grāmatas',
                'items' => $items
            ]
        );
    }


    // validate and save book data
    private function saveBookData(Book $book, BookRequest $request): void
    {
        $validatedData = $request->validated();
        
        $book->fill($validatedData);
        $book->categories_id = 0; // ŠIS PĒC KATEGORIJAS SADAĻAS IZVEIDOŠANAS IR JĀDZĒŠ
        $book->display = (bool) ($validatedData['display'] ?? false);
        
        //ja atjauno bildi tad izdzēš veco.
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
                $book->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }

        $book->save();
    }

    // display new Book form
    public function create(): View
    {
        $authors = Author::orderBy('name', 'asc')->get();

        return view(
            'book.form',
            [
                'title' => 'Pievienot grāmatu',
                'book' => new Book(),
                'authors' => $authors,
            ]
        );
    }

    // create new Book entry
    public function put(BookRequest $request): RedirectResponse
    {
        $book = new Book();
        $this->saveBookData($book,$request);
        return redirect('/books');
    }

    // display Book edit form
    public function update(Book $book): View
    {
        $authors = Author::orderBy('name', 'asc')->get();

        return view(
            'book.form',
            [
                'title' => 'Rediģēt grāmatu',
                'book' => $book,
                'authors' => $authors,
            ]
        );
    }

    // update Book data
    public function patch(Book $book, BookRequest $request): RedirectResponse
    {

        $this->saveBookData($book,$request);
        return redirect('/books');
    }

    // delete Book
    public function delete(Book $book): RedirectResponse
    {
        if ($book->image) {
            unlink(getcwd() . '/images/' . $book->image);
        }
        $book->delete();
        return redirect('/books');
    }


    
    

}
