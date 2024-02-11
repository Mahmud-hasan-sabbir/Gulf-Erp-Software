<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('divisions')->orderBy('name','ASC')->get();
        $divisions = DB::table('divisions')->count('id');
        $districts = DB::table('districts')->count('id');
        $upazilas = DB::table('upazilas')->count('id');
        $unions = DB::table('unions')->count('id');

        $data = [
            'division' => $divisions,
            'divisions' => $data,
            'district' => $districts,
            'upazila' => $upazilas,
            'union' => $unions,
        ];

       return view('area')->with('data',$data); 
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

    public function getDistricts(Request $request)
    {
        $division_id = $request->division_id;
        $districts = DB::table('districts')->orderBy('name','ASC')->where('division_id',$division_id)->get();
        return response()->json($districts);
    }

    public function getUpazilas(Request $request)
    {
        $district_id = $request->district_id;
        $upazilas = DB::table('upazilas')->orderBy('name','ASC')->where('district_id',$district_id)->get();
        return response()->json($upazilas);
    }

    public function getThanas(Request $request)
    {
        $upazila_id = $request->upazilas_id;
        $thanas = DB::table('unions')->orderBy('name','ASC')->where('upazila_id',$upazila_id)->get();
        return response()->json($thanas);
    }

}
