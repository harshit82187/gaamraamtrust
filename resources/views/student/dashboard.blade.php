@extends('student.layout.app')
@section('content')

<div class="page-content">

    
    @php  $marksheet_exists = \App\Models\Document::where('student_id',Auth::guard('student')->user()->id)->pluck('name')->toArray();  @endphp
    @if(!(in_array('1', $marksheet_exists) && in_array('2', $marksheet_exists)))
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header doc_uplader">
                    <h3>Please First Upload Your Document <a href="{{ route('student.document-list') }}" ><i class="fas fa-hand-point-right"></i>Click Here...</a> </h3>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- process bar by Arunkumar -->

    <div class="row">
        <div class="documnetss-process-detail">
            <div class="progress-bar-divv">
                <div class="progress-profile">
                    <div class="progress-value-profile"></div>
                        <span>40%</span>
                    
                </div>
                <div class="profile-complete">
                        <p>Complete profile</p>
                    </div>
            </div>
            <div class="progress-bar-divv">
                <div class="progress-doc">
                    <div class="progress-value-doc"></div>
                    <span>60%</span>.
                
                </div>
                <div class="profile-complete">
                    <p>Complete document</p>
                </div>
            </div>
           
                <div class="progress-bar-divv">
                    <div class="progress-test-test">
                        <div class="progress-value-test"></div>
                            <span>80%</span>
                        
                    </div>
                    <div class="profile-complete">
                            <p>
                        Test complete rate
                            </p>
                        </div>
                </div>
            
        </div>
        
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card l-bg-purple-dark hover">
                <a style="font-weight:bold;color:white;text-decoration:none;" href="{{ route('student.notification') }}">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fa fa-globe"></i></div>
                        <div class="card-content">
                            <h4 class="card-title" style="font-size: 20px; font-weight:700;">Notification</h4>
                            <div class="d-flex justify-content-between">
                                <span class="d-block" style="font-size: 20px;">{{ $notifications ?? '0' }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card l-bg-green-dark hover">
                <a style="font-weight:bold;color:white;text-decoration:none;" href="{{ route('student.document-list') }}">
                    <div class="card-statistic-3">
                        <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                        <div class="card-content">
                            <h4 class="card-title" style="font-size: 20px; font-weight:700;">Document </h4>
                            <div class="d-flex justify-content-between">
                                <span class="d-block" style="font-size: 20px;">{{ $documents ?? '0' }} </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection