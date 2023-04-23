<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/category/create') || Request::is('admin/category/*') ? 'collapse active' : 'collapsed' }}"
                    href="javascript:void();" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/category') || Request::is('admin/category/create') || Request::is('admin/category/*') ? 'show' : '' }}"
                    id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('admin/category/create') ? 'active' : '' }}"
                            href="{{ route('category.create') }}"><span class="fa fa-plus"></span>&nbsp;Add Category</a>
                        <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/category/edit*') ? 'active' : '' }}"
                            href="{{ route('category.index') }}"><span class="fa fa-eye"></span>&nbsp;View Category</a>
                    </nav>
                </div>
                <a class="nav-link {{ Request::is('admin/post/create') || Request::is('admin/post') ? 'active' : 'collapsed' }}"
                    href="javascript:void();" data-bs-toggle="collapse" data-bs-target="#collapsePage"
                    aria-expanded="false" aria-controls="collapsePage">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Post
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/post/create') || Request::is('admin/post') ? 'show' : '' }}"
                    id="collapsePage" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('admin/post/create') ? 'active' : '' }}"
                            href="{{ route('post.create') }}"><span class="fa fa-plus"></span>&nbsp;Add Post</a>
                        <a class="nav-link {{ Request::is('admin/post') ? 'active' : '' }}"
                            href="{{ route('post.index') }}"><span class="fa fa-eye"></span>&nbsp;View Post</a>
                    </nav>
                </div>
                <a class="nav-link {{ Request::is('admin/user/create') || Request::is('admin/user') ? 'active' : 'collapsed' }}"
                    href="javascript:void();" data-bs-toggle="collapse" data-bs-target="#collapseUser"
                    aria-expanded="false" aria-controls="collapseUser">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    User
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/user/create') || Request::is('admin/user') ? 'show' : '' }}"
                    id="collapseUser" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('admin/user/create') ? 'active' : '' }}"
                            href="{{ route('user.create') }}"><span class="fa fa-plus"></span>&nbsp;Add User</a>
                        <a class="nav-link {{ Request::is('admin/user') ? 'active' : '' }}"
                            href="{{ route('user.index') }}"><span class="fa fa-eye"></span>&nbsp;View User</a>
                    </nav>
                </div>

                <a class="nav-link {{ Request::is('admin/page/create') || Request::is('admin/page') ? 'active' : 'collapsed' }}"
                    href="javascript:void();" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-solid fa-page"></i></div>
                    Page
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/page/create') || Request::is('admin/page') ? 'show' : '' }}"
                    id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('admin/page/create') ? 'active' : '' }}"
                            href="{{ route('page.create') }}"><span class="fa fa-plus"></span>&nbsp;Add Page</a>
                        <a class="nav-link {{ Request::is('admin/page') ? 'active' : '' }}"
                            href="{{ route('page.index') }}"><span class="fa fa-eye"></span>&nbsp;View Page</a>
                    </nav>
                </div>

                <a class="nav-link {{ Request::is('admin/social/create') || Request::is('admin/social') ? 'active' : 'collapsed' }}"
                    href="javascript:void();" data-bs-toggle="collapse" data-bs-target="#collapsesocial"
                    aria-expanded="false" aria-controls="collapsesocial">
                    <div class="sb-nav-link-icon"><i class="fa fa-share-alt"></i></div>
                    Social Media
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/social/create') || Request::is('admin/social') ? 'show' : '' }}"
                    id="collapsesocial" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('admin/social/create') ? 'active' : '' }}"
                            href="{{ route('social.create') }}"><span class="fa fa-plus"></span>&nbsp;Add Page</a>
                        <a class="nav-link {{ Request::is('admin/social') ? 'active' : '' }}"
                            href="{{ route('social.index') }}"><span class="fa fa-eye"></span>&nbsp;View Page</a>
                    </nav>
                </div>
                <a class="nav-link {{ Request::is('admin/setting/create') || Request::is('admin/setting') ? 'active' : 'collapsed' }}"
                    href="{{ route('setting.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-cog"></i></div>
                    Setting
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
