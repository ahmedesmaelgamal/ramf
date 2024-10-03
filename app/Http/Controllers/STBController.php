<?php

namespace App\Http\Controllers;

use App\Models\RamfApp;
use App\Models\STB;
use App\Models\STBVersion;
use Illuminate\Http\Request;

class STBController extends Controller
{


    public function storeApi()
    {
        $data = [
            'ret_code' => 'static_ret_code',
            'stb_name' => 'RAMF APP',
            'stb_version_id' => 1, // Assuming version_id 1 exists
            'card_inserted'=>false,
            'channels_exist'=>false,
            'streaming_channel'=>true,
            'events'=>true,
            'sleep'=>false,
            'serial' => 'serial',
            'download_link' => 'download_link',


        ];
        $sTB = STB::create($data);
        return response()->json([
            'message' => 'STB created successfully',
            'stb' => $sTB,
        ], 201);
    }

    public function storeWeb(Request $request)
    {
        $validatedData = $request->validate([
            'ret_code' => 'required|string|max:255',
            'stb_name' => 'required|string|max:255',
            'stb_version_id' => 'required|exists:s_t_b_versions,id',  // Update this line
            'card_inserted' => 'boolean',
            'channels_exist' => 'boolean',
            'streaming_channel' => 'boolean',
            'serial' => 'required|string|max:255',
            'download_link' => 'required|string|max:255',
            'events' => 'boolean',
            'sleep' => 'boolean',
        ]);
    
        // Convert checkbox values to boolean
        $validatedData['card_inserted'] = $request->has('card_inserted');
        $validatedData['channels_exist'] = $request->has('channels_exist');
        $validatedData['streaming_channel'] = $request->has('streaming_channel');
        $validatedData['events'] = $request->has('events');
        $validatedData['sleep'] = $request->has('sleep');
    
        $stb = STB::create($validatedData);
    
        return redirect()->route('stb.create', ['active_tab' => 'tab3'])->with('success', 'STB created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function getVersion(RamfApp $sTB)
    {
        // $lastRamfApp = RamfApp::latest()->first();
        $lastSTB = STB::with('STBVersion')->latest()->first();

        return response()->json([
            // 'stb' => $lastRamfApp,
            'ret_code' => $lastSTB->ret_code,
            'stb_name' => $lastSTB->stb_name,
            'version' => $lastSTB->STBVersion()->first(),
            'card_inserted'=>$lastSTB->card_inserted,
            'channels_exist'=>$lastSTB->channels_exist,
            'streaming_channel'=>$lastSTB->streaming_channel,
            'serial' => $lastSTB->serial,
            'download_link' => $lastSTB->download_link,
            'events'=>$lastSTB->events,
            'sleep'=>$lastSTB->sleep,
            // 'stb' => $lastRamfApp,

        ]);
    }
    public function index()
    {
        // $stbs = STB::with(['STBVersion' => function ($query) {
        //     $query->select('id', 'stb', 'web_api', 'base_struct', 'comment');
        // }])->get(['id', 'ret_code', 'stb_name', 'stb_version_id', 'card_inserted', 'channels_exist', 'streaming_channel', 'events', 'sleep', 'serial','download_link']);
    
        // return response()->json($stbs);



        $stbs = STB::with(['STBVersion' => function ($query) {
            $query->select('id', 'stb','version','date', 'web_api', 'base_struct', 'comment');
        }])->get(['id', 'ret_code', 'stb_name', 'stb_version_id', 'card_inserted', 'channels_exist', 'streaming_channel', 'events', 'sleep', 'serial', 'download_link']);

        // Transform the data to include the comment as an array of lines
        $stbsTransformed = $stbs->map(function ($stb) {
            // Get the related STBVersion
            $stbVersion = $stb->STBVersion;

            return [
                // 'id' => $stb->id,
                'ret_code' => $stb->ret_code,
                'stb_name' => $stb->stb_name,
                // 'stb_version_id' => $stb->stb_version_id,
                'serial' => $stb->serial,
                'download_link' => $stb->download_link,
                'stb_version' => [
                    // 'id' => $stbVersion->id,
                    'stb' => $stbVersion->stb,
                    'version' => $stbVersion->version,
                    'date' => $stbVersion->date,
                    'web_api' => $stbVersion->web_api,
                    'base_struct' => $stbVersion->base_struct,
                    'comment' => explode("\r\n", $stbVersion->comment), // Split comment into an array
                ],
                'card_inserted' => $stb->card_inserted,
                'channels_exist' => $stb->channels_exist,
                'streaming_channel' => $stb->streaming_channel,
                'sleep' => $stb->sleep,
                'events' => $stb->events,

            ];
        });

        return response()->json($stbsTransformed);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $stbVersions = STBVersion::select('id', 'stb', 'web_api')->get();
        $stbs = STB::with('STBVersion')->get();
        $activeTab = $request->query('active_tab', 'tab1');
        return view('stb.createStb', compact('stbVersions', 'stbs', 'activeTab'));
    }


    /**
     * Display the specified resource.
     */
    public function show(STB $sTB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(STB $sTB)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, STB $sTB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(STB $sTB)
    {
        //
    }
}
