<?php

namespace App\Http\Controllers;

use App\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('alumni');
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
        //

        $validator = Validator::make($request->all(), [
            'firstName' => ['required'],
            'lastName' => ['required'],
            'alumniEmail' => ['required'],
            'affiliation' => ['required'],
            'cellPhone' => ['required'],
            'streetAddressOne' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'zip' => ['required'],
        ]);

        if ($validator->fails()) {

            return redirect('/')->withErrors($validator)->withInput();
        }
        else
        {
            $alumni = new Alumni;

            $alumni->firstName = $request->input('firstName');


            $alumni->save();

        }
        echo "I got here";
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
        //
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
