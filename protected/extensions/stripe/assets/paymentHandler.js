function reportError(msg) {
    $('#payment-errors').text(msg).addClass('alert alert-error');
    $('#submitBtn').prop('disabled', false);
    return false;
}

$(document).ready(function() {
    $('.card-number').payment('formatCardNumber');
    $('.card-cvc').payment('formatCardCVC');

    $("#payment-form").submit(function(event) {
        var error = false;

        $('#submitBtn').attr("disabled", "disabled");

        var fullname = $('.card-fullname').val(),
            ccNum = $('.card-number').val(),
            cvcNum = $('.card-cvc').val(),
            expMonth = $('.card-expiry-month').val(),
            expYear = $('.card-expiry-year').val();

        if (!Stripe.validateCardNumber(ccNum)) {
            error = true;
            reportError('The credit card number appears to be invalid.');
        }

        if (!Stripe.validateCVC(cvcNum)) {
            error = true;
            reportError('The CVC number appears to be invalid.');
        }

        if (!Stripe.validateExpiry(expMonth, expYear)) {
            error = true;
            reportError('The expiration date appears to be invalid.');
        }

        if (!validateName(fullname)) {
            error = true;
            reportError('The cardholders name is invalid.');
        }

        if (!error) {
            Stripe.createToken({
                number: ccNum,
                cvc: cvcNum,
                exp_month: expMonth,
                exp_year: expYear
            }, stripeResponseHandler);
        }

        return false;
    });
});

function stripeResponseHandler(status, response) {
    if (response.error) {
        reportError(response.error.message);
    } else {
        var f = $("#payment-form");
        var token = response['id'];
        f.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        f.get(0).submit();
    }
}

function validateName(name) {
    if (typeof name === 'string' && name.length > 2)
        return true;
    return false;
}