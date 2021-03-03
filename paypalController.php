<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendLinkEmail;
use Illuminate\Support\Facades\Storage;

use App\Models\Order;

class paypalController extends Controller
{
    
        //
        public function capturePayment(Request $request){
            $order = Order::create(['orderId' => $request->get('orderId'),
                           'status' => $request->get('status'),
                           'payerEmail' => $request->get('payerEmail')]);

            $link = Storage::disk('s3')->temporaryUrl('PDF-Example.pdf', \Carbon\Carbon::now()->addMinutes(1));
            
           //Code to Email Book To User
            Mail::to(request('payerEmail'))
                ->send(new SendLinkEmail($link));

           return $order;
       }


       public function fail(Request $request){
        $request = ($request->input('reason'));

       /* return $request->input('id');*/
        return view('payFailed', ['reason' => $request]);
   }
}
