<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;
use App\Models\Customer;
use App\Models\Conversation;

class SmsController extends Controller
{
    //
    public function index()
    {
        $receiverNumber = "+8801515653639";
        $message = "This is Jisun testing from fatmonk.studio";

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message
            ]);

            dd('SMS Sent Successfully.');
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
    public function SendMsg(Request $request)
    {

        try {
            $this->validate(
                $request,
                [
                    'message' => 'required'
                ]
            );

            $receiverNumber = $request->phone;
            $message = $request->message;

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);

            $var = new Conversation();
            $var->customer_id = $request->customer_id;
            $var->conversation = $request->message;
            $var->status = 'sent';
            $var->save();

            return redirect()->route('chat',$request->customer_id);
        } catch (Exception $e) {
            $var = Conversation::where('customer_id', $request->customer_id)->first();
            $var->customer_id = $request->customer_id;
            $var->conversation = $request->message;
            $var->status = 'failed';
            $var->save();

            return redirect()->route('chat',$request->customer_id);
        }
    }

    public function ReceiveMsg(Request $request)
    {
        $messageBody = $request->input('Body');
        $phoneNumber = $request->input('From');

        if(Customer::where('Phone', $phoneNumber)->exists()){
        $customer = Customer::where('Phone', $phoneNumber)->first();
        $customer_id=$customer->customer_id;
        }
        else{
        $newcstmr = new Customer();
        $newcstmr->Phone = $phoneNumber;
        $newcstmr->save();
        $customer_id=$newcstmr->customer_id;
        }

        $var = new Conversation();
        $var->customer_id = $customer_id;
        $var->conversation = $messageBody;
        $var->status = 'received';
        $var->save();

        // dd($messageBody . '' . $phoneNumber);

        // return redirect()->route('admin')->with('errorMSG', $request);

    }

    public function Chat(Request $request)
    {
        $customer = Customer::where('customer_id', $request->id)
            ->with(['conversations'])
            ->first();

        return view('Admin.chat')->with('customer', $customer);
    }
}
