<div id="profile-nav" class="sticky-wrapper" data-name="{{$user->display_name}}">
    <nav id="user-nav-bar" class="navbar navbar-default mb0 sticky-fixed-nav" role="navigation">
        <div class="container mt10 mb10">
            <ul class="nav nav-pills nav-justified">
                <li class="{{ ($tab === 0 ? 'active' : ($tab === 'hub' ? 'active' : null)) }}"><a href="#hub">Class Hub</a></li>
                <li class="{{ $tab === 'attended' ? 'active' : null }}"><a href="#attended">Attended Classes</a></li>
                <li class="{{ $tab === 'upcoming' ? 'active' : null }}"><a href="#upcoming">Upcoming Classes</a></li>
                <li class="{{ $tab === 'activity' ? 'active' : null }}"><a href="#activity">Activity</a></li>
                <li class="{{ $tab === 'wallet' ? 'active' : null }}"><a href="#wallet">Wallet</a></li>
                <li class="{{ $tab === 'edit' ? 'active' : null }}"><a href="#edit">Edit Profile</a></li>
            </ul>
        </div>
    </nav>
</div>
