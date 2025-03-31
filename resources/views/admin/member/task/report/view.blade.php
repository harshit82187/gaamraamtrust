@extends('admin.layout.app')
@section('content')
<div class="page-content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h4>Task Report ({{ $task->task ?? '' }}) - Assigned to {{ $member->name ?? 'N/A' }}</h4>
                <a href="{{ url('admin/task-list') }}" class="btn btn-dark btn-sm">Back</a>
            </div>            
			<div class="card-body">
				<div class="table-responsive table-card mt-3 mb-1">
					<table class="table align-middle table-nowrap ">
						<thead class="table-light">
							<tr>
								<th>S No.</th>
								<th>Task Update</th>
								<th>Update Date</th>
							</tr>
						</thead>
						<tbody>
							@if($taskUpdates->count() > 0)
							@foreach($taskUpdates as $task)								
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ Illuminate\Support\Str::limit($task->updates, 80) }} <i class="fa fa-info-circle" data-toggle="tooltip" title="{{ $task->updates }}"></i></td>
								<td>{{ \Carbon\Carbon::parse($task->created_at)->format('d-M-Y') }} </td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="3" class="text-danger text-center">No Tasks Report Generate Yet.</td>
							</tr>
							@endif
						</tbody>
					</table>
					<div class="d-flex justify-content-center mt-3">
						{{ $taskUpdates->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('js')
@endpush