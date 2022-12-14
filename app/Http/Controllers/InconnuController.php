<?php

namespace App\Http\Controllers;

use App\Models\Inconnu;
use Illuminate\Http\Request;

class InconnuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incos = Inconnu::latest()->get();
        
       return view('layouts.inco', compact('incos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nomcomplet' => 'required|max:255',
            'adresse' => 'required|max:255',
            'telephone' => 'required|max:255',
            'genre' => 'required|max:255',
            'motif' => 'required|max:255',
        ]);

        $inco = Inconnu::create([
            'nomcomplet' => $request->nomcomplet,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'genre' => $request->genre,
            'motif' => $request->motif,
    
           ]);

           return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate ([
            'nomcomplet' => 'required|max:255',
            'adresse' => 'required|max:255',
            'telephone' => 'required|max:255',
            'genre' => 'required|max:255',
            'motif' => 'required|max:255',
        ]);

        Inconnu::whereId($id)->update($validateData);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inco = Inconnu::findOrFail($id);
        $inco->delete();
        return redirect()->back();
    }
}
