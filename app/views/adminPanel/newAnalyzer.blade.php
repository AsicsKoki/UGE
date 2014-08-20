@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent container col-xs-8">
		<div class="new-analyzer register-form">
			{{ Former::open()->class('analyzer row')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewAnalyzer'))
				->rules([
						'name'                   => 'required|min:3',
						'modbus_slave_address'   => 'required',
						'current_measure_period' => 'required',
						'short_message_period'   => 'required',
						'alarm_measure_period'   => 'required',
						'measures_before_alarm'  => 'required',
						'hubs_id'                => 'required',
						'customers_id'           => 'required',
						'active'                 => 'required',
					])}}
				<div class="col-md-6">
					{{Former::text('name')->label('name')->placeholder('Analyzer name')->class('form-control')}}

					{{Former::text('description')->label('Description')->placeholder('Analyzer description')->class('form-control')}}

					{{Former::text('comment')->label('Comment')->placeholder('Comment')->class('form-control')}}

					{{Former::text('modbus_slave_address')->label('Modbus Slave Address')->placeholder('Modbus Slave Address')->class('form-control')}}

					{{Former::text('current_measure_period')->label('Current Measure Period')->placeholder('Analyzer Current Measure Period')->class('form-control')}}

					{{Former::text('short_message_period')->label('Short Message Period')->placeholder('Short Message Period')->class('form-control')}}

					{{Former::text('alarm_measure_period')->label('Alarm Measure Period')->placeholder('Alarm Message Period')->class('form-control')}}
				</div>

				<div class="col-md-6" >

					{{Former::text('measures_before_alarm')->label('Short Message Period')->placeholder('Short Message Period')->class('form-control')}}

					<div class="control-group required">
						<label for="hubs_id" class="control-label">Hub<sup>*</sup>
							</label>
						<select name="hubs_id" id="" class="form-control">
						@foreach ($hubs as $key => $hub)
							<option value="{{$hub}}">{{$key}}</option>
						@endforeach
						</select>
					</div>

					{{Former::text('input_position')->label('Input Position')->placeholder('Nullable')->class('form-control')}}

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
				
				{{Former::button('Submit')->class('form-control submit-button btn btn-info')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
@section('moreScripts')
<script>
	
	var table;
	$('button.submit-button').on('click', function() {
		$('#measureTableHidden').find('input[type=checkbox]').each(function(input) {
		 	if ($(input).is(':checked'))
		 		$(input).siblings('input[type=hidden]').attr('disabled', 'disabled');
		 	else
		 		$(input).siblings('input[type=hidden]').removeAttr('disabled');
		});
		$('#measureTable input').attr('disabled', 'disabled');
	 	$(this).parents('form').submit();
	});

	var getMeasures = function(id) {
		 $.ajax({
				url: 'analyzerMeasureTypes/' + id,
				type: 'get',
				data: {},
				success: function (data) {
					$('#measureTable').parent().remove();
					$('#measureTableHidden').parent().remove();
					
					$('button.submit-button').before(data);
					
					$('#measureTable tbody tr').each(function(index, row) {
						$(row).attr('data-index', index);
					});

					$('#measureTableHidden tbody tr').each(function(index, row) {
						$(row).attr('data-index', index);
					});

					table = $('#measureTable').dataTable({
					  "aoColumns": [
					  null,
					  { "bSortable": false },
					  { "bSortable": false },
					  { "bSortable": false },
					  ]
					});

					$('table#measureTable').on('click', 'td input[type=checkbox]', function() {
						var index = $(this).parents('tr').attr('data-index'),
							name = $(this).attr('name');

						$('table#measureTableHidden tr[data-index="'+index+'"] input[name="'+name+'"]').click();
					});

					$('table#measureTable thead input[type=checkbox]').click(function() {
						var columnIndex = $(this).parent().index()
							checked = $(this).is(':checked');

						table.fnGetNodes().forEach(function(item) {
							var index = $(item).attr('data-index');
							if (checked) {
								$(item).find('td:eq('+columnIndex+') input[type=checkbox]:not(:checked)').click();
								$('table#measureTableHidden tr[data-index="'+index+'"] td:eq('+columnIndex+') input[type=checkbox]:not(:checked)').click();
							}
							else {
								$(item).find('td:eq('+columnIndex+') input[type=checkbox]:checked').click();
								$('table#measureTableHidden tr[data-index="'+index+'"] td:eq('+columnIndex+')  input[type=checkbox]:checked').click();
							}
						})
					})

				}
			});
	}

	getMeasures($('select[name=analyzer_types_id]').val());

	$('select[name=analyzer_types_id]').change(function() {
		var id = $(this).val();
		getMeasures(id);
	})

</script>
@stop
