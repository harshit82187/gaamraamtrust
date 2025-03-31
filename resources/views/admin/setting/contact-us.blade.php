@extends('admin.layout.app')
@section('content')

<div class="card">
	<div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
		<h3>Contact Us Listing</h3>
		<span class="count-circle" style="margin-left:16%;top:20px;" >{{ count($contacts) }}</span>

	</div>
	<br>
	<div class="card-body">
		<div class="table-responsive table-card mt-3 mb-1">
			<table class="table align-middle table-nowrap ">
				<thead class="table-light">
					<tr>
						<th>S No.</th>
                        <th>Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Subject</th>
						<th>Message</th>
					</tr>
				</thead>
				<tbody>
					@if(count($contacts) > 0)
						@foreach($contacts as $contact) 
							<tr>
								<td>{{ $loop->iteration }}</td>
                                <td>
									{{$contact->name}}
								</td>
								<td>{{ $contact->email ?? '' }}</td>								
                                <td>
                                {{ $contact->mobile ?? '' }}
                                </td>
                                <td>
                                {{ $contact->subject ?? '' }}
                                </td>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $contact->message }}">
                                    {{ Str::limit($contact->message ?? '', 50) }}
                                </td>
								
							</tr>
						@endforeach  
					@else
					<tr>
						<td colspan="5" class="text-center">Contacts's Not Found</td>
					</tr>
					@endif                      
				</tbody>
			</table>
			<div class="d-flex justify-content-center mt-3">
				{{ $contacts->links() }}
			</div>
		</div>
	</div>
</div>

@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush