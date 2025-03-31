@extends('student.layout.app')
<style>
    .result-card {
        width: 100%;
        margin: auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
    }

    .result-card h3 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .result-card .score {
        font-size: 40px;
        font-weight: bold;
        color: #28a745;
    }

    .result-card .status {
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
    }

    .status.pass {
        color: #28a745;
    }

    .status.fail {
        color: #dc3545;
    }

    .result-details {
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .result-details p {
        margin: 5px 0;
        font-size: 16px;
    }

    .btn-group {
        margin-top: 20px;
    }
</style>
@section('content')

<div class="page-content">
    <div class="container">
        <div class="result-card">
            <h3>Test Result - {{ $testSeries->name ?? 'N/A' }}</h3>

            <div class="score">{{ $totalCorrect }}/{{ $totalQuestions }}</div>

            <div class="status {{ $totalCorrect >= ($totalQuestions * 0.5) ? 'pass' : 'fail' }}">
                {{ $totalCorrect >= ($totalQuestions * 0.5) ? 'Congratulations! You Passed 🎉' : 'Better Luck Next Time 😞' }}
            </div>

            <div class="result-details">
                <p><strong>Total Questions:</strong> {{ $totalQuestions }}</p>
                <p><strong>Correct Answers:</strong> {{ $totalCorrect }}</p>
                <p><strong>Wrong Answers:</strong> {{ $totalQuestions - $totalCorrect }}</p>
                <p><strong>Percentage:</strong> {{ round(($totalCorrect / $totalQuestions) * 100, 2) }}%</p>
            </div>

            <div class="btn-group">
                <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
