@extends('admin.layout.app')
@section('content')

<div class="card">
	<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
		<h3>Student Documents</h3>
		<span class="count-circle" style="margin-left:19%;top:20px;" >{{ count($documents ) }}</span>
		<div style="display: flex; gap: 10px; align-items: center;justify-content: space-between;">
			<form action="{{ url()->current() }}" method="get" style="display: flex;gap:15px;">
				<input type="text" class="form-control" value="{{ request()->query('name', '') }}" name="name" required placeholder="Search Student Name">
				<button class="btn btn-primary">Search</button>
				<a class="btn btn-info" href="{{ route('admin.document') }}">Reset</a>

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
						<th>Student Name</th>
						<th>Image</th>
						<th>Marksheet Name</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					@if(count($documents) > 0)
						@foreach($documents as $document) 
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									{{ $document->student->name ?? '' }}
								</td>
								<td>
									@if($document->marksheet == null)
									<img src="{{ asset('front/images/no-image.jpg') }}" height="50px" width="50px" >
									@else
									<a href="{{ asset($document->marksheet) }}" target="_blank">
									<img src="{{ asset('front/images/pdf.png')  }}" height="50px" width="50px" >
									</a>
									@endif
								</td>
								<td>
								@if($document->name == 1)
								10th Marksheet
								@elseif($document->name == 2)
								12th Marksheet
								@elseif($document->name == 3)
								Graduation 1 Year Marksheet
								@elseif($document->name == 4)
								Graduation 2 Year Marksheet
								@elseif($document->name == 5)
								Graduation 3 Year Marksheet
								@elseif($document->name == 6)
								Character Certificate
								@elseif($document->name == 7)
								Domicile Certificate
								@endif
								</td>
								<td>
									@if($document->status == 1)
									Passed
									@else 
									Appeared 
									@endif
							   </td>
								
							</tr>
						@endforeach  
					@else
					<tr>
						<td colspan="5" class="text-center">Documents's Not Found</td>
					</tr>
					@endif                      
				</tbody>
			</table>
			<div class="d-flex justify-content-center mt-3">
				{{ $documents->links() }}
			</div>
		</div>
	</div>
</div>



@endsection
@push('js')


@endpush