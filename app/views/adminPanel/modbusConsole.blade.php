@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent container col-xs-8">
            <div class="row col-md-6">
 			{{ Former::open()->class('form tab-margin')->method('POST')->enctype('multipart/form-data')->action(URL::route('sendModbusQuery'))
				->rules([
					])}}
	                <select name="analyzers_id" id="input" class="form-control" required="required">
	                	@foreach($analyzerData as $analyzer)
	                    	<option class="option" value="{{$analyzer['id']}}" data-address="{{$analyzer['modbus_slave_address']}}">{{$analyzer['name']}}</option>
	                    @endforeach
	                </select>
				{{Former::hidden('users_id')->value(Auth::user()->id)}}

				{{Former::text('function')->label('Modbus function')->class('form-control')->id('modbusFunction')}}

				{{Former::text('time')->label('')->class('hide form-control')}}

				{{Former::text('comment')->label('Komentar')->class('form-control')}}

				{{Former::text('data_bytes')->label('Modbus command')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
			{{ Former::close() }}
            </div>
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
	$('#analyzersTable').dataTable();
	$(".option").click(function(){
		var address = $(this).data('address');
		var input = $('#modbusAddress');
		input.val(address);
	})
</script>
@stop