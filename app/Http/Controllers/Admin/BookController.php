<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderByDesc('created_at')->paginate(10);

        return view('admin.books', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:64', 'unique:books,isbn'],
            'published_at' => ['nullable', 'date'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $validated['cover_path'] = $path;
        }

        Book::create($validated);

        return redirect()->route('admin.books')->with('status', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:64', 'unique:books,isbn,'.$book->id],
            'published_at' => ['nullable', 'date'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }
            $path = $request->file('cover')->store('covers', 'public');
            $validated['cover_path'] = $path;
        }

        $book->update($validated);

        return redirect()->route('admin.books')->with('status', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_path) {
            Storage::disk('public')->delete($book->cover_path);
        }
        $book->delete();

        return redirect()->route('admin.books')->with('status', 'Buku berhasil dihapus.');
    }
}
