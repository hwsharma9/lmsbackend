<ul @if ($first === 1)
class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"
@else
class="nav nav-treeview"
@endif
>
@foreach ($menus as $menu)
@php
    $li = [];
    $a = [];
    $data = $menu->child;
    if(count($menu->child)>0 && $first === 1) {
        $li[] = 'menu-open'; 
        $li[] = '1'; 
        $a[] = 'active';
    }
    if (count($data) > 0) {
        $actions = array_unique($data->pluck('action')->all());
        // print_r($actions);
        if (in_array(request()->path(), $actions)) {
            $li[] = 'menu-open'; 
            $li[] = '2'; 
            $a[] = 'active';
        }
        $data = implode(',', $actions);
    }
    if (request()->path() == $menu->action) {
        $li[] = 'menu-open'; 
        $li[] = '3'; 
        $a[] = 'active';
    }
    $li = implode(' ', array_unique($li));
    $a = implode(' ', array_unique($a));
@endphp
        @if (in_array($menu->id, $range))
            @if ($menu->controller_name == '#' || ($menu->permission_id && $auth_role->hasDirectPermission($menu->permission_id)))
                <li class="nav-item {{$li}}">
                    <a href="{{($menu->permission && $menu->permission->databaseRoute)?url('manage/'.$menu->permission->databaseRoute->route):url('manage/home')}}" 
                        class="nav-link {{$a}}" data="{{$data}}" data1="{{request()->path().' == '.$menu->action}}">
                        <i class="nav-icon {{$menu->icon_class}}"></i>
                        <p>{{$menu->menu_name}}
                            @if(count($menu->child)>0) <i class="fas fa-angle-left right"></i> @endif
                        </p>
                    </a>
                    @if(count($menu->child)>0)
                        <x-admin-sidebar-menus :menus="$menu->child" :first="0" :range="$range" />
                    @endif
                </li>
            @endif
        @endif
    @endforeach
</ul>