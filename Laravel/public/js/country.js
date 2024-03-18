$(document).ready(function () {
    /*------------------------------------------
    --------------------------------------------
    Country Dropdown Change Event
    --------------------------------------------
    --------------------------------------------*/
    var SITEURL = "http://localhost:8000/";

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#country-dropdown").on("change", function () {
        var idCountry = this.value;
        $("#state-dropdown").html("");
        $.ajax({
            url: SITEURL + "api/fetch-states",
            type: "POST",
            data: {
                country_id: idCountry,
                // _token: '{{csrf_token()}}'
            },
            dataType: "json",
            success: function (result) {
                $("#state-dropdown").html(
                    '<option value="">-- Select State --</option>'
                );
                $.each(result.states, function (key, value) {
                    $("#state-dropdown").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
                $("#city-dropdown").html(
                    '<option value="">-- Select City --</option>'
                );
            },
        });
    });

    $("#shipping-country-dropdown").on("change", function () {
        var idCountry = this.value;
        $("#shipping-state-dropdown").html("");
        $.ajax({
            url: SITEURL + "api/fetch-states",
            type: "POST",
            data: {
                country_id: idCountry,
                // _token: '{{csrf_token()}}'
            },
            dataType: "json",
            success: function (result) {
                $("#shipping-state-dropdown").html(
                    '<option value="">-- Select State --</option>'
                );
                $.each(result.states, function (key, value) {
                    $("#shipping-state-dropdown").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
                $("#shipping-city-dropdown").html(
                    '<option value="">-- Select City --</option>'
                );
            },
        });
    });

    /*------------------------------------------
    --------------------------------------------
    State Dropdown Change Event
    --------------------------------------------
    --------------------------------------------*/
    $("#state-dropdown").on("change", function () {
        var idState = this.value;
        $("#city-dropdown").html("");
        $.ajax({
            url: SITEURL + "api/fetch-cities",
            type: "POST",
            data: {
                state_id: idState,
                // _token: '{{csrf_token()}}'
            },
            dataType: "json",
            success: function (res) {
                $("#city-dropdown").html(
                    '<option value="">-- Select City --</option>'
                );
                $.each(res.cities, function (key, value) {
                    $("#city-dropdown").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    });

    $("#shipping-state-dropdown").on("change", function () {
        var idState = this.value;
        $("#shipping-city-dropdown").html("");
        $.ajax({
            url: SITEURL + "api/fetch-cities",
            type: "POST",
            data: {
                state_id: idState,
                // _token: '{{csrf_token()}}'
            },
            dataType: "json",
            success: function (res) {
                $("#shipping-city-dropdown").html(
                    '<option value="">-- Select City --</option>'
                );
                $.each(res.cities, function (key, value) {
                    $("#shipping-city-dropdown").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    });

    /*------------------------------------------
    --------------------------------------------
    toggle shipping details Event
    --------------------------------------------
    --------------------------------------------*/

    $(".shipping_detail").click(function () {
        if ($(this).is(":checked")) {
            $("#shipping_details").show();
            document.getElementById('shipping_first-name').setAttribute('required',true);
            document.getElementById('shipping_last-name').setAttribute('required',true);
            document.getElementById('shipping-country-dropdown').setAttribute('required',true);
            document.getElementById('shipping_address').setAttribute('required',true);
            document.getElementById('shipping_post_code').setAttribute('required',true);
            document.getElementById('shipping_phone_number').setAttribute('required',true);
        } else {
            $("#shipping_details").hide();
            document.getElementById('shipping_first-name').removeAttribute('required');
            document.getElementById('shipping_last-name').removeAttribute('required');
            document.getElementById('shipping-country-dropdown').removeAttribute('required');
            document.getElementById('shipping_address').removeAttribute('required');
            document.getElementById('shipping_post_code').removeAttribute('required');
            document.getElementById('shipping_phone_number').removeAttribute('required');
        }
    });

    
    
        var stripe = Stripe('{{ env("STRIPE_KEY") }}')
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
    
        /*------------------------------------------
        --------------------------------------------
        Create Token Code
        --------------------------------------------
        --------------------------------------------*/
        function createToken() {
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(cardElement).then(function(result) {
    
                if(typeof result.error != 'undefined') {
                    document.getElementById("pay-btn").disabled = false;
                    alert(result.error.message);
                }
    
                /* creating token success */
                if(typeof result.token != 'undefined') {
                    document.getElementById("flexRadioDefault1").value = result.token.id;
                    document.getElementById('checkout-form').submit();
                }
            });
        }
    

});
