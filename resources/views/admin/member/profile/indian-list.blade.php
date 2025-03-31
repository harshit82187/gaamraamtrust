@extends('admin.layout.app')
@section('content')

<div class="page-content">
	<div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <div class="mail-menu" style="display: flex; gap: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <img src="{{ asset('admin/assets/img/user-1.png') }}" style="width: 40px;">
                        <a href="{{ route('admin.member.indian-list') }}" 
                           style="color: {{ Request::routeIs('admin.member.indian-list') ? 'gray' : '#d56337' }};
                                  padding: 0 20px 5px 15px; 
                                  text-decoration: none;
                                  font-weight: {{ Request::routeIs('admin.member.indian-list') ? 'bold' : 'normal' }};
                                  display: inline-block;
                                  font-size: 20px;
                                  border-bottom: {{ Request::routeIs('admin.member.indian-list') ? '2px solid #6c757d' : 'none' }};">
                            Indian Member
                        </a>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <img src="{{ asset('admin/assets/img/user-2.png') }}" style="width: 40px;">
                        <a href="{{ route('admin.member.nri-list') }}" 
                           style="color: {{ Request::routeIs('admin.member.nri-list') ? 'gray' : '#d56337' }};
                                  padding: 0 20px 5px 15px; 
                                  text-decoration: none;
                                  font-weight: {{ Request::routeIs('admin.member.nri-list') ? 'bold' : 'normal' }};
                                  display: inline-block;
                                  font-size: 20px;
                                  border-bottom: {{ Request::routeIs('admin.member.nri-list') ? '2px solid #6c757d' : 'none' }};">
                            NRI Member
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        

	</div>
</div>
@endsection
@push('js')

@endpush
