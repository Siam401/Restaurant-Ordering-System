<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tableno;
use Session;

class TablenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tablenos=Tableno::all();

        return view('backend.tables.index',compact('tablenos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        // dd($data);
        Tableno::create($data);
        Session::flash('message','Tableno created successfully');
        return redirect(route('table.index'));
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
        $tableno=Tableno::findOrFail($id);

        return view('backend.tables.edit',compact('tableno'));
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
        $tableno=Tableno::findOrfail($id);
        $data=$request->except('_token','_method');
        // dd($data);
        $tableno->update($data);
        Session::flash('message','Updated successfully');
        return redirect(route('table.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $tableno=Tableno::findOrfail($id);
        $tableno->delete();
        Session::flash('message','Deleted successfully');
        return redirect(route('table.index'));
    }
}
