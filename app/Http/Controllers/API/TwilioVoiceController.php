<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;

class TwilioVoiceController extends Controller
{

    public function RevealPass(){
        $response = new VoiceResponse();
        $caller = $_REQUEST['Caller'];
        $cust = Customer::where('fiendly_phone','=',$caller)->whereDate('checkin_date', '=', date('Y-m-d'))->first();
        if (!$cust) {
            $response->say('Maaf, tidak ada jadwal check in untuk anda hari ini!.', 
            ['voice'=>'Google.id-ID-Standard-D', 'language'=>'id-ID']);
            // $response->hangup();
        }
        else{
            $cust->is_checkedin = '1';
            $cust->save();
            
            $passcode = implode(', ', str_split($cust->room_passcode));
    
            $response->say(
                'Hallo '.$cust->name.
                'Dengarkan baik-baik!. Ini kode pin untuk membuka kunci kamar anda. '.$passcode.'. Terima Kasih', 
                ['voice'=>'Google.id-ID-Standard-A', 'language'=>'id-ID', "loop"=>3]
            );
        }
        // Render the response as XML in reply to the webhook request
        header('Content-Type: text/xml');
        echo $response;
    }
}
