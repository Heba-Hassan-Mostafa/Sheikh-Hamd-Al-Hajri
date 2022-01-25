
 {{-- FORM ERRORS --}}
	@if (count($errors->all()) > 0)

	<div class="alert alert-danger">

		<button type="button" class="close" data-dismiss="alert">×</button>	
		<ul>
			@foreach($errors->all() as $error)
			
			<li>{{ $error }}</li>
			
			@endforeach

		</ul>

		</div>

		@endif


	{{-- Message Success --}}
	@if ($message = Session::get('success'))

	<div class="alert alert-success alert-block">

		<button type="button" class="close" data-dismiss="alert">×</button>    

		<strong>{{ $message }}</strong>

	</div>

	@endif



		{{-- Message error --}}
	@if ($message = Session::get('error'))

	<div class="alert alert-danger alert-block">
	
		<button type="button" class="close" data-dismiss="alert">×</button>    
	
		<strong>{{ $message }}</strong>
	
	</div>
	
	@endif

			{{-- Message warning --}}
	@if ($message = Session::get('warning'))

	<div class="alert alert-warning alert-block">

    <button type="button" class="close" data-dismiss="alert">×</button>    

    <strong>{{ $message }}</strong>

	</div>

	@endif

		{{-- Message info --}}

@if ($message = Session::get('info'))

<div class="alert alert-info alert-block">

    <button type="button" class="close" data-dismiss="alert">×</button>    

    <strong>{{ $message }}</strong>

</div>

@endif