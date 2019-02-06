@if(isset($options->model) && isset($options->type))

    @if(class_exists($options->model))

        @php $relationshipField = $row->field; @endphp

        @if($options->type == 'belongsTo')

            @if(isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $model = app($options->model);
                    $query = $model::find($relationshipData->{$options->column});
                @endphp

                @if(isset($query))
                    <a href="/admin/{{ $options->table }}/{{ $query->{$options->key} }}">{{ $query->{$options->label} }}</a>
                @else
                    <p>{{ __('voyager::generic.no_results') }}</p>                    
                @endif
            @endif
        @endif
    @endif
@endif