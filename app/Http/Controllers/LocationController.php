<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $city = Location::all();
        return response()->json(['Locations'=>$city],200);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $Location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $Location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $Location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $Location)
    {
        //
    }
}
