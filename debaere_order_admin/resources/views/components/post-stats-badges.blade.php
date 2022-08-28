@props(['member'])

<span>
    <button class="btn-sm btn-outline-success"><i class="fa fa-eye m-1" aria-hidden="true"></i>{{$member->views}}</button>
    <button class="btn-sm btn-outline-warning"><i class="fa fa-share-alt m-1" aria-hidden="true"></i>{{$member->shares}}</button>
    <button class="btn-sm btn-outline-primary"><i class="fa fa-download m-1" aria-hidden="true"></i>{{$member->downloads}}</button>
</span>