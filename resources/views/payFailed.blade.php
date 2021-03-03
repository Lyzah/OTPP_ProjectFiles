@extends('layouts.app')

@section('content')
      
        <div class="flex items-center justify-center h-screen">
            <div class="flex flex-col items-center">
            
                        <h1>
       
                        @switch($reason)
                            @case("userCancelled")
                               Payment was cancelled
                                @break

                            @case("failedToCapture")
                                Failed to capture payment,sorry
                                @break

                            @case("internalFailure")
                                Failed to process payment due to internal server error
                                @break

                            @default
                                "payment failed"
                        @endswitch
                                                
                        
                      
                        
                        
                        
                        
                        
                        </h1>
                    <nav>
                        <ol class="mt-4 text-blue-600 divide-x divide-blue-400">
                            <li ><a href="/">Return to main page</a></li>
                            
                        </ol>
                    </nav>
            </div>
        </div>
@endsection