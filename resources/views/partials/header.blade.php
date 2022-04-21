<div class="navbar bg-base-100">
    <div class="flex-1">
        <a href="{{ route('home') }}" class="btn btn-ghost normal-case text-xl">Support</a>
    </div>
    <div class="flex-none gap-5">
        <ul class="menu menu-horizontal p-0 gap-5 hidden md:flex">
            @guest
                <li><a href="{{ route('auth.login') }}" class="btn btn-outline btn-primary">Login</a></li>
                <li><a href="{{ route('auth.register') }}" class="btn btn-primary">Register</a></li>
            @endguest
            @auth
                @admin
                <span>Admin</span>
                @endadmin
                @user
                <li><a href="{{ route('tickets.create') }}" class="btn btn-ghost normal-case">Create a ticket</a></li>
                <li><a href="{{ route('tickets.index') }}" class="btn btn-ghost normal-case">Browse my tickets</a></li>
                @enduser
                <li><a>Hi, {{ auth()->user()->username }}</a></li>
            @endauth
        </ul>
        @auth
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        @endauth

    </div>
</div>
