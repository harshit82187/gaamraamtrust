@extends('member.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Task List <span class="count-circle" style="margin-left: 1%;" >{{ count($tasks) }}</span> </h4> 
                </div>
            </div>
        </div>
        <br>

        <div class="card" style="margin-left: -2%;">
            <div class="card-body">
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Task Name</th>
                            <th>Assign Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($tasks->count() > 0)
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td> {{ $task->task ?? 'N/A' }} <br>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d-M-Y') }} </td>
                            <td>
                               <a href="{{ route('member.task-update', $task->id) }}" class="btn btn-dark" >Update Task</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-danger text-center">No Task Assigned Yet.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center new-one-nav">
                    {{ $tasks->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush