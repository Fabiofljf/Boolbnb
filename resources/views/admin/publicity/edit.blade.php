@extends('layouts.app')
@section('content')
    <style>
        #amount {
            border: none
        }

        #amount:focus-visible {
            outline: none;
        }

        .checkout {
            max-width: 75%;
            margin: auto
        }
    </style>
    <div class="content">
        <div class="wrapper">
            <div class="checkout container text-center">
                <h2>Benvenuto! <br> Procedi all'acquisto della tua sponsorizzata</h2>
                <p>Scegli il piano conforme alle tue esigenze</p>
                {{-- form del pagamento --}}
                <form method="post" id="payment-form"
                    action="{{ route('admin.publicity.checkout', [$apartment->id, $publicity->id]) }}">
                    @csrf
                    <section>
                        <label class="d-block" for="amount">
                            <div class="input-wrapper amount-wrapper pb-3">
                                <span class="input-label">Prezzo(€)</span>
                                <input style="max-width:50px" id="amount" name="amount" type="tel" min="1"
                                    placeholder="{{ $publicity->price }} €" value="{{ $publicity->price }}" readonly>
                            </div>
                        </label>

                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>

                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="button btn btn-primary text-white" type="submit"><span>Acquista
                            Sponsorizzazione</span></button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.33.2/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection
