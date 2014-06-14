@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div>
		<div style="left:20%" class="register-form">
			{{ Former::open()->class('form-horizontal')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewHub'))
				->rules([
						'name'                  => 'required|min:3',
						'interface_type'        => 'required',
						'ip_address'            => 'required',
						'active'                => 'required',
						'port'                  => 'required',
						'rc_address'            => 'required',
						'serial_port_speed'     => 'required',
						'serial_port_parity'    => 'required',
						'serial_port_speed'     => 'required',
						'serial_port_stop_bits' => 'required',
					])}}
				{{Former::text('name')->label('name')->placeholder('Hub Name')->class('form-control')}}

				{{Former::text('description')->label('Description')->placeholder('Description')->class('form-control')}}

				{{Former::text('comment')->label('Comment')->placeholder('Comment')->class('form-control')}}
				{{Former::text('postal_address')->label('Address')->placeholder('Address')->class('form-control')}}

				{{Former::text('interface_type')->label('Interface Type')->placeholder('Interface Type')->class('form-control')}}

				{{Former::text('ip_address')->label('IP')->placeholder('Enter IP')->class('form-control')}}

				{{Former::text('port')->label('Port')->placeholder('Enter port')->class('form-control')}}

				{{Former::text('rc_address')->label('RC Address')->placeholder('RC Address')->class('form-control')}}

				{{Former::text('serial_port_speed')->label('Serial Port Speed')->placeholder('Serial Port Speed')->class('form-control')}}

				{{Former::text('serial_port_parity')->label('Serial Port parity')->placeholder('Serial Port parity')->class('form-control')}}

				{{Former::text('serial_port_stop_bits')->label('Serial Port stop_bits')->placeholder('Serial Port stop_bits')->class('form-control')}}

				{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Register')->class('form-control submit-button')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
