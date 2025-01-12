 <select name="{{$name}}" class="form-select form-control" aria-label="Default select example">
     <option></option>
     <option value="1" {{ Request::get($name)=='1' ? 'selected' : '' }}>London Office</option>
     <option value="2" {{ Request::get($name)=='0' ? 'selected' : '' }}>Surrey Office</option>
 </select>