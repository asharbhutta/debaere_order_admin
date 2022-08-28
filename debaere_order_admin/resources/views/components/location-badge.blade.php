@props(['location'])
@if($location==1)
<button class="btn btn-outline-success">London Office</button>
@else
<button class="btn btn-outline-primary">Surrey Office</button>
@endif