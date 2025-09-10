$(document).ready(function () {
    // Function to populate dropdowns
    function populateDropdowns(countrySelector, stateSelector, citySelector, localAreaSelector) {
        // Fetch and populate countries
        $.ajax({
            url: '/getCountryShow',
            type: 'GET',
            success: function (data) {
                // Clear existing options
                $(countrySelector).empty().append('<option value="" disabled selected>Select Country</option>');

                // Assuming data is an array of objects with 'id' and 'name' properties
                $.each(data, function(index, item) {
                    $(countrySelector).append('<option value="' + item.id + '">' + item.name + '</option>');
                });

                // Call the niceSelect method on the select element
                $(countrySelector).niceSelect('update');
            },
            error: function (xhr, status, error) {
                console.error("Error fetching countries: " + error);
            }
        });

        // Handle country change event
        $(countrySelector).change(function () {
            var countryId = $(this).val();

            // Fetch and populate states based on the selected country
            $.ajax({
                url: '/getSelectedState/' + countryId,
                type: 'GET',
                success: function (data) {
                    // Clear existing options
                    $(stateSelector).empty().append('<option value="" disabled selected>Select State</option>');

                    // Assuming data is an array of objects with 'id' and 'name' properties
                    $.each(data, function(index, item) {
                        $(stateSelector).append('<option value="' + item.id + '">' + item.state_name + '</option>');
                    });

                    // Call the niceSelect method on the select element
                    $(stateSelector).niceSelect('update');
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching state: " + error);
                }
            });
        });

        // Handle state change event
        $(stateSelector).change(function () {
            var stateId = $(this).val();

            // Fetch and populate cities based on the selected state
            $.ajax({
                url: '/getSelectedCity/' + stateId,
                type: 'GET',
                success: function (data) {
                    // Clear existing options
                    $(citySelector).empty().append('<option value="" disabled selected>Select City</option>');

                    // Assuming data is an array of objects with 'id' and 'name' properties
                    $.each(data, function(index, item) {
                        $(citySelector).append('<option value="' + item.id + '">' + item.name + '</option>');
                    });

                    // Call the niceSelect method on the select element
                    $(citySelector).niceSelect('update');
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching city: " + error);
                }
            });
        });

        // Handle city change event
        $(citySelector).change(function () {
            var cityId = $(this).val();

            // Fetch and populate local areas based on the selected city
            $.ajax({
                url: '/getSelectedLocalArea/' + cityId,
                type: 'GET',
                success: function (data) {
                    // Clear existing options
                    $(localAreaSelector).empty().append('<option value="" disabled selected>Select Local Area</option>');

                    // Assuming data is an array of objects with 'id' and 'name' properties
                    $.each(data, function(index, item) {
                        $(localAreaSelector).append('<option value="' + item.id + '">' + item.name + '</option>');
                    });

                    // Call the niceSelect method on the select element
                    $(localAreaSelector).niceSelect('update');
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching local area: " + error);
                }
            });
        });
    }

    // Populate regular dropdowns
    populateDropdowns('#country_id', '#state_id', '#city_id', '#local_area_id');

    // Populate rent dropdowns
    populateDropdowns('#rent_country_id', '#rent_state_id', '#rent_city_id', '#rent_local_area_id');
});
