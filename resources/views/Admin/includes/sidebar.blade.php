<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('public/Admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ @App\Models\User::find(Session::get('loggedinUserId'))->first_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-right pull-right"></i>
                </a>
            </li>
            <li class="treeview {{ preg_match("/admin.category|admin.products|admin.attribute.set.view|admin.attributes.view/",Route::currentRouteName()) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-coffee"></i>
                    <span>Catalog</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>


                <ul class="treeview-menu">
                    <li class="{{ preg_match("/admin.category/",Route::currentRouteName()) ? 'active' : '' }}"><a href="{{ route('admin.category.view') }}"><i class="fa fa-circle-o"></i> Category</a></li>
                    <li class="{{ preg_match("/admin.attribute.set.view/",Route::currentRouteName()) ? 'active' : '' }}"><a href="{{ route('admin.attribute.set.view') }}"><i class="fa fa-circle-o"></i>Attribute Set</a></li>
                    <li class="{{ preg_match("/admin.attributes.view/",Route::currentRouteName()) ? 'active' : '' }}"><a href="{{ route('admin.attributes.view') }}"><i class="fa fa-circle-o"></i>Attribute</a></li>

                    <li class="{{ preg_match("/admin.products/",Route::currentRouteName()) ? 'active' : '' }}"><a href="{{ route('admin.products.view') }}"><i class="fa fa-circle-o"></i> Products</a></li>

                </ul>
            </li>
            <li class="treeview {{ preg_match("/admin.roles.view|admin.systemusers.view/",Route::currentRouteName())? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>ACL</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ preg_match("/admin.roles.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.roles.view') }}"><i class="fa fa-circle-o"></i>Roles</a></li>
                    <li class="{{ preg_match("/admin.systemusers.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.systemusers.view') }}"><i class="fa fa-circle-o"></i>Users</a></li>


                </ul>
            </li>


            <li class="treeview {{ preg_match("/admin.miscellaneous.view/",Route::currentRouteName()) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Miscellaneous</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ preg_match("/admin.miscellaneous.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.miscellaneous.view') }}"><i class="fa fa-circle-o"></i>Settings</a></li>


                </ul>
            </li>

        
     
          
      
          
        
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>