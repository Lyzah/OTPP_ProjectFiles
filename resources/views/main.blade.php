@extends('layouts.app')

@section('content')
 <script
     src="https://www.paypal.com/sdk/js?client-id=AUNO5XajhdqWpXbm7tENCNUy0AKB-dIIdZnH3nKx-q-OWgsUbm8kI-nZ2UIttN9UaKmG-aE7wxQuA6NW"> // Required. 
     
   </script>
 
 
 <div class="flex items-center justify-center h-screen ">
     <div class="flex flex-col items-center">
 <h3 class="text-xl font-semibold mb-4">One Time Purchase Product Guide</h3>
     
     {{--   <img src="{{$url = Storage::disk('s3')->temporaryUrl('p1.png', \Carbon\Carbon::now()->addMinutes(1))}}" width="200"/>  --}}
        <img src=" {{asset('img/bookcover.png')}}" width="200"/>   
       
        <p class="mt-4"><em>This guide covers building a one time purchase product page and acts as a proof of concept</em></p>   
   
     
     <h3 class="mt-4 mb-4">  <p> <strong>Buy Now :</strong> $ 0.50</p> </h3>
     <div style="width:200px" id="paypal-button-container"></div>
     </div>
</div>
 </body>
 
 
 <script>
     paypal.Buttons({
     createOrder: function(data, actions) {
       // This function sets up the details of the transaction, including the amount and line item details.
       return actions.order.create({
         application_context: {
           brand_name : 'Laravel Book Store Demo Paypal App',
           user_action : 'PAY_NOW',
           shipping_preference: 'NO_SHIPPING',
         },
         purchase_units: [{
           amount: {
             value: '1.50'
           }
         }],
       });
     },
 
     onApprove: function(data, actions) {
 
       let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 
       // This function captures the funds from the transaction.
       return actions.order.capture().then(function(details) {
           if(details.status == 'COMPLETED'){
             return fetch('/api/paypal-capture-payment', {
                       method: 'post',
                       headers: {
                           'content-type': 'application/json',
                           "Accept": "application/json, text-plain, */*",
                           "X-Requested-With": "XMLHttpRequest",
                           "X-CSRF-TOKEN": token
                       },
                       body: JSON.stringify({
                           orderId     : data.orderID,
                           id : details.id,
                           status: details.status,
                           payerEmail: details.payer.email_address,
                       })
                   })
                   .then(status)
                   .then(function(response){
                       // redirect to the completed page if paid
                       window.location.href = '/pay-success';
                   })
                   .catch(function(error) {
                       // redirect to failed page if internal error occurs
                       window.location.href = '/pay-failed?reason=internalFailure';
                   });
           }else{
               window.location.href = '/pay-failed?reason=failedToCapture';
           }
       });
     },
 
     onCancel: function (data) {
      window.location.href = '/pay-failed?reason=userCancelled';
     }
 
 
 
     }).render('#paypal-button-container');
     // This function displays Smart Payment Buttons on your web page.
 
     function status(res) {
       if (!res.ok) {
           throw new Error(res.statusText);
       }
       return res;
     } 
   </script>
 
 
 
 </div>
 @endsection
