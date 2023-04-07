<div class="row">
    @foreach ($published_stories as $story)
        <div class="card col-lg-6 col-xl-4 col-md-6 border-0  pb-4 text-center mb-5"
            style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            {{-- <div class="py-1"> --}}

            <img class="img-fluid w-100 h-100 card-img-top"
            src="{{ asset("storage/".$story->storyMedia->whereIn('type',['jpeg','jpg','png'])->first()->path) }}" alt="">

            {{-- <img class="d-block w-100 h-100"
                    src="images/Grow-Trees-On-the-path-to-environment-sustainability-3.png" class="img-fluid"
                    alt="First slide"> --}}
            <div class="image__overlay">
                <a class="btn px-3 mr-2 rounded-pill btn-outline-secondary" href="{{route('story-details-page',$story->story_id)}}">View
                    Details&nbsp;<i class="fa fa-arrow-right"></i></a>
            </div>
            {{-- </div> --}}

            <div class="text-center" style="margin-top:-25px;">
                <span class="fs-15 px-2 from_untill">
                    {{ $story->mission->missiontheme->title }}</span>
            </div>
            <div class="card-body">
                <h4 class='mission-title theme-color'>{{ $story->title }}</h4>
                <p class='card-text mission-short-description'>
                    {{ strip_tags($story->description) }}
                </p>
            </div>
            <div class="d-flex justify-content-start">
                <img class="rounded-circle px-3 " id="header-avatar" src="{{ asset($story->user->avatar) }}"
                    alt="Profile" style="height:54px">
                <span class="mt-3" id="userAvatar">{{ $story->user->first_name }}
                    {{ $story->user->last_name }}</span>
            </div>

        </div>
    @endforeach
    <div class="d-flex p-3 justify-content-end">
        {!! $published_stories->links('pagination::bootstrap-4') !!}
    </div>
</div>
