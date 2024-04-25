<x-app-layout>
    <div class="h w-[70%] mx-auto space-y-6 p-10 shadow-md bg-slate-100">
        <div class="text-center">
            <h1 class="text-2xl font-bold tracking-widest text-gray-700">Subscribe To continue</h1>
            <h4 class="text-md font-semibold text-blue-600">Select payment gateway</h4>
        </div>
        <div>
             <p class="text-right">Amount: <span class="font-bold bg-green-800 text-white px-3 py-1 rounded-md">{{ $admin->subscriptiion_amount }}</span></p>
        </div>
        <div class="grid grid-cols-2 gap-10">
            <div id="paypal-button-container"></div>
            <div>
                <form action="{{ route('process-payment.update') }}" method="post" id="payment-form">
                    @csrf
                    <input type="text" name="amount" id="amount" class="hidden"
                        value="{{ $admin->subscriptiion_amount }}">
                    <input type="text" name="description" id="description" class="hidden"
                        value="payment for the app">
                    <div class="form-group">

                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <div id="card-element" class="mt-2">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="w-full   text-cyan-50 bg-purple-700 rounded-lg hover:bg-purple-900 hover:shadow p-2 flex justify-center items-center">
                            <i class='bx bxl-stripe  text-xl mr-2' ></i> Submit Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script
            src="https://www.paypal.com/sdk/js?client-id=Afu4hwwWtly8YzbMTBAiR8wmqgihOsEfdB9vsvR7VaJF2gYIYqa-CwTJbaEIsBlS6V3pXLB1Th190jAz">
        </script>


        <script>
            var admin =
                @json($admin);
            var client_id = admin.super_admin_paypal_client_id;
            var existingScript = document.querySelector('script[src^="https://www.paypal.com/sdk/js"]');

            if (existingScript) {
                existingScript.src = 'https://www.paypal.com/sdk/js?client-id=' + client_id;
            } else {
                var script = document.createElement('script');
                script.src = 'https://www.paypal.com/sdk/js?client-id=' + client_id;
                document.head.appendChild(script);
            }
        </script>


        <script>
            var user = @json(auth()->user());
            var admin =
                @json($admin);

            var subscriptiion_amount = admin.subscriptiion_amount;

            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: subscriptiion_amount
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        fetch('/update-subscription', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    user_id: user.id,
                                }),
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }

                                window.location.href = '/dashboard';
                                return response.json();

                            })
                            .then(data => {
                                alert('Subscription updated successfully!');
                            })
                            .catch(error => {
                                console.error('Error updating subscription:', error);
                            });
                    });
                },
                onCancel: function(data) {
                    console.log('Payment cancelled by user.');
                },
                onError: function(err) {
                    console.error(err);
                }
            }).render('#paypal-button-container');
        </script>


        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe(admin.super_admin_strip_key);
            var elements = stripe.elements();

            var card = elements.create('card');
            card.mount('#card-element');

            var form = document.getElementById('payment-form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();

            }
        </script>


    </div>
</x-app-layout>
