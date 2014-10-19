@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent container col-xs-8">
		<div class="col-md-6">
			<h4>New Measure Type in Analyzer Type</h4>
			{{ Former::open()->class('form')->method('POST')->enctype('multipart/form-data')->action(URL::route('postRegisterMeasureTypeInAnalyzer'))
				->rules([
						'name_en' => 'required|min:3',
						'name_sr' => 'required',
						'unit'    => 'required',
						'active'  => 'required',
						'threshold'  => 'required',
						'offset'  => 'required',
						'coefficient_of_proportionality'  => 'required',
						'modbus_measure_function'  => 'required',
						'modbus_measure_register'  => 'required',
						'analyzer_types_id'  => 'required'
					])}}
				{{Former::select('Measure Type')->options($measures)->label('Active')->class('form-control')->name('measure_type')}}

				{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

				{{Former::text('modbus_measure_function')->label('Modbus measure function')->class('form-control')}}

				{{Former::text('modbus_measure_register')->label('Modbus measure register')->class('form-control')}}

				{{Former::text('coefficient_of_proportionality')->label('Coefficient of proportionality')->class('form-control')}}

				{{Former::text('offset')->label('Offset')->class('form-control')}}

				{{Former::text('threshold')->label('Threshold')->class('form-control')}}

				{{Former::select('active_measureType')->options([1=>'Active', 0=>'Inactive'])->label('Active(for measure type in analyzer type)')->class('form-control')}}

				<div class="control-group required">
					<label for="analyzer_types_id" class="control-label">Analyzer type</label>
					<select name="analyzer_types_id" id="" class="form-control">
					@foreach ($analyzerTypes as $analyzerType)
						<option value="{{$analyzerType['id']}}">{{$analyzerType['name']}}</option>
					@endforeach
					</select>
				</div>

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				<div class="control-group">
					<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::to('measuresManagement')}}">Cancel</a>
				</div>
				{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn-info')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
