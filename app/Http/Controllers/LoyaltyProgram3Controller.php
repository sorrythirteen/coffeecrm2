<?php

namespace App\Http\Controllers;

use App\LoyaltyProgram3;
use Illuminate\Http\Request;

class LoyaltyProgram3Controller extends Controller
{
    public function index()
    {
        $programs = LoyaltyProgram3::all();
        return view('crm3.loyaltyprograms.index', compact('programs'));
    }

    public function create()
    {
        return view('crm3.loyaltyprograms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'type' => 'required|string|max:50',
            'discount_rate' => 'nullable|numeric|min:0|max:100',
            'points_per_currency' => 'nullable|numeric|min:0',
        ]);

        LoyaltyProgram3::create($data);

        return redirect()->route('crm3.loyaltyprograms.index')->with('success', 'Программа лояльности создана');
    }

    public function show(LoyaltyProgram3 $loyaltyProgram3)
    {
        return view('crm3.loyaltyprograms.show', compact('loyaltyProgram3'));
    }

    public function edit(LoyaltyProgram3 $loyaltyProgram3)
    {
        return view('crm3.loyaltyprograms.edit', compact('loyaltyProgram3'));
    }

    public function update(Request $request, LoyaltyProgram3 $loyaltyProgram3)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'type' => 'required|string|max:50',
            'discount_rate' => 'nullable|numeric|min:0|max:100',
            'points_per_currency' => 'nullable|numeric|min:0',
        ]);

        $loyaltyProgram3->update($data);

        return redirect()->route('crm3.loyaltyprograms.index')->with('success', 'Программа лояльности обновлена');
    }

    public function destroy(LoyaltyProgram3 $loyaltyProgram3)
    {
        $loyaltyProgram3->delete();

        return redirect()->route('crm3.loyaltyprograms.index')->with('success', 'Программа лояльности удалена');
    }
}
