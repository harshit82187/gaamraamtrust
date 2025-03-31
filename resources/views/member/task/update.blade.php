@extends('member.layouts.app')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Task Update ( {{ $task->task ?? '' }}) </h4> 
                    <a href="{{ url('member/task-list') }}" class="btn btn-dark mx-2"  >Back</a>
                </div>
            </div>
        </div>
        <br>

        <div class="card" style="margin-left: -2%;">
            <div class="card-body">
                <form action="{{ route('member.task-updates') }}" method="POST" >
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <div id="taskDetails" >
                        <div class="row mb-2">                        
                                <div class="col-11">
                                    <input type="text" class="form-control" name="updates[]" placeholder="Enter Task Update">
                                </div>                       
                                <div class="col-1">
                                    <button type="button" class="btn btn-success add-row">+</button>
                                </div>                                               
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>  
                    </div>
                </form>   
            </div>
        </div>

        <div class="card "  style="margin-left: -2%;">
            <div class="card-body">
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Task Update</th>
                            <th>Update Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($taskUpdates->count() > 0)
                        @foreach($taskUpdates as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td> {{ $task->updates ?? 'N/A' }} <br>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d-M-Y') }} </td>                           
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3" class="text-danger text-center">No Task Update Yet.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center new-one-nav">
                    {{ $taskUpdates->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

<script>
    $(document).ready(function() {
        // Add new row
        $(document).on("click", ".add-row", function() {
            let rowHtml = `<div class="row mb-2">
                           <div class="col-11">
                                <input type="text" class="form-control" name="updates[]" placeholder="Enter Task Update">
                            </div>                            
                            <div class="col-1">
                                <button type="button" class="btn btn-danger remove-row">-</button>
                            </div>
                        </div>`;
            $("#taskDetails").append(rowHtml);
        });
        // Remove row
        $(document).on("click", ".remove-row", function() {
            $(this).closest(".row").remove();
        });
    });
</script>

@endpush