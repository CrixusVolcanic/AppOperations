<?php

namespace AppOperations\Http\Controllers;

use AppOperations\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $counrty = new Country();

        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $namePicture = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/countries/', $namePicture);
        }

        $counrty->name = $request->name;
        $counrty->iso = $request->iso;
        $counrty->picture = $namePicture;
        $counrty->save();

        return redirect()->route('countries.index')->with('status', 'País creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        return view('countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('countries.edit', compact('country'));
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
        $country = Country::find($id);
        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $namePicture = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/countries/', $namePicture);
            if (file_exists(public_path() . '/images/countries/' . $country->picture)) {
                unlink(public_path() . '/images/countries/' . $country->picture);
            }
            $country->picture = $namePicture;
        }
        $country->save();
        return redirect()->route('countries.show', $country->id)->with('status', 'País actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
