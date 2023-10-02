(function ($) {
    'use strict';
    var form = $('#example-form');
    form.children('div').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        onFinished: function (event, currentIndex) {
            alert('Submitted!');
        },
    });
    var validationForm = $('#chef-validation');
    validationForm.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            first_name: 'required',
            last_name: 'required',
            'location[longitude]': 'required',
            'location[latitude]': 'required',
            mobile: 'required',
            'kitchen_types[]': 'required',
            'request_types[]': 'required',
            email: {
                required: true,
                email: true,
            },
            // password: {
            //     required: true,
            //     minlength: 5,
            // },
            // password_confirmation: {
            //     equalTo: '#password',
            // },
        },
        messages: {
            first_name: 'Please enter your first name',
            last_name: 'Please enter your last name',

            'location[latitude]': 'Please enter your location latitude',
            'location[longitude]': 'Please enter your location longitude',
            'location[ar][address]': 'Please enter your location as text',
            'location[en][address]': 'Please enter your location as text',

            'location[ar][street]': 'Please enter your location street',
            'location[en][street]': 'Please enter your location street',

            'ar[kitchen_name]': 'Please enter your kitchen name',
            'en[kitchen_name]': 'Please enter your kitchen name',

            'ar[kitchen_summary]': 'Please enter your kitchen summary',
            'en[kitchen_summary]': 'Please enter your kitchen summary',
            password: {
                required: 'Please provide a password',
                minlength: 'Your password must be at least 5 characters long',
            },
            email: 'Please enter a valid email address',
            'kitchen_types[]': 'Please choose at least one kitchen type',
            'request_types[]': 'Please choose at least one request type',
        },
    });
    validationForm.children('div').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        onStepChanging: function (event, currentIndex, newIndex) {
            validationForm.val({
                ignore: [':disabled', ':hidden'],
            });
            return validationForm.valid();
        },
        onFinishing: function (event, currentIndex) {
            validationForm.validate({
                ignore: [':disabled'],
            });
            return validationForm.valid();
        },
        onFinished: function (event, currentIndex) {
            validationForm.submit();
        },
    });

    var validationProductForm = $('#product-validation');
    validationProductForm.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            price: 'required',
            'kitchen_types[]': 'required',
            'categories[]': 'required',
        },
        messages: {
            price: 'Please enter price',
            request_type_id: 'Please choose request type',
            'ar[name]': 'Please enter your menu item name',
            'en[name]': 'Please enter your menu item name',

            'ar[description]': 'Please enter your menu item description',
            'en[description]': 'Please enter your menu item description',

            'kitchen_types[]': 'Please choose at least one kitchen type',
            'categories[]': 'Please choose at least one category',
        },
    });
    validationProductForm.children('div').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        onStepChanging: function (event, currentIndex, newIndex) {
            validationProductForm.val({
                ignore: [':disabled', ':hidden'],
            });
            return validationProductForm.valid();
        },
        onFinishing: function (event, currentIndex) {
            validationProductForm.validate({
                ignore: [':disabled'],
            });
            return validationProductForm.valid();
        },
        onFinished: function (event, currentIndex) {
            validationProductForm.submit();
        },
    });
    var verticalForm = $('#example-vertical-wizard');
    verticalForm.children('div').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        stepsOrientation: 'vertical',
        onFinished: function (event, currentIndex) {
            alert('Submitted!');
        },
    });
})(jQuery);
