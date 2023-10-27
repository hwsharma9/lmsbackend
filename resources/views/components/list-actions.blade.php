<div class="d-flex felx-row justify-content-around">
    @if (array_key_exists('edit', $actions))
        @if (Gate::allows('check-auth', $actions['edit']))
            <a class="btn btn-primary" title="Edit Model" href="{{route($actions['edit'], $model['id'])}}"><i class="fas fa-edit"></i></a>
        @endif
    @endif
    @if (array_key_exists('show', $actions))
        @if (Gate::allows('check-auth', $actions['show']))
            <a class="btn btn-secondary" title="View Model" href="{{route($actions['show'], $model['id'])}}"><i class="fas fa-eye"></i></a>
        @endif
    @endif
    @if (array_key_exists('delete', $actions))
        @if (Gate::allows('check-auth', $actions['delete']))
            <form action="{{route($actions['delete'], $model['id'])}}" method="POST" class="delete-model">
                @method('DELETE')
                @csrf
                @if(!is_null($model['deleted_at']))
                    <input type="hidden" name="restore" value="1">
                    <button class="btn btn-success" title="Restore Model" type="submit"><i class="fas fa-trash-restore"></i></button>
                @else
                    <button class="btn btn-danger" title="Delete Model" type="submit"><i class="fas fa-trash"></i></button>
                @endif
            </form>
        @endif
    @endif
    @if (array_key_exists('extra', $actions))
        @if (is_array($actions['extra']))
            {!! implode('', $actions['extra']) !!}
        @else
            {!! $actions['extra'] !!}
        @endif
    @endif
</div>