<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item @if(request()->url() === route('admin.dashboard')) active @endif">
                <a href="{{route('admin.dashboard')}}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">The Main </span></a>
            </li>

            <li class="nav-item @if(request()->url() === route('index.articles')) active @endif">
                <a href="{{route('index.articles')}}"><i class="la la-newspaper-o"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">Articles </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Article::count()}}</span>

                </a>

            </li>

            <li class="nav-item @if(request()->url() === route('index.tags')) active @endif">
                <a href="{{route('index.tags')}}"><i class="la la-tags"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">Tags </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Tag::count()}}</span>

                </a>

            </li>

        </ul>
    </div>
</div>
