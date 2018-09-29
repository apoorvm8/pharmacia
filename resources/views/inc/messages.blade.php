@if(session('success'))
<div id='custom-message-success' class="alert alert-success text-center" style="margin: 2% 4% !important; padding: 0.2% !important;">
    {{session('success')}}
</div>
@endif

@if(session('error'))
<div id='custom-message-error' class="alert alert-danger text-center" style="margin: 2% 4% !important; padding: 0.2% !important;">
    {{session('error')}}
</div>
@endif