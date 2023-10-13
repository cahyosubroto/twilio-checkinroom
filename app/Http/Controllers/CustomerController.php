<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if ($request['room_number'] > 5) {
        //     return $request['room_number']." is no room";
        // }
        // return $request['room_number']." room";

        $validated = $request->validate([
            // 'booking_id' => 'required|max:50|unique:customers',
            'country_code' => 'required',
            'phone_number' => 'required|numeric|max_digits:15',
            'name' => 'required|alpha|max:50',
            'room_number' => 'required|numeric|min_digits:3|max_digits:3',
            'room_passcode' => 'required|numeric|min_digits:8|max_digits:8',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date',
        ]);

        // return $validated;
        try {
            DB::transaction(function() use ($validated){
                
                $validated["booking_id"] = $this->generateBookingCode();
                $validated["fiendly_phone"] = $validated['country_code'].$validated['phone_number'];
                $number = env('TWILIO_NUMBER');
                $cust = Customer::create($validated);

                if ($cust) {
                    $sid = env('TWILIO_SID'); // Your Account SID from www.twilio.com/console
                    $token = env('TWILIO_TOKEN'); // Your Auth Token from www.twilio.com/console
                    $reciever = $cust->country_code.$cust->phone_number;

                    $client = new Client($sid,$token);
                    $message = $client->messages->create(
                        "$reciever", // to
                        [
                            "from" => "$number",
                            "body" =>   "Hallo $cust->name. ".
                                        "Pesanan anda untuk kamar $cust->room_number pada tanggal $cust->checkin_date ".
                                        "telah tersimpan dengan kode booking $cust->booking_id. ".
                                        "Mohon menghubungi kembali nomor ini $number pada tanggal check in ".
                                        "tepat saat anda berada di depan kamar untuk mendapatkan passcode membuka pintu kamar. ".
                                        "Terima Kasih"
                        ]
                    );
                    // print $message->sid;
                }
            });
        } catch (\Throwable $th) {
            return $th;
        }
        $redirect = redirect()->route("customers.index");
        return $redirect->with([
            'message'    => "New Customers Has been added",
            'alert-type' => 'success',
        ]);
    }

    function generateBookingCode() {
        $min = 1000; // Minimum 4-digit number
        $max = 9999; // Maximum 4-digit number
        $bookingCode = rand($min, $max); // Generate a random number between $min and $max

        if ($this->checkReffNo($bookingCode)) {
            $this->generateBookingCode();
        }

        return $bookingCode;
    }

    function checkReffNo($number)
    {
        return Customer::where('booking_id',$number)->exists();
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
