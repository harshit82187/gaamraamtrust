
    $(".number").on("input", function () {
        this.value = this.value.replace(/[^0-9.]/g, ''); 
         if (this.value.length > 10) {
          this.value = this.value.slice(0, 10); 
      }
    });

    $(".alphabet").on("input", function () {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, ''); 
    });


    $("#donate-online").submit(function(e) {
        console.log("Form submission triggered");
        e.preventDefault();
        let isValid = true;
      
        var amount = parseInt($('#amount').val(), 10) || 0;
        if (amount <= 0) {
            iziToast.info({
                title: 'Info',
                message: 'Amount Not Be Below Zero rupees!',
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
    
        // Get dynamic input values
        var donerName = $('#name').val() || 'Unknown User';
        var mobile_no = $('#mobile_no').val() || '0000000000';
        var email = $('#email').val() || 'unknownuser@gmail.com';
        console.log("Prefill Values - Name:", donerName, "Email:", email, "Mobile:", mobile_no);
    
        razorpay_options = {
            key: RAZORPAY_KEY,
            amount: totalAmountInPaise.toString(),
            name: "Gaam Raam",
            description: "Member Donation",
            image: razorpay_logo,
            netbanking: true,
            currency: "INR",
            prefill: {
                name: $('#name').val(),
                email: $('#email').val(),
                contact: $('#mobile_no').val()
            },
            notes: {
               donor_name: $('#name').val(),
                donor_email: $('#email').val(),
                donor_mobile: $('#mobile_no').val(),
                transaction_date: new Date().toISOString()
            },
            theme: { color: "#ff7029" },
            handler: function (transaction) {
                razorpayPaymentId = transaction.razorpay_payment_id;
                console.log("Payment ID: " + razorpayPaymentId);
    
                document.getElementById('razorpay_payment_id').value = razorpayPaymentId;
                $("#donate-online").off('submit').submit(); // Allow form submission after payment
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
        let btn = $('#donate-now-submit');
        btn.html('<span class="spinner-border spinner-border-sm"></span> Please Wait...').prop('disabled', true).css('cursor', 'no-drop');
        updateRazorpayOptions(); 

        if (!razorpay_instance) {
            console.log("Creating new Razorpay instance");
            razorpay_instance = new Razorpay(razorpay_options);
        }
        razorpay_instance.open(); 
    }