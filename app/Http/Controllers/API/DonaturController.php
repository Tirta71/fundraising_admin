<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

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

    public function __construct()
    {
      
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'fundraising_id' => 'required|integer',
            'total_amount' => 'required|numeric',
            'notes' => 'nullable|string',
           
        ]);
    
  
    
        // Simpan data donatur dengan status pembayaran false
        $donatur = Donatur::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'fundraising_id' => $request->fundraising_id,
            'total_amount' => $request->total_amount,
            'notes' => $request->notes,
            'is_paid' => false,
       
        ]);
    
        // Siapkan parameter transaksi Midtrans tanpa item_details
        $params = [
            'transaction_details' => [
                'order_id' => $donatur->id,
                'gross_amount' => $request->total_amount,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'phone' => $request->phone_number,
            ],
        ];
    
        // Dapatkan token Snap dari Midtrans
        $snapToken = Snap::getSnapToken($params);
    
        // Kembalikan respons dengan token Snap
        return response()->json([
            'message' => 'Donatur added successfully',
            'snap_token' => $snapToken,
        ], 201);
    }
    

    public function updatePaymentStatus(Request $request, $id)
    {
        try {
            $donatur = Donatur::findOrFail($id);
            $donatur->is_paid = true;
            $donatur->save();
    
            return response()->json(['message' => 'Payment status updated successfully'], 200);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan dalam pembaruan status
            return response()->json(['error' => 'Failed to update payment status'], 500);
        }
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
