<div class="card" style="border-radius: 5px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
	<div class="card-header" style="display: flex; justify-content: start; align-items: center;padding:15px 25px !important;">
        <ul class="website-setting-menu p-0">
            <li><a href="{{ route('admin.social-pages.privacy-policy') }}" class="{{ Request::routeIs('admin.social-pages.privacy-policy') ? 'active' : '' }}" style="color: {{ Request::routeIs('admin.social-pages.privacy-policy') ? 'gray' : '#d56337' }}; padding:0 20px 0 15px">Privacy Policy</a></li>
            <li><a href="{{ route('admin.social-pages.term-condition') }}" class="{{ Request::routeIs('admin.social-pages.term-condition') ? 'active' : '' }}" style="color: {{ Request::routeIs('admin.social-pages.term-condition') ? 'gray' : '#d56337' }}; padding:0 20px 0 15px">Term & Condition</a></li>
            <li><a href="{{ route('admin.social-pages.privacy-policy') }}" class="{{ Request::routeIs('admin.social-pages.privacy-policy') ? 'active' : '' }}" style="color: #d56337;padding:0 20px 0 15px">Faq</a></li>
            <li><a href="{{ route('admin.social-pages.privacy-policy') }}" class="{{ Request::routeIs('admin.social-pages.privacy-policy') ? 'active' : '' }}" style="color: #d56337;padding:0 20px 0 15px">Blog</a></li>
            <li><a href="{{ route('admin.social-pages.privacy-policy') }}" class="{{ Request::routeIs('admin.social-pages.privacy-policy') ? 'active' : '' }}" style="color: #d56337;padding:0 20px 0 15px">Student Review</a></li>
        </ul>
    </div>
</div>