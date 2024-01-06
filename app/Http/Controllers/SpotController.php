<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpotController extends Controller
{
    const MAX_STRING_LENGTH = 255;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spots = Spot::orderBy('id')->paginate(25);
        return view('spots.index', ["spots" => $spots]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|integer',
            'city' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);

        // Upload da imagem
        $name = $request->file('image')->getClientOriginalName();
        $request->file('image')->store('public/images');

        // Criação de uma nova instância do modelo Spot
        $spot = new Spot;
        $spot->name = $request->input('name');
        $spot->cost = $request->input('cost');
        $spot->city = $request->input('city');
        $spot->path = $request->file('image')->hashName();
        $spot->description = $request->input('description');
        $spot->user_id = Auth::id(); //auth da o user autenticado

        // Guarda na base de dados
        $spot->save();

        return redirect()->back()->with('status', 'Spot cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spot $spot)
    {
        $slots = $spot->slots;
        $comments = $spot->comments;

        return view('spots.show', [
            'spot' => $spot,
            'slots' => $slots,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spot $spot)
    {
        return view('spots.edit', ['spot' => $spot]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot)
    {
        $spot->update($request->all());
        return redirect('/spots');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot)
    {
        $spot->delete();
        return redirect('/spots');
    }

    public function session(Spot $spot)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => $spot->name,
                        ],
                        'unit_amount'  => $this->calcCost($spot),
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('success'),
        ]);

        return redirect()->away($session->url);
    }



    public function success()
    {
        return view('grateful');
    }

    public function calcCost(Spot $spot)
    {
        return $spot->cost * 100;
    }
}
