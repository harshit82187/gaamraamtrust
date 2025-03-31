@extends('admin.layout.app')
@section('content')

<div class="card">
	<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
		<h3>Question Bank</h3>
		<span class="count-circle" style="margin-left:14%;top:17px;" >{{ count($questions ) }}</span>
		<div style="display: flex; gap: 10px; align-items: center;justify-content: space-between;">
			<form action="{{ url()->current() }}" method="get" style="display: flex;gap:15px;">
				<input type="text" class="form-control" value="{{ request()->query('name', '') }}" name="name" required placeholder="Search Question">
				<button class="btn btn-primary">Search</button>
				<a class="btn btn-dark" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-questions" style="width:51%;">Add </a>
				<a class="btn btn-info" href="{{ route('admin.question.list') }}">Reset</a>

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
						<th style="width:380px;" >Question Name</th>
						<th>Correct</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($questions) > 0)
						@foreach($questions as $question) 
                        @php 
                         $options = json_decode($question->options, true);
                         $correctAnswer = $options[$question->correct] ?? 'N/A';
                        @endphp
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $question->name ?? '' }}</td>
								<td>
									<label class="btn text-info bg-soft-info font-weight-bold px-3 py-1 mb-0 fz-12" style="white-space: nowrap;cursor: pointer !important;font-size: 17px !important;background-color: rgba(0, 201, 219, .1);position: relative;font-weight: 600 !important;"> {{ $correctAnswer }}</label>
								</td>								
								
							   <td>
								<a href="" class="btn btn-primary btn-sm" >Edit</a>
                                <a href="" class="btn btn-danger btn-sm" >Delete</a>

							   </td>
								
							</tr>
						@endforeach  
					@else
					<tr>
						<td colspan="5" class="text-center">Questions Not Found</td>
					</tr>
					@endif                      
				</tbody>
			</table>
			<div class="d-flex justify-content-center mt-3">
				{{ $questions->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add-questions" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:165%;margin-left:-27%">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.question.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">			
                    <!-- Question Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Question Name</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Test Series Name" required>
                    </div>

                    <!-- Option Labels (4 Answer Choices) -->
                    <div class="mb-3">
                        <label class="form-label">Options</label><span class="text-danger">*</span>
                        <input type="text" class="form-control mb-2" name="options[]" placeholder="Option A" required>
                        <input type="text" class="form-control mb-2" name="options[]" placeholder="Option B" required>
                        <input type="text" class="form-control mb-2" name="options[]" placeholder="Option C" required>
                        <input type="text" class="form-control mb-2" name="options[]" placeholder="Option D" required>
                    </div>

                    <!-- Correct Answer Selection -->
                    <div class="mb-3">
                        <label for="correct_option" class="form-label">Correct Answer</label><span class="text-danger">*</span>
                        <select class="form-control" id="correct" name="correct" required>
                            <option value="" disabled selected>Select Correct Answer</option>
                            <option value="1">Option A</option>
                            <option value="2">Option B</option>
                            <option value="3">Option C</option>
                            <option value="4">Option D</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="correct_option" class="form-label">Test Series</label><span class="text-danger">*</span>
                        <select class="form-control" id="test_series_id" name="test_series_id" required>
                            <option value="" disabled selected>---Select Test Series---</option>
                            @isset($series)
                            @foreach($series as $serie)
                            <option value="{{ $serie->id }}">{{ $serie->name ?? 'N/A' }}</option>    
                            @endforeach
                            @endif                     
                        </select>
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