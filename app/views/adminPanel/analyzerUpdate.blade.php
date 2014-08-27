@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent container col-xs-8">
		<div class='new-analyzer register-form'>
			<ul class="nav nav-tabs" role="tablist">
			  <li class="active"><a href="#section1">Basic</a></li>
			  <li><a href="#section2">Measure Types in Analyzer</a></li>
			  <li class=""><a href="#section3">Alarms</a></li>
			</ul>

			{{ Former::open()->class('form')->method('PUT')->enctype('multipart/form-data')->action(URL::route('putAnalyzer', ['analyzerId'=>$analyzer->id]))
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
								{{Former::populate($analyzer)}}
								{{Former::text('name')->label('name')->placeholder('Analyzer name')->class('form-control')}}

								{{Former::text('description')->label('Description')->placeholder('Analyzer description')->class('form-control')}}

								{{Former::text('comment')->label('Comment')->placeholder('Comment')->class('form-control')}}

								{{Former::text('modbus_slave_address')->label('Modbus Slave Address')->placeholder('Modbus Slave Address')->class('form-control')}}

								{{Former::text('current_measure_period')->label('Current Measure Period')->placeholder('Current Measure Period')->class('form-control')}}

								{{Former::text('short_message_period')->label('Short Message Period')->placeholder('Short Message Period')->class('form-control')}}

								{{Former::text('long_message_period')->label('Long Message Period')->placeholder('Long Message Period')->class('form-control')}}
							</div>
							<div class="col-md-6">

								{{Former::text('alarm_measure_period')->label('Alarm Measure Period')->placeholder('Alarm Measure Period')->class('form-control')}}

								{{Former::text('measures_before_alarm')->label('Measures Before Alarm')->placeholder('Measures before alarm')->class('form-control')}}
								<div class="control-group required">
									<label for="hubs_id" class="control-label">Hub<sup>*</sup>
										</label>
									<select name="hubs_id" id="" class="form-control">
									@foreach ($hubs as $key => $hub)
										@if ($hub == $analyzer->hubs_id)
											<option selected value="{{$hub}}">{{$key}}</option>
										@else
											<option value="{{$hub}}">{{$key}}</option>
										@endif
									@endforeach
									</select>
								</div>

								{{Former::text('input_position')->label('Input Position')->placeholder('Nullable')->class('form-control')->value('null')}}

								<div class="control-group required">
									<label for="hubs_id" class="control-label">Customer<sup>*</sup>
										</label>
									<select name="customers_id" id="" class="form-control">
									@foreach ($customers as $key => $customer)
										@if ($customer == $analyzer->customers_id)
											<option selected value="{{$customer}}">{{$key}}</option>
										@else
											<option value="{{$customer}}">{{$key}}</option>
										@endif
									@endforeach
									</select>
								</div>

								<div class="control-group required">
									<label for="hubs_id" class="control-label">Analyzer type<sup>*</sup>
										</label>
									<select {{$analyzerTypeDisabled ? 'disabled' : ''}} name="analyzer_types_id" id="" class="form-control">
									@foreach ($analyzers as $key => $analyzerItem)
										@if ($analyzerItem == $analyzer->analyzer_types_id)
											<option selected value="{{$analyzerItem}}">{{$key}}</option>
										@else
											<option value="{{$analyzerItem}}">{{$key}}</option>
										@endif
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
						<div class="tab-pane fade" id="section3">
							<div class="alarms">

							</div>
						</div>
						<div>
							<div class="control-group col-md-6">
								<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::route('cancelAnalyzerAction')}}">Cancel</a>
							</div>
							<div class="control-group col-md-6">
								{{Former::button('Update Analyzer')->class('col-md-6 form-control submit-button submit-button-margin-bottom btn btn-info')}}
							</div>
						</div>

					</div>
			{{ Former::close() }}
		</div>
	</div>
@stop
@section('moreScripts')
<script>
	var link = '/analyzerMeasureTypesEdit/';
	var analyzerId = {{$analyzer->id}};
	var analyzerTypesId = {{$analyzer->analyzer_types_id}};
	$('div.panelContent').on("click",'#measureTable button.status' ,function(e){
		e.preventDefault();
		if($(this).hasClass('btn-danger')){
			var state = 0;
		} else {
			var state = 1;
		}
		var id = $(this).data('id');
		var self = this;
		$.ajax({
			url: "changeMeasureState",
			type: "post",
			data: {
				state: state,
				id: id
			},
			success: function(data){
				if(data == 1){
					if($(self).hasClass('btn-danger')){
						$(self).removeClass('btn-danger');
						$(self).addClass('btn-success').text('Activate');
					} else {
						$(self).removeClass('btn-success');
						$(self).addClass('btn-danger').text('Deactivate');
					}
				}
			}
		});
	});

	var hash = document.location.hash;
	var prefix = "tab_";
	if (hash) {
	    $('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
	} 

	// Change hash for page-reload
	$('.nav-tabs a').on('shown', function (e) {
	    window.location.hash = e.target.hash.replace("#", "#" + prefix);
	});

</script>
{{ HTML::script('js/measures.js') }}
@stop