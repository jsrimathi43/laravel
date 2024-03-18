$(document).ready(function () {
    /*------------------------------------------
    --------------------------------------------
    Country Dropdown Change Event
    --------------------------------------------
    --------------------------------------------*/
    var SITEURL = "https://localhost:8000/";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#admin-country-dropdown').on('change', function () {
        var idCountry = this.value;
        $("#admin-state-dropdown").html('');
        $.ajax({
            url: SITEURL + "admin/api/fetch-states",
            type: "POST",
            data: {
                country_id: idCountry,
                // _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#admin-state-dropdown').html('<option value="">-- Select State --</option>');
                $.each(result.states, function (key, value) {
                    $("#admin-state-dropdown").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
                $('#city-dropdown').html('<option value="">-- Select City --</option>');
            }
        });
    });

    $("#admin-shipping-country-dropdown").on("change", function () {
        var idCountry = this.value;
        $("#admin-shipping-state-dropdown").html("");
        $.ajax({
            url: SITEURL + "admin/api/fetch-states",
            type: "POST",
            data: {
                country_id: idCountry,
                // _token: '{{csrf_token()}}'
            },
            dataType: "json",
            success: function (result) {
                $("#admin-shipping-state-dropdown").html(
                    '<option value="">-- Select State --</option>'
                );
                $.each(result.states, function (key, value) {
                    $("#admin-shipping-state-dropdown").append(
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
    $('#admin-state-dropdown').on('change', function () {
        var idState = this.value;
        $("#admin-city-dropdown").html('');
        $.ajax({
            url: SITEURL + "admin/api/fetch-cities",
            type: "POST",
            data: {
                state_id: idState,
                // _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                $('#admin-city-dropdown').html('<option value="">-- Select City --</option>');
                $.each(res.cities, function (key, value) {
                    $("#admin-city-dropdown").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });

    $("#admin-shipping-state-dropdown").on("change", function () {
        var idState = this.value;
        $("#admin-shipping-city-dropdown").html("");
        $.ajax({
            url: SITEURL + "admin/api/fetch-cities",
            type: "POST",
            data: {
                state_id: idState,
                // _token: '{{csrf_token()}}'
            },
            dataType: "json",
            success: function (res) {
                $("#admin-shipping-city-dropdown").html(
                    '<option value="">-- Select City --</option>'
                );
                $.each(res.cities, function (key, value) {
                    $("#admin-shipping-city-dropdown").append(
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
            document.getElementById('shipping_first-name').setAttribute('required', true);
            document.getElementById('shipping_last-name').setAttribute('required', true);
            document.getElementById('admin-shipping-country-dropdown').setAttribute('required', true);
            document.getElementById('admin-shipping-state-dropdown').setAttribute('required', true);
            document.getElementById('admin-shipping-city-dropdown').setAttribute('required', true);
            document.getElementById('shipping_address').setAttribute('required', true);
            document.getElementById('shipping_post_code').setAttribute('required', true);
            document.getElementById('shipping_phone_number').setAttribute('required', true);
        } else {
            $("#shipping_details").hide();
            document.getElementById('shipping_first-name').removeAttribute('required');
            document.getElementById('shipping_last-name').removeAttribute('required');
            document.getElementById('admin-shipping-country-dropdown').removeAttribute('required');
            document.getElementById('admin-shipping-state-dropdown').removeAttribute('required');
            document.getElementById('admin-shipping-city-dropdown').removeAttribute('required');
            document.getElementById('shipping_address').removeAttribute('required');
            document.getElementById('shipping_post_code').removeAttribute('required');
            document.getElementById('shipping_phone_number').removeAttribute('required');
        }
    });
});
