@props(['boolean'])
@if($boolean)
<button class="btn btn-outline-success btn-square m-1"><i class="fa fa-check" aria-hidden="true"></i></button>
@else
<button class="btn btn-outline-danger btn-square m-1"><i class="fa fa-times" aria-hidden="true"></i></button>
@endif