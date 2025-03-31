$("input[type='number'], .number").on("input", function() {
    // alert(121);
    this.value = this.value.replace(/[^0-9.]/g, '');
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
});

$(".alphabet").on("input", function() {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
});



document.querySelectorAll('.playButton').forEach(function(playButton) {
    playButton.addEventListener('click', function() {
        // Get the parent block and extract the YouTube URL
        var videoBlock = playButton.closest('.video-block');
        var videoUrl = videoBlock.getAttribute('data-video-url');

        // Extract the video ID from the URL (e.g., dQw4w9WgXcQ)
        var videoId = videoUrl.split('v=')[1];

        // Hide the thumbnail and play button in the specific block
        videoBlock.querySelector('.videoThumbnail').style.display = 'none';
        videoBlock.querySelector('.playButton').style.display = 'none';

        // Show the video container and load the video
        videoBlock.querySelector('.videoContainer').style.display = 'block';

        // Set the YouTube iframe src to the embed URL with the video ID
        var iframe = videoBlock.querySelector('.videoIframe');
        iframe.src = 'https://www.youtube.com/embed/' + videoId;

        // Optionally, autoplay the video by adding "?autoplay=1"
        // iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';

        // Hide other video blocks' thumbnails and play buttons, leaving them in their original state
        document.querySelectorAll('.video-block').forEach(function(block) {
            if (block !== videoBlock) {
                // Ensure that other blocks remain unchanged
                block.querySelector('.videoThumbnail').style.display = 'block';
                block.querySelector('.playButton').style.display = 'block';
                block.querySelector('.videoContainer').style.display = 'none';
                block.querySelector('.videoIframe').src = ''; // Stop any video from playing
            }
        });
    });
});

$(document).ready(function() {
    $(".otp-number").on("input", function() {
        this.value = this.value.replace(/[^0-9.]/g, '');
        if (this.value.length > 6) {
            this.value = this.value.slice(0, 6);
        }
    });

    $('#enrool-now-button').prop('disabled', true);

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Send OTP
    $("#sendOtpBtn").click(function() {
        var email = $("#email").val();
        if (!email) {
            $("#emailError").text("Please enter an email").css("color", "red");
            return;
        }
        if (!isValidEmail(email)) {
            $("#emailError").text("Please enter a valid email").css("color", "red");
            return;
        }
        $.ajax({
            url: sendOtpRoute,
            type: "POST",
            data: {
                email: email,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $("#sendOtpBtn").text("Sending...").prop("disabled", true);
            },
            success: function(response) {
                if (response.success) {
                    $("#emailError").text(response.message).css("color", "green");
                    $("#otpSection").removeClass("d-none");
                    $('#enrool-now-button').prop('disabled', true);
                } else {
                    $("#emailError").text(response.message).css("color", "red");
                    $('#enrool-now-button').prop('disabled', true);
                }
            },
            complete: function() {
                $("#sendOtpBtn").text("Send OTP").prop("disabled", false);
                $('#enrool-now-button').prop('disabled', true);
            },
            error: function() {
                $("#emailError").text("Something went wrong. Try again!").css("color", "red");
                $('#enrool-now-button').prop('disabled', true);
            }
        });
    });

    // Verify OTP
    $("#verifyOtpBtn").click(function() {
        var otp = $("#otp").val();
        var email = $("#email").val();

        if (!otp) {
            $("#otpError").text("Please enter OTP").css("color", "red");
            return;
        }
        $.ajax({
            url: verifyOtp,
            type: "POST",
            data: {
                email: email,
                otp: otp,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $("#verifyOtpBtn").text("Verifying...").prop("disabled", true);
                $('#enrool-now-button').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    $("#otpError").text(response.message).css("color", "green");
                    $("#enrool-now-button").prop("disabled", false);
                    $("#verifyOtpBtn").hide();
                    $('#sendOtpBtn').hide();
                    $('input[name="email"]').prop("readonly", true);
                    $('#otp').prop("readonly", true);
                } else {
                    $("#otpError").text(response.message).css("color", "red");
                    $("#enrool-now-button").prop("disabled", true);
                    $("#verifyOtpBtn").text("Verify OTP").prop("disabled", false);
                }
            },
            error: function() {
                $("#otpError").text("Invalid OTP!").css("color", "red");
                $("#enrool-now-button").prop("disabled", true);
                $("#verifyOtpBtn").prop("disabled", false);

            }
        });
    });
});


$(document).ready(function() {
    let password = $("#password");
    let cpassword = $("#cpassword");
    var button = $('#enrool-now-button');
    
    cpassword.on('input', function(){
        if(password.val() != cpassword.val()){
            $('#password_error').text("Password Do Not Match");
            button.prop('disabled', true);
        } else {
            $('#password_error').text("");
            button.prop('disabled', false);
        }
    });
});


