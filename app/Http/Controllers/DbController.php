<?php

namespace AppOperations\Http\Controllers;

use AppOperations\Country;
use AppOperations\Db;
use AppOperations\Person;
use Illuminate\Http\Request;

class DbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbs = Db::all();
        return view('db.index', compact('dbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $providers = Person::all()->where('id_tp_person','=', '2');
        $analysts = Person::all()->where('id_tp_person','=', '1');
        return view('db.create', compact('countries', 'providers', 'analysts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $db = new Db();
        $db->id_country = $request->id_country;
        $db->id_provider = $request->id_provider;
        $db->id_analyst = $request->id_analyst;
        $db->name = $request->name;
        $db->description = $request->description;
        if($request->statiscal = 'NO'){
            $db->statistical = 0;
        }else{
            $db->statistical = 1;
        }
        $db->exchange = $request->exchange;
        $db->type = $request->type;
        $db->initial_period = explode('/',$request->initial_period)[1] . explode('/',$request->initial_period)[0];
        $db->final_period = explode('/',$request->final_period)[1] . explode('/',$request->final_period)[0];
        $db->num_records = $request->num_records;
        $db->arrived_date = date($request->arrived_date);
        if($request->proccesed_date != '')
            $db->proccesed_date = date($request->proccesed_date);

        $db->save();

        return redirect('/dbs/')->with('status', 'Registro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $db = Db::find($id);
        $countries = Country::all();
        $providers = Person::all()->where('id_tp_person','=', '2');
        $analysts = Person::all()->where('id_tp_person','=', '1');
        return view('db.edit', compact('db', 'countries', 'providers', 'analysts'));
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
        $db = Db::find($id);
        $db->id_country = $request->id_country;
        $db->id_provider = $request->id_provider;
        $db->id_analyst = $request->id_analyst;
        $db->name = $request->name;
        $db->description = $request->description;
        if($request->statiscal = 'NO'){
            $db->statistical = 0;
        }else{
            $db->statistical = 1;
        }
        $db->exchange = $request->exchange;
        $db->type = $request->type;
        $db->initial_period = explode('/',$request->initial_period)[1] . explode('/',$request->initial_period)[0];
        $db->final_period = explode('/',$request->final_period)[1] . explode('/',$request->final_period)[0];
        $db->num_records = $request->num_records;
        $db->arrived_date = date($request->arrived_date);
        if($request->proccesed_date != '')
            $db->proccesed_date = date($request->proccesed_date);
        else
            $db->proccesed_date = null;

        $db->save();

        return 'Guardado';
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
