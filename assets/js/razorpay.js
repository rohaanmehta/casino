var options = {
    "key": "rzp_test_aTiITp3A9BDZaR", // Enter the Key ID generated from the Dashboard
    "amount": $('.deposit-amt').val() * 100,
    "currency": "INR",
    "description": "Acme Corp",
    "image": "https://s3.amazonaws.com/rzp-mobile/images/rzp.jpg",
    "prefill": {
        "email": "gaurav.kumar@example.com",
        "contact": +919900000000,
    },
    config: {
        display: {
            blocks: {
                banks: {
                    name: 'Methods with Offers',
                    instruments: [{
                        method: 'wallet',
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
        alert(response.razorpay_payment_id);
    },
    "modal": {
        "ondismiss": function() {
            if (confirm("Are you sure, you want to close the form?")) {
                txt = "You pressed OK!";
                console.log("Checkout form closed by the user");
            } else {
                txt = "You pressed Cancel!";
                console.log("Complete the Payment")
            }
        }
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e) {
    rzp1.open();
    e.preventDefault();
}