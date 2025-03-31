@extends('admin.layout.app')
@section('content')
<div class="card">
	<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
		<h3>Enroll Student's</h3>
		<span class="count-circle" style="margin-left:18%;top:20px;" >{{ count($students ) }}</span>
		<div style="display: flex; gap: 10px; align-items: center;justify-content: space-between;">
			<form action="{{ url()->current() }}" method="get" style="display: flex;gap:15px;">
				<input type="text" class="form-control" value="{{ request()->query('name', '') }}" name="name" required placeholder="Search Student Name">
				<button class="btn btn-primary">Search</button>
				<a class="btn btn-info" href="{{ route('admin.enrool-student') }}">Reset</a>

			</form>
		</div>
	</div>
	<br>
	<div class="card-body">
		<div class="table-responsive table-card mt-3 mb-1">
			<table class="table align-middle table-nowrap ">
				<thead class="table-light">
					<tr>
						<th>S No.</th>
						<th>Name</th>
						<th>Mobile No</th>
						<th>Email </th>
						<th>Course</th>
						<th>Enrool Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($students as $student) 
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $student->name }}</td>
						<td>{{ $student->mobile }}</td>
						<td>{{ $student->email }}</td>
						<td>{{ $student->course }}</td>
						<td>{{ \Carbon\Carbon::parse($student->created_at)->format('d-M-Y') }}</td>
						<td>
							<a href="{{ route('admin.enrool-student-info',$student->id) }}" class="btn btn-dark btn-sm" >View</a>
						</td>
						
					</tr>
					@endforeach                     
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="send-notification" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="width:165%;margin-left:-27%">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Send Notification</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{ route('admin.send-notification') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<!-- Subject Field -->
					<input type="hidden" name="student_id" >
					<div class="mb-3">
						<label for="subject" class="form-label">Subject</label><span class="text-danger">*</span>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
					</div>
					<!-- Image Upload Field -->
					<div class="mb-3">
						<label for="image" class="form-label">Upload Image</label>
						<input type="file" class="form-control" id="image" name="image" accept="image/*">
					</div>
					<!-- Description Field -->
					<div class="mb-3">
						<label for="description" class="form-label">Description</label><span class="text-danger">*</span>
						<textarea class="form-control summernote" id="description" name="description" rows="4" placeholder="Enter description" required></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Send Notification</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('js')
<script>
	$(document).ready(function(){
	    // alert(121);
	    $('.notification').on('click',function(){
	        var id = $(this).data('id');
	        var email = $(this).data('email');
	    
	        $('#send-notification').modal('show');
	        $('#modalLabel').html('Send Notification : '+email);
	        $('#send-notification').find('input[name="student_id"]').val(id);
	
	
	    });
	});
</script>
<script>
	$(document).ready(function() {        
	    $('.summernote').summernote({
	    tabsize: 2,
	    height: 120,
	    toolbar: [
	      ['style', ['style']],
	      ['font', ['bold', 'underline', 'clear']],
	      ['color', ['color']],
	      ['para', ['ul', 'ol', 'paragraph']],
	      ['table', ['table']],
	      ['insert', ['link', 'picture', 'video']],
	      ['view', ['fullscreen', 'codeview', 'help']]
	    ]
	   });
	
	});
</script>
@endpush