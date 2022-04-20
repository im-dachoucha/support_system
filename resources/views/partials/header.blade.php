<div class="navbar bg-base-100">
    <div class="flex-1">
        <a href="{{ route('home') }}" class="btn btn-ghost normal-case text-xl">Support</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal p-0 gap-5">
            @guest
                <li><a href="{{ route('auth.login') }}" class="btn btn-outline btn-primary">Login</a></li>
                <li><a href="{{ route('auth.register') }}" class="btn btn-primary">Register</a></li>
            @endguest
            @auth
                <li><a class="">Hi, {{ auth()->user()->username }}</a></li>
                @admin
                <span>Admin</span>
                @endadmin
                @user
                <span>user</span>
                @enduser
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            @endauth
        </ul>
    </div>
</div>
