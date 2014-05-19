<div class="content">
	{{ Former::open()->class('form-horizontal pull-left')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewUser'))}}
		{{Former::text('username')->label('username')->placeholder('Username')}}
		{{Former::password('password')->label('password')->placeholder('Password')}}
		{{Former::password('password_confirmation')->label('password')->placeholder('Retype your password')}}
		{{Former::text('name')->label('Client name')->placeholder('Client name')}}
		{{Former::text('contact_adress')->label('Address')->placeholder('Adress')}}
		{{Former::text('contact_person')->label('Contact person')->placeholder('Adress')}}
		{{Former::text('contact_phone')->label('Phone')->placeholder('Adress')}}
		{{Former::text('contact_sms')->label('SMS phone')->placeholder('Adress')}}
		{{Former::text('account_type_id')->label('Account type')->placeholder('1: admin 0: user')}}
		{{Former::hidden()->name('_token')->value(csrf_token())}}
		{{Former::submit('Register')}}
	{{ Former::close() }}
</div>