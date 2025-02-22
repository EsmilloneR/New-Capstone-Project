@extends('layouts.homepage')

@section('content')
    <div class="container">
        <h2>Pay with PayMongo</h2>
        <div class="row">
            <form id="paymentForm">
                <div class="col">
                    <input type="number" id="amount" name="amount" placeholder="Enter Amount" class="form-control w-50 mb-2"
                        required>
                    <button type="submit" class="btn btn-success">Pay Now</button>
                </div>
            </form>
        </div>
        <div id="response"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#paymentForm").submit(function(event) {
                event.preventDefault();

                let amount = $("#amount").val();

                $.ajax({
                    url: "/api/booking/pay",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        amount: amount
                    }),
                    success: function(response) {
                        console.log(response);

                        $("#response").html(
                            `<p>Payment Intent Created: ${response.data.id}</p>`);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        $("#response").html(
                            `<p style="color: red;">Payment Failed. Try again.</p>`);
                    }
                });
            });
        });
    </script>
@endsection
