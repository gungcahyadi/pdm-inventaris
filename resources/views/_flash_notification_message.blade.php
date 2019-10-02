@if(Session::has('notification'))
    <div class="row purchace-popup">
	<div class="col-12">
		<div class="alert alert-{{ Session::get('notification.level', 'info') }}" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('notification.message') }}
		</div>
	</div>
</div>
@endif