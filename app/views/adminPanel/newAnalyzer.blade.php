@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent container col-xs-8">
		<div class="new-analyzer register-form">
			<ul class="nav nav-tabs" role="tablist">
			  <li class="active"><a href="#section1">Basic</a></li>
			  <li><a href="#section2">Measure Types in Analyzer</a></li>
			</ul>
			{{ Former::open()->class('analyzer row')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewAnalyzer'))
				->rules([
						'name'                   => 'required|min:3',
						'modbus_slave_address'   => 'required',
						'current_measure_period' => 'required',
						'short_message_period'   => 'required',
						'long_message_period'   => 'required',
						'alarm_measure_period'   => 'required',
						'measures_before_alarm'  => 'required',
						'hubs_id'                => 'required',
						'input_position'         => 'required',
						'customers_id'           => 'required',
						'active'                 => 'required',
					])}}
				<div class="tab-content">
						<div class="tab-pane active in fade" id="section1">
							<div class="col-md-6">
								{{Former::text('name')->label('name')->placeholder('Analyzer name')->class('form-control')}}

								{{Former::text('description')->label('Description')->placeholder('Analyzer description')->class('form-control')}}

								{{Former::text('comment')->label('Comment')->placeholder('Comment')->class('form-control')}}

								{{Former::text('modbus_slave_address')->label('Modbus Slave Address')->placeholder('Modbus Slave Address')->class('form-control')}}

								{{Former::text('current_measure_period')->label('Current Measure Period')->placeholder('Current Measure Period')->class('form-control')}}

								{{Former::text('short_message_period')->label('Short Message Period')->placeholder('Short Message Period')->class('form-control')}}

								{{Former::text('long_message_period')->label('Long Message Period')->placeholder('Long Message Period')->class('form-control')}}
							</div>

							<div class="col-md-6" >
								{{Former::text('alarm_measure_period')->label('Alarm Measure Period')->placeholder('Alarm Measure Period')->class('form-control')}}

								{{Former::text('measures_before_alarm')->label('Measures Before Alarm')->placeholder('Measures Before Alarm')->class('form-control')}}

								<div class="control-group required">
									<label for="hubs_id" class="control-label">Hub<sup>*</sup>
										</label>
									<select name="hubs_id" id="" class="form-control">
									@foreach ($hubs as $key => $hub)
										<option value="{{$hub}}">{{$key}}</option>
									@endforeach
									</select>
								</div>

								{{Former::text('input_position')->label('Input Position')->placeholder('Nullable')->class('form-control')->value('null')}}

								<div class="control-group required">
									<label for="hubs_id" class="control-label">Customer<sup>*</sup>
										</label>
									<select name="customers_id" id="" class="form-control">
									@foreach ($customers as $key => $customer)
										<option value="{{$customer}}">{{$key}}</option>
									@endforeach
									</select>
								</div>

								<div class="control-group required">
									<label for="hubs_id" class="control-label">Analyzer type<sup>*</sup>
										</label>
									<select name="analyzer_types_id" id="" class="form-control">
									@foreach ($analyzers as $key => $analyzer)
										<option value="{{$analyzer}}">{{$key}}</option>
									@endforeach
									</select>
								</div>

								{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}


								{{Former::hidden()->name('_token')->value(csrf_token())}}
							</div>
						</div>
						<div class="tab-pane fade" id="section2">
							<div class="measures">

							</div>
						</div>
						<div>
							<div class="control-group col-md-6">
								<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::route('cancelAnalyzerAction')}}">Cancel</a>
							</div>
							<div class="control-group col-md-6">
								{{Former::button('Create Analyzer')->class('col-md-6 form-control submit-button submit-button-margin-bottom btn btn-info')}}
							</div>
						</div>
				</div>

			{{ Former::close() }}
		</div>
	</div>
@stop
@section('moreScripts')
{{ HTML::script('js/measures.js') }}
@stop
