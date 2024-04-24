<x-app-layout>
    <div class="h-96 w-[70%] mx-auto space-y-6 p-10 shadow-md bg-slate-100">
        <div class="text-center">
            <h1 class="text-2xl font-bold tracking-widest text-gray-700">Subscribe To continue</h1>
            <h4 class="text-md font-semibold text-blue-600">Select payment gateway</h4>
        </div>
        <div class="grid grid-cols-2 gap-10">
            <div id="paypal-button-container"></div>
        </div>
        {{-- <button onclick="test()">click</button> --}}

        <script
            src="https://www.paypal.com/sdk/js?client-id=Afu4hwwWtly8YzbMTBAiR8wmqgihOsEfdB9vsvR7VaJF2gYIYqa-CwTJbaEIsBlS6V3pXLB1Th190jAz">
        </script>

        <script>
            var user = @json(auth()->user());

            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '10.00' // Specify the amount to be charged
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
                                return response.json();
                            })
                            .then(data => {
                                // Handle success response
                                alert('Subscription updated successfully!');
                            })
                            .catch(error => {
                                // Handle error response
                                console.error('Error updating subscription:', error);
                            });
                    });
                },
                onError: function(err) {
                    // Handle errors or display an error message
                    console.error(err);
                }
            }).render('#paypal-button-container');
        </script>


    </div>
</x-app-layout>
