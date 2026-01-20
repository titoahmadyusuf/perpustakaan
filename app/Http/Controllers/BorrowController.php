<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function store(Request $request, Book $book)
    {
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        Borrow::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'borrowed',
            'due_date' => now()->addDays(7),
            'fine_amount' => 0,
        ]);

        $book->decrement('stock');

        return back()->with('status', 'Buku berhasil dipinjam.');
    }

    public function processReturn(Request $request, Borrow $borrow)
    {
        if ($borrow->status !== 'borrowed' || $borrow->returned_at) {
            return back()->with('error', 'Pengembalian tidak valid.');
        }
        if (Auth::user()->role !== 'admin' && $borrow->user_id !== Auth::id()) {
            return back()->with('error', 'Pengembalian tidak valid.');
        }

        $validated = $request->validate([
            'condition' => ['required', 'in:good,damaged,lost'],
            'condition_fine' => ['nullable', 'numeric', 'min:0'],
        ]);

        $returnedAt = now();
        $fine = 0;
        if ($borrow->due_date && $returnedAt->greaterThan($borrow->due_date)) {
            $daysLate = $borrow->due_date->diffInDays($returnedAt);
            $finePerDay = 1000;
            $fine = $daysLate * $finePerDay;
        }

        $conditionFine = isset($validated['condition_fine']) ? (float) $validated['condition_fine'] : 0;
        $totalFine = $fine + $conditionFine;

        $status = $validated['condition'] === 'lost' ? 'lost' : 'returned';

        $borrow->update([
            'status' => $status,
            'returned_at' => $returnedAt,
            'fine_amount' => $totalFine,
            'condition' => $validated['condition'],
        ]);

        if ($status !== 'lost') {
            Book::where('id', $borrow->book_id)->increment('stock');
        }

        return back()->with('status', 'Buku berhasil dikembalikan.');
    }
}
