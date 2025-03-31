@extends('admin.layout.app')
@section('content')
<style>
    .website-setting-menu li{
        list-style-type:none;
    }
    .website-setting-menu li a {
    text-decoration: none;
    border-left: 3px solid rgba(0, 0, 0, 0.568);
    padding: 0 33px;
    font-size: 16px;
    font-weight: 700;
    }
    
.website-setting-menu {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin: 0;
    width: 100%;
    gap: 20px;
}
.website-setting-menu li:first-child a {
    border-left: 0;
}
</style>
@include('admin.setting.social-pages.menu-bar')

<div class="card" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;border-radius: 15px;padding: 15px;">
    <div class="card-body">
        <form action="{{ route('admin.social-pages.privacy-policy') }}" method="POST" >
            @csrf
            <div class="row">
                <div class="col-12">
                    <label style="font-size: 20px !important;font-weight: 500;">Privacy Policy<span class="text-danger ml-2" >*</span></label> 
                    <textarea class="form-control summernote" cols="8" rows="8" name="value">{!! $privacyPolicy->value ?? '' !!}</textarea> 
                </div>
                <div class="col-4 mt-5">
                    <input type="submit" class="btn btn-primary " value="Update" >
                </div>
                
            </div>
        </form>      
    </div>  
</div>

@endsection
@push('js')
<script>
	$(document).ready(function() {        
	    $('.summernote').summernote({
	    tabsize: 2,
	    height: 550,
	    toolbar: [
	      ['style', ['style']],
	      ['font', ['bold', 'underline', 'clear']],
	      ['color', ['color']],
	      ['para', ['ul', 'ol', 'paragraph']],
	      ['table', ['table']],
	      ['insert', ['link', 'picture', 'video']],
	      ['view', ['fullscreen', 'codeview', 'help']]
	    ]
	   });
	
	});
</script>


@endpush