@extends('admin.layout.app')
@section('content')

<div class="card">
	<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
		<h3>Test Series</h3>
		<span class="count-circle" style="margin-left:10%;top:20px;" >{{ count($testSeries ) }}</span>
		<div style="display: flex; gap: 10px; align-items: center;justify-content: space-between;">
			<form action="{{ url()->current() }}" method="get" style="display: flex;gap:15px;">
				<input type="text" class="form-control" value="{{ request()->query('name', '') }}" name="name" required placeholder="Search Test Series Name">
				<button class="btn btn-primary">Search</button>
				<a class="btn btn-dark" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-series" style="width:51%;">Add </a>
				<a class="btn btn-info" href="{{ route('admin.document') }}">Reset</a>

			</form>
		</div>
	</div>
	<br>
	<div class="card-body">
		<div class="table-responsive table-card mt-3 mb-1">
			<table class="table table-striped align-middle table-nowrap">
				<thead class="table-light">
					<tr>
						<th>S No.</th>
						<th>Test Series Name</th>
                        <th>Total Question</th>
						<th>Duration (In Minute)</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($testSeries) > 0)
						@foreach($testSeries as $course) 
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
                                    @if($course->image == null)
									<img src="{{ asset('front/images/no-image.jpg') }}" style="width:20%;height:auto;border-radius:22px;" >
									@else
									<a href="{{ asset($course->image) }}" target="_blank">
									<img src="{{ asset($course->image)  }}" style="width:20%;height:auto;border-radius:22px;" >
									</a>
									@endif
									{{ $course->name ?? '' }}
								</td>
								<td>
									<label class="btn text-info bg-soft-info font-weight-bold px-3 py-1 mb-0 fz-12" style="white-space: nowrap;cursor: pointer !important;font-size: 17px !important;background-color: rgba(0, 201, 219, .1);position: relative;font-weight: 600 !important;">4</label>
								</td>
								<td>{{ $course->duration }} Min</td>
								
								<td>
									<label class="switch">
										<input type="checkbox" class="status-toggle" data-id="{{ $course->id }}" {{ $course->status ? 'checked' : '' }}>
									   <span class="slider round"></span>
								   </label>
							   </td>
							   <td>
								<a href="" class="btn btn-primary btn-sm" >Edit</a>
                                <a href="" class="btn btn-danger btn-sm" >Delete</a>

							   </td>
								
							</tr>
						@endforeach  
					@else
					<tr>
						<td colspan="5" class="text-center">Test Series Not Found</td>
					</tr>
					@endif                      
				</tbody>
			</table>
			<div class="d-flex justify-content-center mt-3">
				{{ $testSeries->links() }}
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add-series" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="width:165%;margin-left:-27%">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Add Test Series</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{ route('admin.test-series.add') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">			
					<div class="mb-3">
						<label for="name" class="form-label">Series Name</label><span class="text-danger">*</span>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter Test Series Name" required>
					</div>
					<div class="mb-3">
						<label for="image" class="form-label">Upload Image</label><span class="text-danger">*</span>
						<input type="file" class="form-control" id="image" name="image" required accept="image/*">
					</div>
					<div class="mb-3">
						<label for="duration" class="form-label">Duration (in minutes)</label><span class="text-danger">*</span>
						<input type="text" class="form-control" id="duration" name="duration" placeholder="Enter duration in minutes" required min="1">
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>



@endsection
@push('js')

<script>
    $(document).ready(function () {
        $("#duration").on("input", function () {
            this.value = this.value.replace(/[^0-9]/g, '');     
        });
    });
</script>

{{-- <script>
	$(document).ready(function() {
		$('.status-toggle').change(function() {
			var status = $(this).prop('checked') == true ? 1 : 0;
			var course_id = $(this).data('id');

			$.ajax({
				url: '{{ url('admin/course-update-status') }}',
				type: 'POST',
				data: {
					'_token': $('meta[name="csrf-token"]').attr('content'),
					'course_id': course_id,
					'status': status
				},
				success: function(response) {
					iziToast.info({
						title: 'Info',
						message: 'Course status updated successfully!',
						position: 'topRight',
						timeout: 3000,
					});
				},
				error: function(xhr, status, error) {
					iziToast.error({
						title: 'Error',
						message: 'Error updating status!',
						position: 'topRight',
						timeout: 3000
					});
				}
			});
		});
	});
</script> --}}

@endpush