<?php 
use App\Models\Offering;
$offerings=Offering::getActiveOfferingArray();
?>

<select class="form-control select2"  name="offering_id">
    <option value="" >Select Offering</option>
    @foreach($offerings as $k=>$v)
        <option <?= $k==Request::get('product_number') ? "selected" : "" ?>  value="{{ $k }}">{{ $v }}</option>
    @endforeach
</select>