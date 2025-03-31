$("#donate-online").submit(function(e) {
    console.log("Form submission triggered");
    e.preventDefault();
    let isValid = true;
    var amount = parseInt($('#amount').val(), 10) || 0;
    if (amount < 100) {
        iziToast.info({
            title: 'Info',
            message: 'Minimum payable amount is 100 rupees!',
            position: 'topRight',
            timeout: 3000,
        });
        isValid = false;
    }
    if (isValid) {
        console.log("Amount is valid, proceeding with Razorpay");
        razorpaySubmit(this);
      }
});

var razorpayPaymentId = "";
let totalAmount = 0; // Initialize amount
function updateRazorpayOptions() {
    totalAmount = parseInt($('#amount').val(), 10) || 0;
    let totalAmountInPaise = totalAmount * 100;
    console.log("Amount on Razorpay: " + totalAmountInPaise);
    razorpay_options.amount = totalAmountInPaise.toString();

    // Razorpay options
    var razorpay_options = {
        key: RAZORPAY_KEY,
        amount: totalAmount * 100,
        name: "Gaam Raam",
        description: "Member Donation",
        image:razorpay_logo,
        netbanking: true,
        currency: "INR",
        prefill: {
            name: "{{ Auth::User()->name }}",
            email: "{{ Auth::User()->email }}",
            contact: "{{ Auth::User()->mobile }}"
        },
        notes: {
               donor_name: "{{ Auth::User()->name }}",
                donor_email: "{{ Auth::User()->email }}",
                donor_mobile: "{{ Auth::User()->mobile }}",
                transaction_date: new Date().toISOString()
            },
        "theme": { "color": "#ff7029" },
        handler: function (transaction) {
            razorpayPaymentId = transaction.razorpay_payment_id;
            console.log("Payment ID: " + razorpayPaymentId);
            document.getElementById('razorpay_payment_id').value = razorpayPaymentId;
            document.getElementById('donate-online').submit(); // Correct form ID
        },
        modal: {
            ondismiss: function () {
                location.reload();
            }
        }
    };
}



// Open Razorpay Checkout
var razorpay_instance;
function razorpaySubmit(el) {
    console.log("Opening Razorpay Checkout");
    $('.pay-online').val('Please Wait...').prop('disabled', true);
    updateRazorpayOptions(); 

    if (!razorpay_instance) {
        console.log("Creating new Razorpay instance");
        razorpay_instance = new Razorpay(razorpay_options);
    }
    razorpay_instance.open(); 
}