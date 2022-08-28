 <select name="{{$name}}" class="form-select form-control" aria-label="Default select example">
     <option></option>
     <option value="1" {{ Request::get($name)=='1' ? 'selected' : '' }}>Yes</option>
     <option value="0" {{ Request::get($name)=='0' ? 'selected' : '' }}>No</option>
 </select>