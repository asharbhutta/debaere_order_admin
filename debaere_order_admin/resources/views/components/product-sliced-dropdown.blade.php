 <select name="{{$name}}" class="form-select form-control product-form" aria-label="Default select example">
     <option></option>
     <option value="yes" {{ Request::get($name)=='yes' ? 'selected' : '' }}>Sliced</option>
     <option value="no" {{ Request::get($name)=='sliced' ? 'selected' : '' }}>Unsliced</option>
 </select>