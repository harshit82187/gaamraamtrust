@extends('student.layout.app')
@section('content')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaaaaa96 !important;
        border-radius: 4px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 37px !important;
        user-select: none;
        -webkit-user-select: none;
    }
</style>
@endpush


<div class="page-content" style="margin-top:-3%;">
    <div class="row">
        <div class="col-12">
            @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
            </div>
            @endif
        </div>
    </div>
    @if(Auth::guard('student')->user()->state == null || Auth::guard('student')->user()->city == null || Auth::guard('student')->user()->address == null )
    <div class="row">
        <div class="col-12">
            <marquee behavior="scroll" direction="left" style="color: red; font-weight: bold; font-size: 16px;">
                ⚠️ Please first Complete Your Profile!
            </marquee>
        </div>
    </div>
    @endif
    <div class="card card-form-content-box">
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
            <h3>Profile</h3>
        </div> <br>
        <div class="card-body">
            <form action="{{ route('student.profile-update') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        @if(auth()->guard('student')->user()->image == null)
                        <img src="{{ asset('student/backend/images/users/avatar-1.jpg') }}" alt="avatar" style="margin-bottom: 3%; width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                        @else
                        <img src="{{ asset(auth()->guard('student')->user()->image) }}" alt="profile-image" style="margin-bottom: 3%; width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                        @endif
                    </div>

                    <div class="col-12 col-md-6 s py-2">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" accept=".jpeg,.jpg,.png">
                        @error('image')
                        <small class="text-danger" style="font-size: 13px;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6  py-2">
                        <label>Name</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" name="name" value="{{ auth()->guard('student')->user()->name ?? '' }}" required>
                        @error('name')
                        <small class="text-danger" style="font-size: 13px;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 py-2">
                        <label>Email</label><span class="text-danger">*</span>
                        <input type="email" class="form-control" name="email" value="{{ auth()->guard('student')->user()->email ?? '' }}" required>
                        @error('email')
                        <small class="text-danger" style="font-size: 13px;">{{ $message }}</small>
                        @enderror
                    </div>
                  
                    <div class="col-12 col-md-6  py-2">
                        <label>Mobile No</label><span class="text-danger">*</span>
                        <input type="number" class="form-control" name="mobile" value="{{ auth()->guard('student')->user()->mobile ?? '' }}" required>
                        @error('mobile')
                        <small class="text-danger" style="font-size: 13px;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6  py-2">
                        <label>Course</label><span class="text-danger">*</span>
                        <select name="course" class="form-control select">
                            <option value="UPSC" {{ auth()->guard('student')->user()->course == 'UPSC' ? 'selected' : '' }}>UPSC</option>
                            <option value="SSC" {{ auth()->guard('student')->user()->course == 'SSC' ? 'selected' : '' }}>SSC</option>

                        </select>
                    </div>
                    <div class="col-12 col-md-6  py-2">
                        <label>State</label><span class="text-danger">*</span>
                        <!-- select2 remove class form select -->
                        <select name="state" id="state" class="form-control select2">
                            <option selected disabled>--Select State--</option>
                            @php $states = App\Models\State::all(); @endphp
                            @if($states->isNotEmpty())
                            @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ auth()->guard('student')->user()->state == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-12 col-md-6  py-2">
                        <label>City</label><span class="text-danger">*</span>
                        <!-- remove select2 from select -->
                        <select name="city" id="city" class="form-control select2" required>
                            <option selected disabled>--Select City--</option>
                            @if(auth()->guard('student')->user()->city)
                            <option value="{{ auth()->guard('student')->user()->city }}" selected>{{ App\Models\City::where('id', auth()->guard('student')->user()->city)->first()->name }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-12 col-md-6  py-2">
                        <label>Address</label><span class="text-danger">*</span>
                        <textarea name="address" class="form-control customTextarea " required>{{ auth()->guard('student')->user()->address ?? '' }}</textarea>
                        @error('address')
                        <small class="text-danger" style="font-size: 13px;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-2 py-2 ">
                        <input type="submit" class="form-control btn btn-primary btn-sm" style="padding:4px;" value="Save Changes">
                    </div>
            </form>
            <div class="card mt-5">
                <div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
                    <h3>Change your password</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.profile-update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6  py-2">
                                <label>New password</label><span class="text-danger">*</span>
                                <input type="password" class="form-control" autocomplete="one-time-code" name="password" required>
                            </div>
                            <div class="col-12 col-sm-6  py-2">
                                <label>Confirm password</label><span class="text-danger">*</span>
                                <input type="password" class="form-control" autocomplete="one-time-code" name="cpassword" required>
                                <span id="password-error" class="text-danger"></span>
                            </div>
                            <div class="col-12 col-md-2 col-lg-4 col-xl-4 py-2">
                                <input type="submit" id="password-submit" class="form-control btn btn-primary btn-sm" style="padding:4px;" value="Save Changes">
                            </div>

                        </div>

                    </form>
                </div>
                 <br><br>
            </div>
            <!-- <div class="row"> -->

            <!-- </div> -->

        </div>

    </div>
</div>
</div>
</div>

<!-- <div class="page-content" style="margin-top:-12%;">
   
</div> -->
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            allowClear: true,
            width: '300px'
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("input[name='password'], input[name='cpassword']").on("keyup", function() {
            let password = $("input[name='password']").val();
            let confirmPassword = $("input[name='cpassword']").val();
            let submitBtn = $('#password-submit');

            if (password !== confirmPassword || password === "" || confirmPassword === "") {
                submitBtn.prop("disabled", true);
                $('#password-error').html("Password And Confirm Password Do Not Match!");

            } else {
                submitBtn.prop("disabled", false);
                $('#password-error').html("");

            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#state").on('change', function() {
            var stateId = $(this).val();
            console.log(stateId);
            $.ajax({
                url: "{{ url('get-city') }}/" + stateId,
                method: "GET",
                success: function(response) {
                    if (response) {
                        var dataString = JSON.stringify(response);
                        console.log(dataString);
                        var cityDropdown = $('select[name="city"]');
                        cityDropdown.empty();
                        cityDropdown.append('<option selected disabled>--Select City--</option>');
                        $.each(response, function(index, city) {
                            cityDropdown.append('<option value="' + city.id + '">' + city.name + '</option>');
                        });
                    } else {
                        console.error("Empty response received.");
                        alert("Empty response received.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred:', error);
                }
            });
        });
    });
</script>


{{-- <script>
    $(document).ready(function() {
        // Send OTP
        $("#sendOtpBtn").click(function() {
            var email = $("#email").val();
            if (!email) {
                $("#emailMsg").html("Please enter a valid email").css("color", "red");
                return;
            }
            $.ajax({
                url: "{{ route('student.send.otp') }}",
                type: "POST",
                data: {
                    email: email,
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    $("#sendOtpBtn").text("Sending...").prop("disabled", true);
                },
                success: function(response) {
                    if (response.success) {
                        $("#emailMsg").html(response.message).css("color", "green");
                        $("#otpSection").show();
                    } else {
                        $("#emailMsg").html(response.message).css("color", "red");
                    }
                },
                complete: function() {
                    $("#sendOtpBtn").text("Send OTP").prop("disabled", false);
                },
                error: function() {
                    $("#emailMsg").html("Something went wrong").css("color", "red");
                }
            });
        });

        // Verify OTP
        $("#verifyOtpBtn").click(function() {
            var otp = $("#otp").val();
            if (!otp) {
                $("#otpMsg").html("Please enter OTP").css("color", "red");
                return;
            }
            $.ajax({
                url: "{{ route('student.verify.otp') }}",
                type: "POST",
                data: {
                    otp: otp,
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    $("#verifyOtpBtn").text("Verifying...").prop("disabled", true);
                },
                success: function(response) {
                    if (response.success) {
                        $("#otpMsg").html(response.message).css("color", "green");
                        location.reload(); // Reload to update verification status
                    } else {
                        $("#otpMsg").html(response.message).css("color", "red");
                    }
                },
                complete: function() {
                    $("#verifyOtpBtn").text("Verify OTP").prop("disabled", false);
                },
                error: function() {
                    $("#otpMsg").html("Invalid OTP!").css("color", "red");
                }
            });
        });
    });
</script> --}}

@endpush