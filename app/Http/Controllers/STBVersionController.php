<?php

namespace App\Http\Controllers;

use App\Models\RamfAppVersion;
use App\Models\STBVersion;
use Illuminate\Http\Request;

class STBVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeApi()
    {
        $data = [
            'stb' => 'stb',
            'version'=>'version',
            'date'=>'date',
            'web_api' => 'web_api',
            'base_struct' => 'struct',
            'comment' => 'comment',
        ];
        $sTBVersion = STBVersion::create($data);

        // Return a response
        return response()->json([
            'message' => 'stb Version created successfully',
            'stb version' => $sTBVersion,
        ], 201);
    }

    public function storeWeb(Request $request)
    {
        $validatedData = $request->validate([
            'stb' => 'required|string|max:255',
            'version' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'web_api' => 'required|string|max:255',
            'base_struct' => 'required|string|max:255',
            'comment' => 'required|string|max:255',

        ]);
    

    

        STBVersion::create($validatedData);

        return redirect()->route('stb.create', ['active_tab' => 'tab3'])->with('success', 'STB Version created successfully');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(STBVersion $sTBVersion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(STBVersion $sTBVersion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, STBVersion $sTBVersion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(STBVersion $sTBVersion)
    {
        //
    }

}
