<ul @if ($first===1) class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" @else class="nav nav-treeview" @endif>
    @foreach ($menus as $menu)
        @php
            $li = [];
            $a = [];
            $children = isset($menu->children) ? $menu->children : (object)[];
            $c_collect = collect($children);
            if($c_collect->count() && $first === 1) {
                $li[] = 'menu-open'; 
                // $li[] = '1'; 
                $a[] = 'active';
            }
            if ($c_collect->count()) {
                $actions_db_route = $c_collect->pluck('permission.database_route')->filter();
                $actions =array_unique($actions_db_route->map(function($child) {
                    return $child->resides_at."/".$child->route;
                })->all());
                if (in_array(request()->path(), $actions)) {
                    $li[] = 'menu-open'; 
                    // $li[] = '2'; 
                    $a[] = 'active';
                }
                $children = implode(',', $actions);
            }
            $action = '';
            if (isset($menu->permission) && isset($menu->permission->database_route) && isset($menu->permission->database_route->route)) {
                $action = 'manage/'.$menu->permission->database_route->route;
            }
            if (request()->path() == $action) {
                $li[] = 'menu-open';
                // $li[] = '3';
                $a[] = 'active';
            }
            $li = implode(' ', array_unique($li));
            $a = implode(' ', array_unique($a));
            $controller_name = '#';
            if (isset($menu->permission) && isset($menu->permission->database_route) && isset($menu->permission->database_route->controller_name)) {
                $controller_name = $menu->permission->database_route->controller_name;
            }
            $route = route('manage.home');
            if (isset($menu->permission) && isset($menu->permission->database_route) && isset($menu->permission->database_route->route)) {
                $route = route('manage.'.$menu->permission->database_route->named_route);
                // $route = url('manage/'.$menu->permission->database_route->route);
            }
        @endphp
        @if (in_array($menu->id, $range))
            @if ($menu->controller_name == '#' || ($menu->permission_id && $auth_role->hasDirectPermission($menu->permission_id)))
                <li class="nav-item {{$li}}">
                    <a href="{{$route}}" class="nav-link {{$a}}" data1="{{request()->path()." = ".$action}}">
                        <i class="nav-icon {{$menu->icon_class}}"></i>
                        <p>{{$menu->menu_name}}
                            @if($c_collect->count() > 0) <i class="fas fa-angle-left right"></i> @endif
                        </p>
                    </a>
                    @if($c_collect->count() > 0)
                    <x-admin-sidebar-menus1 :menus="$c_collect" :first="0" :range="$range" />
                    @endif
                </li>
            @endif
        @endif
    @endforeach
</ul>