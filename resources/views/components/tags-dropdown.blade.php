@php
use App\Models\Tags;
$tags=Tags::all();
@endphp


<select name="tag" class="form-select form-control select2" aria-label="Default select example">
    <option></option>
    @foreach($tags as $tg)
    <option value="{{ $tg->id }}" {{ Request::get('tag')==$tg->id ? 'selected' : '' }}>{{ $tg->tag }}</option>
    @endforeach
</select>