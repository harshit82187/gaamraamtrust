@extends('member.layouts.app')
@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Payment Listing <span class="count-circle" style="margin-left: 1%;">{{ count($donations) }}</span> </h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form id="donate-online" method="POST" action="{{ route('member.donate') }}"  >
                    @csrf
                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                    <input type="hidden" name="transaction_via" value="razorpay">
                    <input type="hidden" name="merchant_order_id" value="<?= rand(11111, 99999) . time() ?>">
                    <div class="row">                     
                        <div class="col-md-6" style="margin-top: 18px;" >
                            <label>Amount (Minimum payable amount is 100 rupees) <span class="text-danger">* </span></label>
                            <input type="text" class="form-control amount" id="amount" name="amount" >
                           
                        </div>

                    
                        <div class="col-md-2" style="margin-top: 44px;" >
                            <input type="submit" class="btn btn-primary pay-online" value="Pay Online"  >
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>Payment History</h3>  
                <table class="table table-striped" id="dataTable">
                    <thead>
						<tr>
							<th>S No</th>
							<th>Amount</th>
							<th>Transaction ID</th>
							<th>Payment Date</th>
							<th>Action</th>
						</tr>
					</thead>
                    <tbody>
                        @if(isset($donations))
                        @foreach($donations as $donation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $donation->amount ?? '0' }}</td>
                            <td>{{ $donation->r_payment_id ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($donation->created_at)->format('d-M-Y') }} </td>
                            <td>
                                <a href="{{ asset($donation->donation_pdf) }}" target="_blank" class="btn btn-dark btn-sm" >Download Invoice</a>
                            </td>

                        </tr>
                        @endforeach
                        @endif

                    </tbody>
                </table>
               
            </div>
        </div>


    </div>
</div>






@endsection

@push('js')
<script>
var RAZORPAY_KEY = "{{ env('RAZORPAY_KEY') }}";
var razorpay_logo = "{{ asset('front/images/Gaam_Raam_logo.png') }}";
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="{{ asset('member/backend/js/razorpay.js') }}"></script>
<script>
    $(document).ready(function(){      
        $('.amount').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            var amount = parseInt($(this).val(), 10) || 0;
            console.log("Amount: " + amount);            
        });
    });    
</script>




@endpush