$(document).ready(function () {
    $("#subscriber-form").submit(function (e) {
        e.preventDefault(); // Prevent default form submission

        let email = $("#subscriber-email").val().trim();
        let allowedDomains = ["gmail.com", "pearlorganisation.com"];

        if (!isValidEmail(email, allowedDomains)) {
            iziToast.error({
                title: 'Error',
                message: 'Please enter a correct email address!',
                position: 'topRight',
                timeout: 3000,
            });
            return; // Stop execution if email is invalid
        }

        let formData = $(this).serialize(); 

        $.ajax({
            url: "{{ route('subscriber') }}", 
            type: "POST",
            data: formData,
            beforeSend: function () {
                iziToast.info({
                    title: 'Processing',
                    message: 'Please wait...',
                    position: 'topRight',
                });
            },
            success: function (response) {
                iziToast.success({
                    title: 'Success',
                    message: 'Subscription successful!',
                    position: 'topRight',
                });
                $("#subscriber-form")[0].reset(); // Reset the form
            },
            error: function (xhr) {
                iziToast.error({
                    title: 'Error',
                    message: xhr.responseJSON?.message || 'Something went wrong!',
                    position: 'topRight',
                });
            }
        });
    });

    function isValidEmail(email, allowedDomains) {
        let domain = email.split("@").pop();
        return allowedDomains.includes(domain);
    }
});


// 29-03-2025 @arun js donate 

// donation counter start
	function animateCounter(id, target) {
		let count = 0;
		let speed = target / 100;
		let interval = setInterval(() => {
			count += speed;
			document.getElementById(id).innerText = '₹' + Math.floor(count);
			if (count >= target) {
				document.getElementById(id).innerText = '₹' + target;
				clearInterval(interval);
			}
		}, 20);
	}

	let receivedAmount = 50000;
	let spentAmount = 20000;
	let remainingBalance = receivedAmount - spentAmount;

	animateCounter("received", receivedAmount);
	animateCounter("spent", spentAmount);
	animateCounter("remaining", remainingBalance);

	// donation counter end

	// member section start
	



    function toggleview() {
		var content = document.getElementById("showcontent");
		var button = document.getElementById("toggleviewbtn");

		if (content.style.display === "none") {
			content.style.display = "block";
			button.innerHTML = "See Less";
		} else {
			content.style.display = "none";
			button.innerHTML = "See More";
		}
	}



	function toggleContent() {
		var content = document.getElementById("member-show");
		var button = document.getElementById("member-toggle");

		if (content.style.display === "none") {
			content.style.display = "block";
			button.innerHTML = "See Less";
		} else {
			content.style.display = "none";
			button.innerHTML = "See More";
		}
	}



    function togglecontent() {
		var contt = document.getElementById("show-content");
		var btnnn = document.getElementById("view-toggle");

		if (contt.style.display === "none") {
			contt.style.display = "block";
			btnnn.innerHTML = "See Less";
		} else {
			contt.style.display = "none";
			btnnn.innerHTML = "See More";
		}
	}


    var swiper = new Swiper(".mySwiper", {
		slidesPerView: 3,
		grid: {
			rows: 2,
		},
		spaceBetween: 30,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
	});


    var swiper = new Swiper(".swiper-member", {
		slidesPerView: 2,
		spaceBetween: 30,
		loop: true,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		// navigation: {
		//     nextEl: ".swiper-button-next",
		//     prevEl: ".swiper-button-prev",
		// },
		breakpoints: {
			1024: {
				slidesPerView: 4
			},
			768: {
				slidesPerView: 3
			},
			575: {
				slidesPerView: 2
			},

			0: {
				slidesPerView: 1
			}
		}
	});

    document.addEventListener("DOMContentLoaded", function() {
		document.querySelectorAll(".playButton").forEach(function(button) {
			button.addEventListener("click", function() {
				let videoBlock = this.closest(".video-block");
				let videoContainer = videoBlock.querySelector(".videoContainer");
				let videoIframe = videoBlock.querySelector(".videoIframe");
				let videoUrl = videoBlock.getAttribute("data-video-url");

				// Convert YouTube Shorts link to Embed format
				if (videoUrl.includes("shorts")) {
					videoUrl = videoUrl.replace("youtube.com/shorts/", "youtube.com/embed/");
				} else {
					videoUrl = videoUrl.replace("watch?v=", "embed/");
				}

				videoIframe.src = videoUrl + "?autoplay=1"; // Auto-play the video
				videoContainer.style.display = "block";
			});
		});
	});



    document.addEventListener("DOMContentLoaded", function () {
        var swiper1 = new Swiper('.member-swiper-container', {
            loop: true,
            centeredSlides: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 0 },
                768: { slidesPerView: 2, spaceBetween: 10 },
                1024: { slidesPerView: 3, spaceBetween: 15 }
            }
        });
    
        var swiper2 = new Swiper(".college-swiper", {
            slidesPerView: 2,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 10 },
                640: { slidesPerView: 1, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 40 },
                1024: { slidesPerView: 3, spaceBetween: 50 },
                1199: { slidesPerView: 3, spaceBetween: 50 },
            },
        });
    });