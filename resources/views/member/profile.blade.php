@extends('member.layouts.app')
@section('content')
<div class="page-content">
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Member Profile </h4>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<form method="POST" action="{{ route('member.profile')  }}" enctype="multipart/form-data" >
				@csrf
				<div class="row">
					<div class="col-md-12 text-center">
						@if($member->profile_image != null)
						<img class="rounded-circle header-profile-user"  src="{{ asset($member->profile_image) }}" alt="Header Avatar" style="height:96px; width:85px;">                           
						@else 
						<img class="rounded-circle header-profile-user"  src="{{ asset('front/images/avatar-01.jpg') }}" alt="Header Avatar" style="height:96px; width:85px;">                           
						@endif
						<div class="mt-2">
							<input type="file" name="profile_image" accept="image/*" class="form-control-file" id="fileInput" style="margin-left:10%">
						</div>
					</div>
					<div class="col-md-6" style="margin-top: 18px;" >
						<label>Name <span class="text-danger">* </span></label>
						<input type="text" class="form-control" value="{{ $member->name ?? '' }}" required name="name" >
						@error('name')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top: 18px;" >
						<label>Email <span class="text-danger">* </span></label>
						<input type="email" class="form-control" value="{{ $member->email ?? '' }}"  name="email" >
						@error('email')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top: 18px;" >
						<label>Mobile Number  <span class="text-danger">* </span></label>
						<input type="number" class="form-control" value="{{ $member->mobile ?? '' }}"  id="mobile" name="mobile" >
						@error('mobile')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top: 18px;" >
						<label>DOB</label>
						<input type="date" class="form-control" value="{{ $member->dob ?? '' }}"  name="dob" >
						@error('dob')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="col-md-6" style="margin-top: 18px;" >
						<label>Gender <span class="text-danger">* </span></label>
						<select class="form-select" name="gender" required >
							<option disabled selected >--Select Grade--</option>
							<option value="Male" {{ $member->gender === 'Male' ? 'selected' : '' }} >Male</option>
							<option value="Female" {{ $member->gender === 'Female' ? 'selected' : '' }} >Female</option>          
							<option value="Other" {{ $member->gender === 'Other' ? 'selected' : '' }} >Other</option>                           
						</select>
						@error('gender')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="col-md-12" style="margin-top: 18px;" >
						<label>Address <span class="text-danger">* </span></label>
						<textarea class="form-control " cols="2" rows="2" name="address" >{{ $member->address ?? '' }}</textarea>
						@error('address')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="col-md-2" style="margin-top: 18px;" >
						<input type="submit" class="btn btn-primary" id="update-button" value="Update"  >
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<h3>Change Password</h3>
			<form method="POST" action="{{ url('member.profile')  }}" enctype="multipart/form-data" >
				@csrf
				<div class="row">
					<div class="col-md-6" style="margin-top: 18px;" >
						<label>Password <span class="text-danger">* </span> </label>
						<input type="text" class="form-control" id="password"  name="password" >
					</div>
					<div class="col-md-6" style="margin-top: 18px;" >
						<label>Confirm Password <span class="text-danger">* </span> </label>
						<input type="password" autocomplete="one-time-code" class="form-control" id="cpassword"  >
						<div class="text-danger" id="confirm-password" ></div>
					</div>
					<div class="col-md-2" style="margin-top: 18px;" >
						<input type="submit" class="btn btn-primary" id="update-button2" value="Update"  >
					</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('js')
<script>
	$(document).ready(function(){
	    $("#cpassword").on('keyup', function(){
	        var cpassword = $(this).val();
	        var password = $('#password').val();
	        console.log("Password COnfirm :",cpassword);
	
	        if(cpassword != password){
	            $("#confirm-password").html("Password Do Not Match!");
	            $("#update-button2").prop('disabled',true);
	        }else{
	            $("#confirm-password").html("");
	            $("#update-button2").prop('disabled',false);
	
	        }          
	    });
	
	    $("#mobile").on('input', function(){
	        let number = $(this).val();
	        if(number.length >10){
	            number = number.substring(0, 10);
	        }
	        $(this).val(number);
	    });
	
	    $("form").on('submit', function(e) {
	        e.preventDefault();
	        var r= $('<i class="fa fa-spinner fa-spin"></i>');   
	        console.log(r);
	        $("#update-button").html(r).append(' Please Wait...').prop('disabled', true);
	
	        setTimeout(() => {
	            this.submit(); // Submit the form
	        }, 100); // 100 milliseconds delay
	        });
	});
</script>
@endpush