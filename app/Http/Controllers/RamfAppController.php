<?php

namespace App\Http\Controllers;

use App\Models\RamfApp;
use App\Models\RamfAppVersion;
use Illuminate\Http\Request;

class RamfAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//         $lastRamfApp = RamfApp::all();
//         // $lastRamfApp = RamfApp::with('appVersion')->latest()->first();
// return response()->json($lastRamfApp);
//     //     return response()->json([
//     //         'ret_code' => $lastRamfApp->ret_code,
//     //         'app_name' => $lastRamfApp->app_name,
//     //         'version' => $lastRamfApp->appVersion()->first(),
//     //         'serial' => $lastRamfApp->serial,
//     // ]);

// $ramfApps = RamfApp::with(['appVersion' => function ($query) {
//     $query->select('id', 'app', 'web_api', 'built', 'app_full_name', 'comment');
// }])->get(['id', 'ret_code', 'ramf_app_name', 'ramf_app_version_id', 'serial','download_link']);

// return response()->json($ramfApps);





$ramfApps = RamfApp::with(['appVersion' => function ($query) {
    $query->select('id', 'app', 'web_api', 'built', 'app_full_name', 'comment');
}])->get(['id', 'ret_code', 'ramf_app_name', 'ramf_app_version_id', 'serial', 'download_link']);

// Transform the data to include the comment as an array of lines
$ramfAppsTransformed = $ramfApps->map(function ($ramfApp) {
    // Get the related appVersion
    $appVersion = $ramfApp->appVersion;

    return [
        // 'id' => $ramfApp->id,
        'ret_code' => $ramfApp->ret_code,
        'ramf_app_name' => $ramfApp->ramf_app_name,
        // 'ramf_app_version_id' => $ramfApp->ramf_app_version_id,
        'serial' => $ramfApp->serial,
        'download_link' => $ramfApp->download_link,
        'app_version' => [
            // 'id' => $appVersion->id,
            'app' => $appVersion->app,
            'web_api' => $appVersion->web_api,
            'built' => $appVersion->built,
            'app_full_name' => $appVersion->app_full_name,
            'comment' => explode("\r\n", $appVersion->comment), // Split comment into an array
        ],
    ];
});

return response()->json($ramfAppsTransformed);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeApi(Request $request)
    {
        // $data = [
        //     'ret_code' => 'static_ret_code',
        //     'app_name' => 'RAMF APP',
        //     'ramf_app_version_id' => 1, // Assuming version_id 1 exists
        //     'serial' => 'static_serial',
        //     'download_link' => 'download_link',

            
        // ];


        $validatedData = $request->validate([
            'ret_code' => 'required|string|max:255',
            'ramf_app_name' => 'required|string|max:255',
            'ramf_app_version_id' => 'required|exists:ramf_app_versions,id',  // Update this line
            'serial' => 'required|string|max:255',
            'download_link' => 'required|string|max:255',
            
        ]);
        // dd($request->download_link);
    
        $ramfApp = RamfApp::create($validatedData);
        // dd('created successfully');

        return response()->json([
            'message' => 'RamfApp created successfully',
            'stb' => $ramfApp,
        ], 201);
    }



    /*
    
    Field 'download_link' doesn't have a default value (Connection: mysql, SQL: insert into `ramf_apps` (`ret_code`, `ramf_app_name`, `ramf_app_version_id`, `serial`, `updated_at`, `created_at`) values (ret, name, 1, sdfklamlcas456, 2024-10-01 19:14:48, 2024-10-01 19:14:48))", "exception": "Illuminate\\Database\\QueryException", "file":
    this error is likely because of you didn't add the column to the fillable in the model

    if the form doesn't store in the database this might be because of the request validation isn't successful and this might be because of the name of the input is n't the same as the column name  
    */
    public function storeWeb(Request $request)
    {
        $validatedData = $request->validate([
            'ret_code' => 'required|string|max:255',
            'ramf_app_name' => 'required|string|max:255',
            'ramf_app_version_id' => 'required|exists:ramf_app_versions,id',  // Update this line
            'serial' => 'required|string|max:255',
            'download_link' => 'required|string|max:255',

        ]);
    
        $ramfApp = RamfApp::create($validatedData);
        // dd('created successfully');
        return redirect()->route('ramfapp.create', ['active_tab' => 'tab3'])->with('success', 'Ramf App created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function getVersion(RamfApp $sTB)
    {
        // $lastRamfApp = RamfApp::latest()->first();
        $lastRamfApp = RamfApp::with('appVersion')->latest()->first();

        return response()->json([
            'ret_code' => $lastRamfApp->ret_code,
            'ramf_app_name' => $lastRamfApp->ramf_app_name,
            'version' => $lastRamfApp->appVersion()->first(),
            'serial' => $lastRamfApp->serial,
            'download_link' => $lastRamfApp->download_link,

            
    ]);
    }
    public function create(Request $request)
    {
        $ramfAppVersions = RamfAppVersion::select('id', 'app', 'web_api')->get();
        $ramfApp = RamfAppVersion::with('ramfApp')->get();
        $activeTab = $request->query('active_tab', 'tab1');
        return view('ramfApp.createRamfApp', compact('ramfAppVersions', 'ramfApp', 'activeTab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RamfApp $sTB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RamfApp $sTB)
    {
        //
    }
}
