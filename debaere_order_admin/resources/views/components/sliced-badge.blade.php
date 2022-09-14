@props(['sliced'])
@if($sliced==1 || $sliced=="yes")
<button class="btn btn-outline-success">Sliced</button>
@else
<button class="btn btn-outline-primary">Un Sliced</button>
@endif