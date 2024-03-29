<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.user.index') }}"
                class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Users
                    <span class="badge badge-info right">{{ $userCount }}</span>
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.driver.index') }}"
                class="nav-link {{ Route::is('admin.driver.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Drivers
                    <span class="badge badge-info right">{{ $driversCount }}</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.address.index') }}"
                class="nav-link {{ Route::is('admin.address.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Addresses
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ route('admin.role.index') }}" class="nav-link {{ Route::is('admin.role.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-tag"></i>
                <p>Role
                    <span class="badge badge-success right">{{$RoleCount}}</span>
                </p>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="{{ route('admin.permission.index') }}" class="nav-link {{ Route::is('admin.permission.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-hat-cowboy"></i>
                <p>Permission
                    <span class="badge badge-danger right">{{$PermissionCount}}</span>
                </p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('admin.company.index') }}"
                class="nav-link {{ Route::is('admin.company.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Company
                    <span class="badge badge-warning right">{{ $CompanyCount }}</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.category.index') }}"
                class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Category
                    <span class="badge badge-warning right">{{ $CategoryCount }}</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.subcategory.index') }}"
                class="nav-link {{ Route::is('admin.subcategory.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>Sub Category
                    <span class="badge badge-secondary right">{{ $SubCategoryCount }}</span>
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ route('admin.collection.index') }}" class="nav-link {{ Route::is('admin.collection.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-pdf"></i>
                <p>Collection
                    <span class="badge badge-primary right">{{$CollectionCount}}</span>
                </p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('admin.product.index') }}"
                class="nav-link {{ Route::is('admin.product.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>Products
                    <span class="badge badge-warning right">{{ $ProductCount }}</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.offer.index') }}"
                class="nav-link {{ Route::is('admin.offer.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>Offers
                    <span class="badge badge-warning right">{{ $OffersCount }}</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orderStatus.index') }}"
                class="nav-link {{ Route::is('admin.orderStatus.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>OrderStatus
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}"
                class="nav-link {{ Route::is('admin.orders.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Orders
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.profile.edit') }}"
                class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
                <i class="nav-icon fas fa-id-card"></i>
                <p>Profile</p>
            </a>
        </li>
    </ul>
</nav>
