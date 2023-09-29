$('.deposit-req').click(function() {
    if ($('.deposit-amt').val() >= 100) {
        var amount = parseInt($('.deposit-amt').val() * 100);
        var options = {
            "key": "rzp_test_aTiITp3A9BDZaR", // Enter the Key ID generated from the Dashboard
            "amount": parseInt($('.deposit-amt').val() * 100),
            "currency": "INR",
            "description": "Casino Corners",
            // "image": "https://s3.amazonaws.com/rzp-mobile/images/rzp.jpg",
            // "prefill": {
            //     "email": "gaurav.kumar@example.com",
            //     "contact": +919900000000,
            // },
            config: {
                display: {
                    blocks: {
                        banks: {
                            name: 'Most Used Methods',
                            instruments: [{
                                method: 'UPI',
                                // wallets: ['olamoney']
                            }]
                        },
                    },
                    sequence: ['block.banks'],
                    preferences: {
                        show_default_blocks: true,
                    },
                },
            },

            "handler": function(response) {
                console.log(response.razorpay_payment_id);
                // console.log($('.deposit-amt').val());
                // update_balance(amount, response);
                // alert(response.razorpay_payment_id);
            },
            "modal": {
                "ondismiss": function() {
                    // if (confirm("Are you sure, you want to close the form?")) {
                    //     txt = "You pressed OK!";
                    // console.log("Checkout form closed by the user");
                    // } else {
                    // txt = "You pressed Cancel!";
                    // console.log("Complete the Payment")
                    // }
                }
            }
        };
        var rzp1 = new Razorpay(options);

        // document.getElementById('rzp-button1').onclick = function(e) {
        rzp1.open();
        // e.preventDefault();
        // }
    } else {
        toast('info', 'Minimum deposit amount is 100');
        return true;
    }
});