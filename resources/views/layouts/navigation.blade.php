<!-- Sidebar -->
<div class="sidebar" style="overflow-y: hidden;">
    <!-- Sidebar user panel (optional) -->
 
    <!-- Sidebar Menu -->
    <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('families.index') }}" class="nav-link {{ request()->is('families*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Family') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('galleries.index') }}" class="nav-link {{ request()->is('galleries*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-image"></i>
                    <p>
                        {{ __('Gallery') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('businesses*') || request()->is('categories*') || request()->is('subcategories*') ? 'active' : '' }}">
                    <i class="fas fa-business-time nav-icon"></i>
                    <p>
                        Occupation Management
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('businesses.index') }}" class="nav-link {{ request()->is('businesses*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Occupation</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Occupation Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subcategories.index') }}" class="nav-link {{ request()->is('subcategories*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Occupation Sub Category</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('promotions.index') }}" class="nav-link {{ request()->is('promotions*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-ad"></i>
                    <p>
                        {{ __('Occupation Promotion') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('newses.index') }}" class="nav-link {{ request()->is('newses*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        {{ __('News') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('events.index') }}" class="nav-link {{ request()->is('events*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                        {{ __('Events') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('quizzes.index') }}" class="nav-link {{ request()->is('quizzes*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-question"></i>
                    <p>
                        {{ __('Quiz') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('winners.index') }}" class="nav-link {{ request()->is('winners*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>
                        {{ __('Winner') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('requests.index') }}" class="nav-link {{ request()->is('requests*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-registered"></i>
                    <p>
                        {{ __('Request') }}
                    </p>
                </a>
            </li>
        </ul>

        <div class="custom-text" style="position: absolute; bottom: 20px; width: 100%;">
            <p style="color: white;">Designed and developed by MAK Online Solution </p>
            <a href="https://www.makonlinesolutions.com" target="https://www.makonlinesolutions.com" style="color: yellow;">www.makonlinesolutions.com</a>
        </div>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
