<?php

namespace App\Http\Controllers;

use App\Models\RamfAppVersion;
use Illuminate\Http\Request;

class RamfAppVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeApi(Request $request)
    {
        // $data = [
        //     'app' => 'static_app',
        //     'web_api' => 'static_web_api',
        //     'built' => 'static_built',
        //     'app_full_name' => 'static_app_full_name',
        //     'comment' => 'static_comment',
        // ];
        // $appVersion = RamfAppVersion::create($data);



        $validatedData = $request->validate([
            'app' => 'required|string|max:255',
            'web_api' => 'required|string|max:255',
            'built' => 'required|string|max:255',
            'app_full_name' => 'required|string|max:255',
            'comment' => 'nullable|string|max:255',
        ]);

        $appVersion=RamfAppVersion::create($validatedData);

        // Return a response
        return response()->json([
            'message' => 'app Version created successfully',
            'app version' => $appVersion,
        ], 201);
    }


    public function storeWeb(Request $request)
    {
        // dd('hello');
        $validatedData = $request->validate([
            'app' => 'required|string|max:255',
            'web_api' => 'required|string|max:255',
            'built' => 'required|string|max:255',
            'app_full_name' => 'required|string|max:255',
            'comment' => 'nullable|string|max:255',
        ]);
        // dd($validatedData);

        RamfAppVersion::create($validatedData);

        return redirect()->route('ramfapp.create', ['active_tab' => 'tab3'])->with('success', 'Ramf App Version created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(RamfAppVersion $appVersion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RamfAppVersion $appVersion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RamfAppVersion $appVersion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RamfAppVersion $appVersion)
    {
        //
    }
}
