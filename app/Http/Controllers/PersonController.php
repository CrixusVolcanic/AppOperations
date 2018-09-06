<?php

namespace AppOperations\Http\Controllers;

use AppOperations\Person;
use AppOperations\TpPerson;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\File;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::all();
        return view('persons.index', compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tpPersons = TpPerson::all();
        return view('persons.create', compact('tpPersons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = New Person();

        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $namePicture = time().$file->getClientOriginalName();
            $file->move(public_path() . '/images/persons/', $namePicture);
            $person->picture = $namePicture;
        }

        $person->name = $request->name;
        $person->id_tp_person = $request->id_tp_person;
        $person->save();

        return redirect()->route('persons.index')->with('status', 'Persona creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::find($id);
        return view('persons.show',  compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::find($id);
        $tpPersons = TpPerson::all();
        return view('persons.edit',  compact('person', 'tpPersons'));
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
        $person = Person::find($id);

        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $namePicture = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/persons/', $namePicture);
            if (file_exists(public_path() . '/images/persons/' . $person->picture)) {
                unlink(public_path() . '/images/persons/' . $person->picture);
            }
            $person->picture = $namePicture;
        }
        $person->name = $request->name;
        $person->id_tp_person = $request->id_tp_person;

        $person->save();

        /*return view('persons.show', compact('person'));*/
        return redirect('persons/' . $person->id)->with('status', 'Persona actualizada correctamente');
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
