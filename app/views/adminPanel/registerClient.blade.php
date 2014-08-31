@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent container col-xs-8">
		<ul class="tab-margin nav nav-tabs" role="tablist">
			<li class="active"><a href="#section1">Client</a></li>
			<li><a href="#section2">User</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active in fade" id="section1">
				<div class="col-md-6">
					{{ Former::open()->class('form')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewClient'))
						->rules([
								'name'           => 'required|min:3',
								'address'        => 'required',
								'contact_person' => 'required',
								'active'         => 'required',
							])}}
						{{Former::text('name')->label('name')->placeholder('Client name')->class('form-control')}}
						{{Former::text('contact_person')->label('Contact person')->placeholder('Contact person')->class('form-control')}}
						{{Former::text('address')->label('Address')->placeholder('Client Adress')->class('form-control')}}
				</div>
				<div class="col-md-6">
						{{Former::text('contact_phone')->label('Phone')->placeholder('Client Phone')->class('form-control')}}
						{{Former::text('contact_email')->label('Contact Email')->placeholder('Contact Email')->class('form-control')}}

						{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

						{{Former::hidden()->name('_token')->value(csrf_token())}}
				</div>
			</div>
		</div>
		<div class="tab-content">
			<div class="tab-pane fade" id="section2">
				<div class="col-md-6">
					{{Former::text('username')->label('username')->placeholder('Username')->class('form-control')}}
					{{Former::password('password')->label('password')->placeholder('Password')->class('form-control')}}
					{{Former::password('password_confirmation')->label('password')->placeholder('Retype your password')->class('form-control')}}
					{{Former::text('name')->label('Client name')->placeholder('Client name')->class('form-control')}}
				</div>
				<div class="col-md-6">
					{{Former::text('contact_address')->label('Address')->placeholder('Client Adress')->class('form-control')}}
					{{Former::text('contact_phone')->label('Phone')->placeholder('Client Phone')->class('form-control')}}
					{{Former::text('contact_sms')->label('SMS phone')->placeholder('Client SMS')->class('form-control')}}
					{{Former::select('account_type_id')->options([1=>'Admin', 2=>'User'])->label('Account Type')->class('form-control')}}
					
				</div>
			</div>
		</div>
		<div>
			<div class="col-md-6">
				<div class="control-group">
					<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::route('cancelClientAction')}}">Cancel</a>
				</div>
			</div>
			<div class="col-md-6">
				{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
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
</script>
@stop