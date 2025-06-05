<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                {{-- Dashboard --}}
                <li >
                    <a href="{{ route('admin.dashboards') }}">
                        <i class='bx bx-home'></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Users List --}}
                @if(auth("admin")->user()->can("index.user"))
                    <li class="">
                        <a href="{{ route('admin.customer.index') }}">
                            <i class='bx bx-user'></i>
                            <span >Users</span>
                        </a>
                    </li>
                @endif

                {{-- Contact List --}}
                @if(auth("admin")->user()->can("index.contact"))
                    <li class="">
                        <a href="{{ route('admin.contact.index') }}">
                            <i class='bx bx-phone-call'></i>
                            <span >Contacts</span>
                        </a>
                    </li>
                @endif
                
                {{-- Subscription List --}}
                <li class="">
                    <a href="{{ route('admin.subscription.index') }}">
                        <i class='bx bx-purchase-tag'></i>
                        <span>Subscriptions</span>
                    </a>
                </li>

                {{-- Faq List --}}
                <li class="">
                    <a href="{{ route('admin.faq.index') }}">
                        <i class='bx bx-message-dots'></i>
                        <span>Faq</span>
                    </a>
                </li>

                {{-- Custom Pages --}}
                <li class="@yield('custom_page')">
                    <a href="{{ route('admin.customPage.index') }}" >
                        <i class='bx bx-folder-open'></i>
                        <span >Custom Pages</span>
                    </a>
                </li>

                {{-- Custom Pages --}}
                <li class="">
                    <a href="{{ route('admin.pos.index') }}" >
                        <i class='bx bx-laptop'></i>
                        <span >POS Software</span>
                    </a>
                </li>

                {{-- Attribute --}}
                @if(auth("admin")->user()->can("index.attribute"))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class='bx bx-message-square-dots'></i>
                            <span >Attribute</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            {{-- <li >
                                <a href="{{ route('admin.attribute.name.index') }}">
                                    <span >Attribute Name</span>
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('admin.attribute.value.index') }}">
                                    <span >Attributes</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="menu-title" data-key="t-menu">Finance & Accounts</li>
                {{-- HRMS --}}
                <li class="@yield('hrms')">
                    <a href="javascript:void();" class="has-arrow @yield('hrms_a')">
                        <i class='bx bx-cart'></i>
                        <span >Accounts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li >
                            <a href="{{ route('admin.hrms.expense.index') }}">
                                <i class='bx bx-cart'></i>
                                <span >Expense</span>
                            </a>
                        </li>
                        {{-- <li class>
                            <a href="{{ route('admin.hrms.multi') }}">
                                <i class='bx bx-cart'></i>
                                <span >Multi</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                {{-- E-commerce --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-cart'></i>
                        <span >E-commerce</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li >
                            <a href="{{ route('admin.coupons.index') }}">
                                <span >Coupons</span>
                            </a>
                        </li>

                        <li >
                            <a href="{{ route('admin.shipping-rule.index') }}">
                                <span >Shipping Rule</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Marketing --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-paper-plane'></i>
                        <span >Marketing</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.flashSale.item.index') }}">
                                <span >Flash Sale Product</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.product.collection.index') }}">
                                <span >Collection Product</span>
                            </a>
                        </li>

                        <li >
                            <a href="javascript: void(0);">
                                <span >Ad Banner</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                {{-- All Products List --}}
                <li >
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-package'></i>
                        <span >Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.category.index') }}">
                                <span >Categories</span>
                            </a>
                        </li>

                        <li >
                            <a href="{{ route('admin.subcategory.index') }}">
                                <span >Sub-Categories</span>
                            </a>
                        </li>

                        <li >
                            <a href="{{ route('admin.childCategory.index') }}">
                                <span >child-Categories</span>
                            </a>
                        </li>

                        <li >
                            <a href="{{ route('admin.brand.index') }}">
                                <span>Brands</span>
                            </a>
                        </li>

                        <li >
                            <a href="{{ route('admin.product.index') }}">
                                <span >Products</span>
                            </a>
                        </li>

                        <li >
                            <a href="{{ route('admin.reviews.index') }}">
                                <span >Reviews</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Order List --}}
                @if(auth("admin")->user()->can("index.order"))
                    <li class="@yield('all_orders')">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class='bx bx-line-chart'></i>
                            <span >Order Panel</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li class="@yield('all_orders')">
                                <a href="{{ route('admin.order.index', ['status' => 'all']) }}">
                                    <span >All Orders</span>
                                </a>
                            </li>
                            <li class="@yield('all_orders')">
                                <a href="{{ route('admin.order.index', ['status' => 'pending']) }}">
                                    <span >Pending Order</span>
                                </a>
                            </li>
                            <li class="@yield('all_orders')">
                                <a href="{{ route('admin.order.index', ['status' => 'dropped_off']) }}">
                                    <span >Dropped Off Order</span>
                                </a>
                            </li>
                            <li class="@yield('all_orders')">
                                <a href="{{ route('admin.order.index', ['status' => 'shipped']) }}">
                                    <span >Shipped Order</span>
                                </a>
                            </li>
                            <li class="@yield('all_orders')">
                                <a href="{{ route('admin.order.index', ['status' => 'delivered']) }}">
                                    <span >Delivered Order</span>
                                </a>
                            </li>
                            <li class="@yield('all_orders')">
                                <a href="{{ route('admin.order.index', ['status' => 'cancelled']) }}">
                                    <span >Cancelled Order</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Transaction List --}}
                @if(auth("admin")->user()->can("index.transaction"))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class='bx bx-pie-chart-alt-2'></i>
                            <span >Transaction Panel</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.transaction.index') }}">
                                    <span >All Transactions</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Manage Website --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-grid-alt'></i>
                        <span >Manage Website</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.slider.index') }}">
                                <span >Slider</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.home.page.setting') }}">
                                <span >Home Setting</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Role & Permission --}}
                @if(auth("admin")->user()->can("main-admin-access"))
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-lock'></i>
                        <span>Admin Permission</span>
                    </a>
                    
                    <ul class="sub-menu" aria-expanded="false">
                        @if(auth("admin")->user()->can("index.permission"))
                            <li>
                                <a href="{{ route('admin.permission.index') }}">
                                    <span >Permission</span>
                                </a>
                            </li>
                        @endif

                        @if(auth("admin")->user()->can("index.role"))
                            <li class="@yield('edit_role')">
                                <a href="{{ route('admin.role.index') }}">
                                    <span >Role</span>
                                </a>
                            </li>
                        @endif

                        @if(auth("admin")->user()->can("index.admin-role"))
                            <li>
                                <a href="{{ route('admin.admin-role.index') }}">
                                    <span >All Admins</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @endif


                {{-- Landing Page --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-grid-alt'></i>
                        <span>Landing Page</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="">
                            <a href="javascript: void(0);" class="has-arrow" data-key="t-level-1-2" aria-expanded="false">Beauty Page</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true" style="height: 0px;">
                                <li>
                                    <a href="{{ route('admin.serum.demo') }}" data-key="t-level-2-1">Serum Product</a>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" data-key="t-level-2-2">Level 2.2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>


                {{-- Setting Website --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class='bx bx-cog'></i>
                        <span >Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if(auth("admin")->user()->can("general.setting"))
                            <li>
                                <a href="{{ route('admin.settings.index') }}">
                                    <span>General Settings</span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('admin.profiles') }}">
                                <span>Profile Update</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.profiles') }}">
                                <span>Profile Update</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('admin.essential.setting') }}">
                                <span>Essential Setting</span>
                            </a>
                        </li>

                        @if(auth("admin")->user()->can("email.config.setting"))
                            <li>
                                <a href="{{ route('admin.email.setup') }}">
                                    <span>Email Configuration</span>
                                </a>
                            </li>
                        @endif

                        <li class="">
                            <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                                <span data-key="t-invoices">Generate Print</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false" style="height: 0px;">
                                <li>
                                    <a href="{{ route('admin.slider.index') }}">
                                        <span >Print Barcode</span>
                                    </a>
                                </li>
        
                                <li>
                                    <a href="{{ route('admin.qrcode.index') }}">
                                        <span >Print Qrcode</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('admin.marquee.index') }}">
                                <span>Slide Advertise</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
