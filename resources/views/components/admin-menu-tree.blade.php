<ol class="{{$class}}">
    @foreach ($menus as $menu)
    @php
        $children = isset($menu->children) ? $menu->children : (object)[];
        $c_collect = collect($children);
    @endphp
    <li class="dd-item dd3-item" data-id="{{$menu->id}}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content">
            <span id="label_show-{{$menu->id}}">{{$menu->menu_name}}</span>
            <span class="span-right"><span id="link_show{{$menu->id}}">
                @if (isset($menu->permission) && isset($menu->permission->database_route))
                    {{$menu->permission->database_route->resides_at.'/'.$menu->permission->database_route->controller_name}}
                @else
                    #
                @endif
            </span>
                <a class="edit-button modify_{{$menu->id}}" id="menu-{{$menu->id}}" data-menu="{{collect($menu)->toJson()}}" menu_name="{{trim($menu->menu_name)}}" controller_name="{{trim($menu->controller_name)}}" icon_class="{{trim($menu->icon_class)}}" action_name="{{$menu->action}}" permission_id="{{$menu->permission_id}}" data-action="{{route('manage.menus.update', ['menu' => $menu->id])}}">
                    <i class=" fas fa-pencil-alt"></i>
                </a>
                @if ($menu->id != 1)
                <a class="del-button" id="{{$menu->id}}"><i class="fas fa-trash"></i></a>
                @endif
            </span>
        </div>
        @if($c_collect->count() > 0)
        <x-admin-menu-tree :menus="$c_collect" class="child" />
        @endif
    </li>
    @endforeach
</ol>