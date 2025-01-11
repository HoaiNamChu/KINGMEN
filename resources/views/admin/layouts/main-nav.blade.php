<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="{{route('admin.dashboard')}}" class="logo-dark">
            <img src="{{ asset('theme/admin/assets/images/logo-sm.png') }}" class="logo-sm" alt="logo sm">
            <img src="{{ asset('theme/admin/assets/images/logo-dark.png') }}" class="logo-lg" alt="logo dark">
        </a>

        <a href="{{route('admin.dashboard')}}" class="logo-light">
            <img src="{{ asset('theme/admin/assets/images/logo-sm.png') }}" class="logo-sm" alt="logo sm">
            <img src="{{ asset('theme/admin/assets/images/logo-light.png') }}" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">General</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Dashboard </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ collect(['products', 'categories', 'tags', 'attributes', 'attributeValues'])->contains(fn($keyword) => Str::contains(request()->path(),['products', 'categories', 'tags', 'attributes', 'attributeValues'])) ? 'active' : '' }}"
                   href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ collect(['products', 'categories', 'tags', 'attributes', 'attributeValues'])->contains(fn($keyword) => Str::contains(request()->path(),['products', 'categories', 'tags', 'attributes', 'attributeValues'])) ? 'true' : 'false' }}"
                   aria-controls="sidebarProducts">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Products </span>
                </a>
                <div
                    class="collapse {{ collect(['products', 'categories', 'tags', 'attributes', 'attributeValues'])->contains(fn($keyword) => Str::contains(request()->path(),['products', 'categories', 'tags', 'attributes', 'attributeValues'])) ? 'show' : '' }}"
                    id="sidebarProducts">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.products.index') }}">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.products.create') }}">Create</a>
                        </li>
                        <li class="sub-nav-item {{ strpos(url()->current(), 'categories') ? 'active' : '' }}">
                            <a class="sub-nav-link {{ strpos(url()->current(), 'categories') ? 'active' : '' }}"
                               href="{{ route('admin.categories.index') }}">Categories</a>
                        </li>
                        <li class="sub-nav-item {{ strpos(url()->current(), 'tags') ? 'active' : '' }}">
                            <a class="sub-nav-link {{ strpos(url()->current(), 'tags') ? 'active' : '' }}"
                               href="{{ route('admin.tags.index') }}">Tags</a>
                        </li>
                        <li class="sub-nav-item {{ strpos(url()->current(), 'attributes') ? 'active' : '' }}">
                            <a class="sub-nav-link {{ strpos(url()->current(), 'attributes') ? 'active' : '' }}"
                               href="{{ route('admin.attributes.index') }}">Attributes</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ strpos(url()->current(), 'brands') ? 'active' : '' }}"
                   href="#sidebarBrands" data-bs-toggle="collapse" role="button"
                   aria-expanded=" {{ strpos(url()->current(), 'brands') ? 'true' : 'false' }}"
                   aria-controls="sidebarBrands">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Brands </span>
                </a>
                <div class="collapse {{ strpos(url()->current(), 'brands') ? 'show' : '' }}" id="sidebarBrands">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.brands.index') }}">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.brands.create') }}">Create</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.orders.index')}}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Orders </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ strpos(url()->current(), 'posts') ? 'active' : '' }}"
                   href="#sidebarPost" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ strpos(url()->current(), 'posts') ? 'true' : 'false' }}"
                   aria-controls="sidebarPost">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Posts </span>
                </a>
                <div class="collapse {{ strpos(url()->current(), 'posts') ? 'show' : '' }}" id="sidebarPost">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('admin.posts.index') }}">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link " href="{{ route('admin.posts.create') }}">Create</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.settings.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Settings </span>
                </a>
            </li>

            <li class="menu-title mt-2">Users</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Users </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarRoles">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:user-speak-rounded-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Roles </span>
                </a>
                <div class="collapse" id="sidebarRoles">
                    <ul class="nav sub-navbar-nav">
                        <ul class="nav sub-navbar-nav">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('admin.roles.index') }}">List</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{ route('admin.roles.create') }}">Create</a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.permissions.index')}}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:checklist-minimalistic-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Permissions </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarCustomers" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarCustomers">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Customers </span>
                </a>
                <div class="collapse" id="sidebarCustomers">
                    <ul class="nav sub-navbar-nav">

                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="customer-list.html">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="customer-detail.html">Details</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarSellers" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarSellers">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:shop-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Sellers </span>
                </a>
                <div class="collapse" id="sidebarSellers">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="seller-list.html">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="seller-details.html">Details</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="seller-edit.html">Edit</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="seller-add.html">Create</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-title mt-2">Other</li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.slides.index')}}">
                                     <span class="nav-icon">
                                        <iconify-icon icon="solar:streets-map-point-bold-duotone"></iconify-icon>
                                     </span>
                    <span class="nav-text"> Sliders </span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarCoupons" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarCoupons">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:leaf-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Coupons </span>
                </a>
                <div class="collapse" id="sidebarCoupons">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="coupons-list.html">List</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="coupons-add.html">Add</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-title mt-2">Other Apps</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.chats.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:chat-round-bold-duotone"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Chat </span>
                </a>
            </li>
        </ul>
    </div>
</div>
