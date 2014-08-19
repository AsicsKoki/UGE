<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
    <ul class="nav navbar-default ">
      <li class="{{Route::is('analyzers') ? 'bold' : ''}}"><a href="{{ URL::route('analyzers') }}">Analyzers</a>
        </li>
        <li class="{{Route::is('getHubs') ? 'bold' : ''}}"><a href="{{ URL::route('getHubs') }}">Hubs</a>
        </li>
        <li class="{{Route::is('clients') ? 'bold' : ''}}"><a href="{{ URL::route('clients') }}">Clients</a>
        </li>
         <li class="{{Route::is('getMeasuresManagement') ? 'bold' : ''}}"><a href="{{ URL::route('getMeasuresManagement') }}">Measures Management</a>
        </li>
         <li class="{{Route::is('getModbusConsole') ? 'bold' : ''}}"><a href="{{ URL::route('getModbusConsole') }}">Modbus Console</a>
        </li>
         <li class="{{Route::is('getAlarmManagement') ? 'bold' : ''}}"><a href="{{ URL::route('getAlarmManagement') }}">Alarm Management</a>
        </li>
         <li class="{{Route::is('getSignalManagement') ? 'bold' : ''}}"><a href="{{ URL::route('getSignalManagement') }}">Signal Management</a>
        </li>
        </li>
    </ul>
</div>