$(document).ready(function () {
    // Note: This issue occurs because Bootstrap modals tend to steal focus from other elements outside of the modal. Since by default, Select2 attaches the dropdown menu to the <body> element, it is considered "outside of the modal".

    //____ category_id Select2 ____//
    $('#category_id').select2({
        // dropdownParent: $('#createModal'),
        templateResult: formatState,       // Only Text content when select, it will be shown 
        templateSelection: formatState,    // When select any option, it will be display image and text both
    });

        //____ subCategory_id Select2 ____//
    $('#subCategory_id').select2({
        // dropdownParent: $('#createModal'),
        templateResult: formatState,
        templateSelection: formatState,
    });

    //____ childCategory_id Select2 ____//
    $('#childCategory_id').select2({
        dropdownParent: $('#createModal'),
        templateResult: formatState,
        templateSelection: formatState,
    });

    //____ brand_id Select2 ____//
    $('#brand_id').select2({
        dropdownParent: $('#createModal'),
        templateResult: formatState,
        templateSelection: formatState,
    });

    function formatState (state) {
        if (!state.id) {
            return state.text; // Return text for disabled option
        }

        var imageUrl = $(state.element).data('image-url'); // Access image URL from data attribute

        if (!imageUrl) {
            return state.text; // Return text if no image URL is available
        }

        var $state = $(
            '<span><img src="' + imageUrl + '" style="width: 35px; height: 30px; margin-right: 8px;" /> ' + state.text + '</span>'
        );
        return $state;
    };


    // All Update Plugins

    //____ category_id Select2 ____//
    $('#up_category_id').select2({
        dropdownParent: $('#editModal'), 
        templateResult: formatState, // Custom rendering function for options
        templateSelection: formatState, // This will also format the selected item
    });


        //____ subCategory_id Select2 ____//
    $('#up_subCategory_id').select2({
        dropdownParent: $('#editModal'),
        templateResult: formatState,
        templateSelection: formatState,
    });


    //____ childCategory_id Select2 ____//
    $('#up_childCategory_id').select2({
        dropdownParent: $('#editModal'),
        templateResult: formatState,
        templateSelection: formatState,
    });


    //____ brand_id Select2 ____//
    $('#up_brand_id').select2({
        dropdownParent: $('#editModal'),
        templateResult: formatState,  
        templateSelection: formatState, 
    });

    function formatState (state) {
        if (!state.id) {
            return state.text; // Return text for disabled option
        }

        var imageUrl = $(state.element).data('image-url'); // Access image URL from data attribute

        if (!imageUrl) {
            return state.text; // Return text if no image URL is available
        }

        var $state = $(
            '<span><img src="' + imageUrl + '" style="width: 35px; height: 30px; margin-right: 8px;" /> ' + state.text + '</span>'
        );
        return $state;
    };


    // Flatpicker Plugin
    $(".offer_start_date").flatpickr({
        minDate: "today"
    });

    $(".offer_end_date").flatpickr({
        minDate: "today",
    });

    $(".up_offer_start_date").flatpickr({
        minDate: "today"
    });

    $(".up_offer_end_date").flatpickr({
        minDate: "today",
    });




})