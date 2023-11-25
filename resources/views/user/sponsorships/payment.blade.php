@extends('layouts.app')

@section('content')
    <div>

        <div class="card p-5 d-flex flex-row justify-content-between align-items-center w-100">
            <div>
                <h1 class="fs-4">Selected Plan</h1>
                <div class="fs-3 fw-semibold">{{ $sponsorship->name }}</div>
            </div>
            <div class="fs-2 fw-semibold">
                {{ $sponsorship->price }} €
            </div>
        </div>
        <!-- Step one: add an empty container to your page -->
        <form id="payment-form"
            action="{{ route('user.transaction', ['amount' => $sponsorship->price, 'sponsorship_id' => $sponsorship_id, 'apartment_id' => $apartment_id]) }}"
            method="post">
            @csrf
            <!-- Putting the empty container you plan to pass to
                                                                                                                                                                            'braintree.dropin.create' inside a form will make layout and flow
                                                                                                                                                                            easier to manage -->

            <div id="dropin-container"></div>
            <input type="submit" class="btn back_btn_form" />
            <input type="hidden" id="nonce" name="payment_method_nonce" />
        </form>

        <input type="text" class="d-none" value="{{ $clientToken }}" id="token"></input>

        <script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script>
        <script type="text/javascript">
            // Step two: create a dropin instance using that container (or a string
            //   that functions as a query selector such as '#dropin-container')
            // console.log(document.getElementById('token').value);
            // console.log(document.getElementById('nonce').value);
            const form = document.getElementById('payment-form');
            braintree.dropin.create({
                container: document.getElementById('dropin-container'),
                authorization: document.getElementById('token').value,
            }).then((dropinInstance) => {
                form.addEventListener('submit', (event) => {
                    event.preventDefault();

                    dropinInstance.requestPaymentMethod().then((payload) => {
                        // Step four: when the user is ready to complete their
                        //   transaction, use the dropinInstance to get a payment
                        //   method nonce for the user's selected payment method, then add
                        //   it a the hidden field before submitting the complete form to
                        //   a server-side integration
                        document.getElementById('nonce').value = payload.nonce;
                        form.submit();
                    }).catch((error) => {
                        throw error;
                    });
                });
            }).catch((error) => {
                // handle errors
            });
        </script>
    </div>
@endsection
