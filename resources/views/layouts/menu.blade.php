<li class="{{ Request::is('stations*') ? 'active' : '' }}">
    <a href="{!! route('stations.index') !!}"><i class="fa fa-edit"></i><span>Stations</span></a>
</li>

<li class="{{ Request::is('readings*') ? 'active' : '' }}">
    <a href="{!! route('readings.index') !!}"><i class="fa fa-edit"></i><span>Readings</span></a>
</li>

