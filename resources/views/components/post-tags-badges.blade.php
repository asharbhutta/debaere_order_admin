@props(['member'])
<?php $classes = array("danger" => "danger", "warning" => "warning", "success" => "success", "primary" => "primary");
?>
<span>
    @foreach($member->tags as $tag)
    <a href="{{ route('admintagview',$tag->tag_id) }}" target="blank" class="btn btn-outline-{{ array_rand($classes) }} rounded-pill m-1">{{ $tag->tag->tag }}</a>
    @endforeach
</span>