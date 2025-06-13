<?php

namespace App\Http\Controllers;

use App\Models\Customer3;
use App\Models\Review;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Review::with('customer');
        
        if ($search) {
            $query->whereHas('customer', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            })
            ->orWhere('rating', 'like', "%{$search}%")
            ->orWhere('comment', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%");
        }
        
        $reviews = $query->paginate(40);
        return view('crm3.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $customers = Customer3::all();
        return view('crm3.reviews.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers3,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create($validated);

        return redirect()->route('crm3.reviews.index')->with('success', 'Отзыв добавлен!');
    }

    public function show(Review $review)
    {
        return view('crm3.reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        $customers = Customer3::all();
        return view('crm3.reviews.edit', compact('review', 'customers'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers3,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $review->update($validated);

        return redirect()->route('crm3.reviews.index')->with('success', 'Отзыв обновлен!');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('crm3.reviews.index')->with('success', 'Отзыв удален!');
    }
}