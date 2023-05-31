<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChirpRequest;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Chirp::class, 'chirp');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChirpRequest $request): RedirectResponse
    {
        $request->user()->chirps()->create($request->validated());

        return to_route('chirps.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreChirpRequest $request, Chirp $chirp): RedirectResponse
    {
        $chirp->update($request->validated());

        return to_route('chirps.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $chirp->delete();

        return to_route('chirps.index');
    }
}
