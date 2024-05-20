<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fundraising;
use App\Models\FundraisingPhases;
use Illuminate\Http\Request;

class FundraisingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $fundraisings = Fundraising::all();
    

        $fundraisingsWithInfo = $fundraisings->map(function ($fundraising) {
            $totalDonations = $fundraising->totalReachedAmount();
            $percentage = ($totalDonations / $fundraising->target_amount) * 100;
            if ($percentage > 100) {
                $percentage = 100;
            }
    
           
            $fundraisingData = $fundraising->toArray();
            $fundraisingData['totalDonations'] = $totalDonations;
            $fundraisingData['percentage'] = $percentage;
    
            return $fundraisingData;
        });
    
        // Mengembalikan respons JSON dengan data fundraising yang sudah diperbarui
        return response()->json($fundraisingsWithInfo, 200);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fundraising = Fundraising::findOrFail($id);
        
        // Hitung total donasi dan persentase
        $totalDonations = $fundraising->totalReachedAmount();
        $percentage = ($totalDonations / $fundraising->target_amount) * 100;
        if ($percentage > 100) {
            $percentage = 100;
        }
    
        // Menambahkan informasi totalDonations dan percentage ke dalam data fundraising
        $fundraisingData = $fundraising->toArray();
        $fundraisingData['totalDonations'] = $totalDonations;
        $fundraisingData['percentage'] = $percentage;
    
        // Mengembalikan respons JSON dengan data fundraising yang sudah diperbarui
        return response()->json($fundraisingData, 200);
    }

    public function getAllFundraisingPhase()
    {
        $phases = FundraisingPhases::with('fundraising')->get();
        return response()->json($phases);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
