<div class="small-ratings">
    @for ($i=1;$i<=5;$i++,$avg_rating--)
        @if($avg_rating<=0)
            <i class="far fa-star rating-color"></i>
        @else
            <i class="fa fa-star rating-color"></i>
        @endif
    @endfor
    <span class="text-muted">(by {{$count_rating}} Volunteers)</span>
</div>
