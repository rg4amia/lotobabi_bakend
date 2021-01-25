<div class="row justify-content-md-center">
    @if(Session::has('orig_user'))
        <div class="alert alert-light logged-in-as">
            <span class="badge badge-primary">{{ ('You are currently logged in as') }} {{ Auth::user()->name }}.</span>
            <span class="badge badge-dark">Switched to</span><span class="badge badge-success"> <a href="{{ route('users.logout-as') }}">{{ ('Re-Login as') }} {{ Session::get('orig_user')->name }}</a></span>
        </div>
    @endif
</div>
