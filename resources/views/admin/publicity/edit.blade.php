<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
             html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @if (session('success_message'))
            <div class='alert alert-success'>
                {{ session('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
        <div class='alert alert-danger'>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="wrapper">
                 <div class="checkout container">

                        <header>
                            <h1>Benvenuto! <br> Procedi all'acquisto della tua sponsorizzata</h1>
                            <p>
                                Scegli il piano conforme alle tue esigenze
                            </p>
                        </header>
                    <!--  Il form andrà in questo punto -->
                        <form method="post" id="payment-form" action="{{ route('admin.publicity.checkout',[$apartment->id, $publicity->id]) }}"> 
                            @csrf
                            
                            <section>
                                <label for="amount">
                                    <span class="input-label">Prezzo(€)</span>
                                    <div class="input-wrapper amount-wrapper">
                            
                                        <input id="amount" name="amount" type="tel" min="1" placeholder="{{$publicity->price}} €" value="{{$publicity->price}}" readonly>
                                    
                                    </div>
                                </label>

                                <div class="bt-drop-in-wrapper">
                                    <div id="bt-dropin"></div>
                                </div>
                            </section>

                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            <!-- Input per inserire la tipologia di sponsorizzata -->
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipologia sponsorizzata</label>
                                    <input type="text" name="type" required id="type" class="form-control" placeholder="tipo"
                                    aria-describedby="typeHelper" value="{{ old('type', $publicity->type) }}" readonly>
                                    <small id="typeHelper" class="text-muted">Inserisci il tipo di sponsorizzata</small>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="type" required id="type" class="form-control" placeholder="tipo"
                                    aria-describedby="typeHelper" value="" readonly>
                                </div>
                            <button class="button btn btn-primary text-white" type="submit"><span>Acquista Sponsorizzazione</span></button>
                        </form>
                    </div>
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
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
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
    </body>
</html>