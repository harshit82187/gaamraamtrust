@extends('admin.layout.app')
@section('content')
<style>
	.customTextarea {
	width: 1100px !important;
	height: 87px !important;
	resize: none !important;
	}
</style>
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<div class="page-content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<h4>Add Task</h4>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('admin.task-add') }}"  >
					@csrf
					<div class="row">
						<div class="col-12" style="margin-top: 18px;" >
							<label>Task Name<span class="text-danger">* </span></label>
							<textarea name="task" class="form-control customTextarea" required></textarea>
						</div>
						<div class="col-12" style="margin-top: 18px;" >
							<label>Assign Member<span class="text-danger">* </span></label>
							<select class="form-control select2" multiple name="member_id[]" required >
								<option>-- Select Members --</option>
								@isset($members)
								@foreach($members as $member)
								<option value="{{ $member->id }}">{{ $member->name }}</option>
								@endforeach
								@endisset
							</select>
						</div>
						<div class="col-12" style="margin-top: 44px;" >
							<input type="submit" class="btn btn-primary pay-online" value="Submit"  >
						</div>
					</div>
				</form>
			</div>

            <div class="card-body">
                <div class="table-responsive table-card mt-3 mb-1">
                    <table class="table align-middle table-nowrap ">
                        <thead class="table-light">
                            <tr>
                                <th>S No.</th>
                                <th>Member Name</th>
                                <th>Task Name</th>
                                <th>Assign Date</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
							@if($tasks->count() > 0)
                            @foreach($tasks as $task)
								@php	$assignedMembers = json_decode($task->assign_to, true); 	@endphp
								@if(is_array($assignedMembers) && count($assignedMembers) > 0)
									@foreach($assignedMembers as $key => $member_id)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td> {{ \App\Models\User::find($member_id)->name ?? 'N/A' }}</td>
											<td>{{ Illuminate\Support\Str::limit($task->task, 35) }} <i class="fa fa-info-circle" data-toggle="tooltip" title="{{ $task->task }}"></i></td>
											<td>{{ \Carbon\Carbon::parse($task->booking_date)->format('d-M-Y') }} </td>
											<td>
												<a href="{{ route('admin.task-report-check', ['task_id' => $task->id, 'member_id' => $member_id]) }}" class="btn btn-dark"  >Check Report</a>
											</td>

										</tr>
										@endforeach
								@endif
                            @endforeach
							@else
								<tr>
									<td colspan="5" class="text-danger text-center">No Tasks Assigned Yet.</td>
								</tr>
							@endif
                        </tbody>
                       
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $tasks->links() }}
                    </div>
                    
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
	$('.select2').select2({
	    allowClear: true,
	});
</script>
@endpush
