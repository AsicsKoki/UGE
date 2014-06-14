@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div>
		<div style="left:20%" class="register-form">
			{{ Former::open()->class('form-horizontal')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewAnalyzer'))
				->rules([
						'name'                   => 'required|min:3',
						'modbus_slave_address'   => 'required',
						'current_measure_period' => 'required',
						'short_message_period'   => 'required',
						'alarm_message_period'   => 'required',
						'measures_before_alarm'  => 'required',
						'hubs_id'                => 'required',
						'customers_id'           => 'required',
						'active'                 => 'required',
					])}}
				{{Former::text('name')->label('name')->placeholder('Analyzer name')->class('form-control')}}

				{{Former::text('description')->label('Description')->placeholder('Analyzer description')->class('form-control')}}

				{{Former::text('comment')->label('Comment')->placeholder('Comment')->class('form-control')}}

				{{Former::text('modbus_slave_address')->label('Modbus Slave Address')->placeholder('Modbus Slave Address')->class('form-control')}}

				{{Former::text('current_measure_period')->label('Current Measure Period')->placeholder('Analyzer Current Measure Period')->class('form-control')}}

				{{Former::text('short_message_period')->label('Short Message Period')->placeholder('Short Message Period')->class('form-control')}}

				{{Former::text('analyzer_types_id')->label('Analyzer type')->placeholder('Analyzer type id')->class('form-control')}}

				{{Former::text('alarm_message_period')->label('Alarm Message Period')->placeholder('Alarm Message Period')->class('form-control')}}

				{{Former::text('measures_before_alarm')->label('Short Message Period')->placeholder('Short Message Period')->class('form-control')}}

				{{Former::text('hubs_id')->label('Hub Id')->placeholder('Enter Id')->class('form-control')}}

				{{Former::text('input_position')->label('Input Position')->placeholder('Nullable')->class('form-control')}}

				{{Former::text('customers_id')->label('Customer Id')->placeholder('Enter Customer Id')->class('form-control')}}

				{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Submit')->class('form-control submit-button')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
