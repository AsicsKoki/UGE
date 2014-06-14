@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent">
		
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
	$('#analyzersTable').dataTable();
</script>
@stop