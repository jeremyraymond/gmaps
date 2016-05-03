<div    id="{{ $config['base_id'] }}{{ $map_num }}"
        class="gmap"
        data-base_id="{{ $config['base_id'] }}"
        data-map_num="{{ $map_num }}"
        data-config-key="{{ $config['key'] }}"
        data-config-zoom="{{ $config['zoom'] }}"

        @if(!empty($config['markers']))
            @foreach($config['markers'] as $key => $value)
            data-{{ $key }}="{{ $value['url'] }}|{{ $value['horiz_size'] }}|{{ $value['vert_size'] }}"
            @endforeach
        @endif

        data-latlngLats="@for($i = 0; $i < count($latlngArray); $i++){{ $latlngArray[$i]['lat'] }}@if($i < count($latlngArray) - 1),@endif @endfor"
        data-latlngLngs="@for($i = 0; $i < count($latlngArray); $i++){{ $latlngArray[$i]['lng'] }}@if($i < count($latlngArray) - 1),@endif @endfor"
        data-latlngMarkers="@for($i = 0; $i < count($latlngArray); $i++){{ $latlngArray[$i]['marker_name'] }}@if($i < count($latlngArray) - 1),@endif @endfor"

</div>