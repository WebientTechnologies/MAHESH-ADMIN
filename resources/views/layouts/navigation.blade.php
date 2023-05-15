<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('families.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Family') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('galleries.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-image"></i>
                    <p>
                        {{ __('Gallery') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-business-time nav-icon"></i>
                    <p>
                        Business Management
                        <i class="fas fa-angle-right left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('businesses.index') }}" class="nav-link">
                            <i class="far fa-circle  nav-icon"></i>
                            <p>Business</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Business Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subcategories.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Business Sub Category</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('promotions.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-ad"></i>
                    <p>
                        {{ __('Business Promotion') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('newses.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        {{ __('News') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('events.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                        {{ __('Events') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('quizzes.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-question"></i>
                    <p>
                        {{ __('Quiz') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('winners.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-question"></i>
                    <p>
                        {{ __('Winner') }}
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->