<?php

namespace App\Http\Controllers;

use App\Models\images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('slider.search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $response = Http::withHeaders([
            'Authorization' => 'bearer v2/ekFpQjBBODNFbE5ZR3JqdUc4VzdMOGhBTG9GVjU2RzkvMzk1MDA2NzcxL2N1c3RvbWVyLzQvbW8tdlpjVm5kZHFSTW4tOUhxRUhYVE9NZ1VybWp3d0FReUdfNTRDVmc3Z0JVSjFWZGtTTmVpODl4Tk1jSFFNNXdHTm9YdmRqdkRZdHJaT1VTbDlVS2dZN2JQRmNUb2xaZS1fN1BPdTRFVF9BRE5VdTFVMWN5eWZad01Cd19aNUpGbm1LMWUxM2NIZTVyT01Sb2lOOXBVLUhreW5WcXctZjFhNXNDSzBid1VqaEtpakJrSDUzWllrMk5HT2dkQ2UzYWJoMGpobTYzakNHTHVNczVwbFFJdy9tOURKWjJkYjZFS2Q3SlladUp2alFB'
        ])->get('https://api.shutterstock.com/v2/images/search', [
            'query' =>$query,
            'per_page' => 15
        ]);
        $data = $response->json();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageurls = $request->input('image_urls');
        foreach ($imageurls as $imageId) {
            DB::table('images')->insert([
                'image_id' => $imageId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return response()->json(['success' => true]);
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
