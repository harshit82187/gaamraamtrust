@extends('student.layout.app')
@section('content')
@push('css')
<style>
    /* Test Series Card Styling */
.test-series-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    margin-bottom: 20px;
}

.test-series-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.test-series-card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
}

.test-series-card h5 {
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.test-series-badge {
    background-color: #17a2b8;
    color: white;
    font-size: 14px;
    padding: 5px 10px;
    border-radius: 8px;
    display: inline-block;
    margin-top: 10px;
}

.btn-view {
    display: inline-block;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 15px;
    font-size: 14px;
    border-radius: 20px;
    margin-top: 15px;
    text-decoration: none;
}


</style>
@endpush
<div class="page-content">
    <div class="row">
        @foreach($testSeries as $series)
        @php $questions = \App\Models\QuestionBank::where('test_series_id',$series->id)->get(); @endphp
        <div class="col-md-4">
            <a href="{{ route('student.get-test-series', ['slug' => $series->slug]) }}">
                <div class="test-series-card">
                    <img src="{{ asset($series->image ?? 'front/images/no-image.jpg') }}" alt="Test Series Image">
                    <h5>{{ $series->name }}</h5>
                    <span class="test-series-badge">{{ count($questions) ?? '0' }} Questions</span>
                    <button class="btn-view">Attempt Test</button>
                </div>
            </a>
          
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $testSeries->links() }} <!-- Pagination -->
    </div>
</div>
@endsection
