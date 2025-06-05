<?php

namespace App\Http\Controllers;

use App\Models\HackathonsDisponiveis;
use Illuminate\Http\Request;

class HackathonsDisponiveisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('hackathons_disponiveis.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hackathons_disponiveis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Implementaremos depois
    }

    /**
     * Display the specified resource.
     */
    public function show(HackathonsDisponiveis $hackathonsDisponiveis)
    {
        // Implementaremos depois
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HackathonsDisponiveis $hackathonsDisponiveis)
    {
        // Implementaremos depois
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HackathonsDisponiveis $hackathonsDisponiveis)
    {
        // Implementaremos depois
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HackathonsDisponiveis $hackathonsDisponiveis)
    {
        // Implementaremos depois
    }
}