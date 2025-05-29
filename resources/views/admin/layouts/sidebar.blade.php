<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/banner*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('banner.index')}}">
            <i class="fas fa-fw fa-image"></i>
            <span>Banner</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/category*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('category.index')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Category</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/brand*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('brand.index')}}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Brand</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/product*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('product.index')}}">
            <i class="fas fa-fw fa-box"></i>
            <span>Product</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/post*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('post.index')}}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Post</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/message*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('message.index')}}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Message</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('order.index')}}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Order</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/shipping*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('shipping.index')}}">
            <i class="fas fa-fw fa-truck"></i>
            <span>Shipping</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/coupon*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('coupon.index')}}">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>Coupon</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/user*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span>
        </a>
    </li>

    <!-- Nav Item - Seller Management -->
    <li class="nav-item {{ Request::is('admin/sellers*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.sellers.index')}}">
            <i class="fas fa-fw fa-store"></i>
            <span>Seller Management</span>
        </a>
    </li>

    <!-- Nav Item - Pending Products -->
    <li class="nav-item {{ Request::is('admin/pending-products*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.products.pending')}}">
            <i class="fas fa-fw fa-clock"></i>
            <span>Pending Products</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/post-category*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('post-category.index')}}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Post Category</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/post-tag*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('post-tag.index')}}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Post Tag</span>
        </a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ Request::is('admin/notifications*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('all.notification')}}">
            <i class="fas fa-fw fa-bell"></i>
            <span>Notifications</span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Request::is('admin/settings*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('settings')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar --> 