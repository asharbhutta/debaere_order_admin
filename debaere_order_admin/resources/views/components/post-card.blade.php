@props(['member','classes'])

<div class="card m-2 {{ $classes }}">
    <a href="{{ $member->url }}" data-lightbox="photos">
        <img style="width:100%;" class="card-img-top m-2" src="{{ $member->url }}">
    </a>
    <div class="card-body">
        <h5 class="card-title">{{ $member->title }}</h5>

        <p class="card-text"> {{ $member->getDate() }}
            <br>
        <br>
        <x-post-tags-badges :member="$member" />
        <br>
        <x-post-stats-badges :member="$member" />
        <br>
        </p>
        <hr>
        <x-post-edit-btn text="View" :member="$member" />
    </div>
</div>