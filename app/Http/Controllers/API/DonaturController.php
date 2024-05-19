<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Donatur::all();
    }

    public function showByFundraisingId($id_fundraising)
    {
        try {
            $donaturs = Donatur::where('fundraising_id', $id_fundraising)->get();
            if ($donaturs->isEmpty()) {
                throw new ModelNotFoundException("No donors found for the fundraising with ID: $id_fundraising");
            }
            return $donaturs;
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'fundraising_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'notes' => 'nullable|string',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
      
        $originalFilename = $request->file('proof')->getClientOriginalName();
    
     
        $proofPath = $request->file('proof')->storeAs('proofs', $originalFilename, 'public');
    
    
        $donatur = new Donatur([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'fundraising_id' => $request->fundraising_id,
            'total_amount' => $request->total_amount,
            'notes' => $request->notes,
            'is_paid' => false,
            'proof' => $proofPath,
        ]);
    
      
        $donatur->save();
    
      
        return response()->json(['message' => 'Donatur added successfully'], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
