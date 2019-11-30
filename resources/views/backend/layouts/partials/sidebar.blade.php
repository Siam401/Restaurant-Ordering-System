<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ (request()->is('category')) ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-sidebar"></i>
                        </span>
                        <span class="pcoded-mtext">Category</span>
                    </a>
                </li>
                <li class="{{ (request()->is('table')) ? 'active' : '' }}">
                    <a href="{{ route('table.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-grid"></i>
                        </span>
                        <span class="pcoded-mtext">Table</span>
                    </a>
                </li>
                <li class="{{ (request()->is('item')) ? 'active' : '' }}">
                    <a href="{{ route('item.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-layers"></i>
                        </span>
                        <span class="pcoded-mtext">Item</span>
                    </a>
                </li>
                <li class="{{ (request()->is('setitem')) ? 'active' : '' }}">
                    <a href="{{ route('setitem.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Set Item</span>
                    </a>
                </li>
                <li class="pcoded-hasmenu {{ (request()->is('order')) || (request()->is('order/complete')) ? 'active pcoded-trigger' : '' }}">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                            <span class="pcoded-mtext">Order</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="{{ (request()->is('order')) ? 'active' : '' }}">
                                <a href="{{ route('order.index') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Pending Order</span>
                                </a>
                            </li>
                            <li class="{{ (request()->is('order/complete')) ? 'active' : '' }}">
                                <a href="{{ route('order.complete') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Complete Order</span>
                                </a>
                            </li>
                            <li class="{{ (request()->is('all/order')) ? 'active' : '' }}">
                                <a href="{{ route('order.all') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">All Order</span>
                                </a>
                            </li>
                            <li class="{{ (request()->is('order/bill/complete')) ? 'active' : '' }}">
                                <a href="{{ route('bill.complete') }}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext">Bill Complete</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                {{-- <li class="{{ (request()->is('sale')) ? 'active' : '' }}">
                    <a href="{{ route('order.sale') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-barcode"></i>
                        </span>
                        <span class="pcoded-mtext">Sale</span>
                    </a>
                </li> --}}
                <li class="{{ (request()->is('place/order')) ? 'active' : '' }}">
                    <a href="{{ route('order.create') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            {{-- <i class="feather icon-menu"></i> --}}
                            <i class="fa fa-barcode"></i>
                        </span>
                        <span class="pcoded-mtext">Order</span>
                    </a>
                </li>
                <li class="{{ (request()->is('employee')) ? 'active' : '' }}">
                    <a href="{{ route('employee.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            {{-- <i class="feather icon-menu"></i> --}}
                            <i class="fa fa-user"></i>
                        </span>
                        <span class="pcoded-mtext">Employee</span>
                    </a>
                </li>
                {{-- <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                        <span class="pcoded-mtext">Page layouts</span>
                        <span class="pcoded-badge label label-warning">NEW</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=" pcoded-hasmenu">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Vertical</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="">
                                    <a href="menu-static.html" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Static Layout</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="menu-header-fixed.html" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Header Fixed</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="menu-compact.html" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Compact</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="menu-sidebar.html" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Sidebar Fixed</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class=" pcoded-hasmenu">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Horizontal</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="">
                                    <a href="menu-horizontal-static.html" target="_blank" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Static Layout</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="menu-horizontal-fixed.html" target="_blank" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Fixed layout</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="menu-horizontal-icon.html" target="_blank" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Static With Icon</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="menu-horizontal-icon-fixed.html" target="_blank" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Fixed With Icon</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="menu-bottom.html" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Bottom Menu</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="navbar-light.html" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Navigation</span>
                    </a>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-layers"></i>
                        </span>
                        <span class="pcoded-mtext">Widget</span>
                        <span class="pcoded-badge label label-danger">100+</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="widget-statistic.html" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Statistic</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="widget-data.html" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Data</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="widget-chart.html" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Chart Widget</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>