@extends('frontend.layouts.master')

@section('title','Razorpay Payment')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Complete Your Payment</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('razorpay.success') }}" method="POST">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ $data['key'] }}"
                                    data-amount="{{ $data['amount'] }}"
                                    data-currency="INR"
                                    data-name="{{ $data['name'] }}"
                                    data-image="{{ $data['image'] }}"
                                    data-description="{{ $data['description'] }}"
                                    data-prefill.name="{{ $data['prefill']['name'] }}"
                                    data-prefill.email="{{ $data['prefill']['email'] }}"
                                    data-prefill.contact="{{ $data['prefill']['contact'] }}"
                                    data-notes.shopping_order_id="{{ $data['notes']['merchant_order_id'] }}"
                                    data-order_id="{{ $data['order_id'] }}"
                                    data-theme.color="{{ $data['theme']['color'] }}">
                            </script>
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            "key": "{{ $data['key'] }}",
            "amount": "{{ $data['amount'] }}",
            "currency": "INR",
            "name": "{{ $data['name'] }}",
            "description": "{{ $data['description'] }}",
            "image": "{{ $data['image'] }}",
            "order_id": "{{ $data['order_id'] }}",
            "handler": function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.querySelector('form').submit();
            },
            "prefill": {
                "name": "{{ $data['prefill']['name'] }}",
                "email": "{{ $data['prefill']['email'] }}",
                "contact": "{{ $data['prefill']['contact'] }}"
            },
            "notes": {
                "shopping_order_id": "{{ $data['notes']['merchant_order_id'] }}"
            },
            "theme": {
                "color": "{{ $data['theme']['color'] }}"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    });
</script>
@endpush 