<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Province;
use App\Models\City;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        //dd($setting->city_id);
        return view('setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        $cities = City::all();
        $form_type = 'create';
        return view('setting.form', compact('provinces', 'cities', 'form_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $setting = Setting::create($request->all());

        return redirect(route('setting.index'));
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
        $provinces = Province::all();
        $cities = City::all();
        $setting = Setting::find($id);
        $form_type = 'update';
        return view('setting.form', compact('provinces', 'cities', 'form_type', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting = Setting::find($id);
        $setting->update($request->all());

        return redirect(route('setting.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
