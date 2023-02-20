<?php

namespace App\Http\Controllers;

use App\Models\FavoriteMission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteMissionRequest;
use App\Http\Requests\UpdateFavoriteMissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class FavoriteMissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteMissionRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FavoriteMission $favoriteMission): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FavoriteMission $favoriteMission): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteMissionRequest $request, FavoriteMission $favoriteMission): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FavoriteMission $favoriteMission): RedirectResponse
    {
        //
    }
}
