@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent container col-xs-8">
		<ul class="tab-margin nav nav-tabs" role="tablist">
			<li class="active"><a href="#section1">Customer</a></li>
			<li><a href="#section2">User</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active in fade" id="section1">
				<div class="col-md-6">
					{{ Former::open()->class('form row')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewClient'))
						->rules([
								'name'           => 'required|min:3',
								'address'        => 'required',
								'contact_person' => 'required',
								'active'         => 'required',
							])}}
						{{Former::text('client_name')->label('Name')->placeholder('Customer Name')->class('form-control')}}
						{{Former::text('contact_person')->label('Contact Person')->placeholder('Contact Person')->class('form-control')}}
						{{Former::text('client_address')->label('Address')->placeholder('Adress')->class('form-control')}}
				</div>
				<div class="col-md-6">
						{{Former::text('client_contact_phone')->label('Phone')->placeholder('Phone')->class('form-control')}}
						{{Former::text('client_contact_email')->label('Contact Email')->placeholder('Contact Email')->class('form-control')}}
						{{Former::select('client_active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

						{{Former::hidden()->name('_token')->value(csrf_token())}}
				</div>
			</div>
			<div class="tab-pane fade" id="section2">
				<div class="col-md-6">
					{{Former::text('username')->label('Username')->placeholder('Username')->class('form-control')}}
					{{Former::password('password')->label('Password')->placeholder('Password')->class('form-control')}}
					{{Former::password('password_confirmation')->label('Password')->placeholder('Retype your password')->class('form-control')}}
					{{Former::text('first_name')->label('Name')->placeholder('Name')->class('form-control')}}
				</div>
				<div class="col-md-6">
					{{Former::text('contact_sms')->label('SMS Phone')->placeholder('User SMS')->class('form-control')}}
					{{Former::text('contact_email')->label('Email')->placeholder('Email')->class('form-control')}}
				<div class="control-group required">
					<label for="account_types_id" class="control-label">Account type</label>
					<select name="account_types_id" id="" class="form-control">
						@foreach ($accountTypes as $accountType)
							<option value="{{$accountType['id']}}">{{$accountType['type']}}</option>
						@endforeach
					</select>
				</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="control-group col-md-6">
						<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::route('cancelClientAction')}}">Cancel</a>
				</div>
				<div class="control-group col-md-6">
					{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
				</div>
			</div>
		</div>
			{{ Former::close() }}
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
$('.nav-tabs li a').click(function (e) {
	e.preventDefault()
	$(this).tab('show')
})

var ind = $('div.controls span.help-inline').eq(0).closest('div.tab-pane').index();
console.log(ind);
ind != -1 && $('.nav-tabs li').eq(ind).find('a').tab('show');
</script>
@stop