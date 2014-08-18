@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent">
		<div>
            <div class="row col-xs-4">
 			{{ Former::open()->class('form-vertical')->method('POST')->enctype('multipart/form-data')->action(URL::route('sendModbusQuery'))
				->rules([
					])}}
	                <select name="analyzers_id" id="input" class="form-control" required="required">
	                	@foreach($analyzerData as $analyzer)
	                    	<option class="option" value="{{$analyzer['id']}}" data-address="{{$analyzer['modbus_slave_address']}}">{{$analyzer['name']}}</option>
	                    @endforeach
	                </select>

				{{Former::text('address')->label('Modbus adresa')->class('form-control')->id('modbusAddress')}}

				{{Former::hidden('users_id')->value(Auth::user()->id)}}

				{{Former::text('function')->label('Modbus funkcija')->class('form-control')->id('modbusFunction')}}

				{{Former::text('data_bytes')->label('Modbus Poruka')->class('form-control')}}

				{{Former::text('comment')->label('Komentar')->class('form-control')}}


				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Submit')->class('form-control submit-button')}}
			{{ Former::close() }}
            </div>
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