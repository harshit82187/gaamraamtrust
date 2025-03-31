@php use Illuminate\Support\Facades\Auth;@endphp
<div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
        
            <li class="nav-item">
                <a class="nav-link menu-link active" href="{{ route('member.dashboard') }}">
                    <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Dashboard</span>
                </a>
            </li>
        
            <li class="nav-item">
                <a href="{{ route('member.profile') }}" class="nav-link"> 
                    <i class="mdi mdi-account"></i> Profile
                </a>
            </li>
        
            <li class="nav-item">
                <a href="{{ route('member.payment') }}" class="nav-link"> 
                    <i class="mdi mdi-credit-card"></i> Payment
                </a>
            </li>
        
            <li class="nav-item">
                <a href="{{ route('member.task-list') }}" class="nav-link"> 
                    <i class="mdi mdi-clipboard-list"></i> Manage Task
                </a>
            </li>
        
            <li class="nav-item">
                <a href="#" class="nav-link"> 
                    <i class="mdi mdi-chart-line"></i> Progress Report
                </a>
            </li>
        
            <li class="nav-item">
                <a href="#" class="nav-link"> 
                    <i class="mdi mdi-bank"></i> Transparency & Financial Accountability
                </a>
            </li>
        
            <li class="nav-item">
                <a href="#" class="nav-link"> 
                    <i class="mdi mdi-trophy"></i> Earn & Share Achievements
                </a>
            </li>
        
            <li class="nav-item">
                <a href="#" class="nav-link"> 
                    <i class="mdi mdi-account-multiple-plus"></i> Referral
                </a>
            </li>
        
            <li class="nav-item">
                <a href="#" class="nav-link"> 
                    <i class="mdi mdi-podium"></i> Social Points & Leaderboard
                </a>
            </li>
        
            <li class="nav-item">
                <a href="#" class="nav-link"> 
                    <i class="mdi mdi-certificate"></i> Automatic 80G Certificate
                </a>
            </li>
        </ul>
        
    </div>
</div>