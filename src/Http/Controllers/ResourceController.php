<?php

namespace Broswilli\LaravelYmlRoutes\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Resource Index page response';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'Resource create page response';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->input('sample')){
            return redirect()->route('resc.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->input('sample')){
            return redirect()->route('resc.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('resc.index');
    }
}
