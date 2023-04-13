
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @php
            $count=0;
        @endphp
        @foreach ($banners as $banner)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{++$count}}" @if ($count==1) class="active" @endif></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @php
            $c=1;
        @endphp
        @foreach ($banners as $banner)
            <div @if($c==1) class="carousel-item active" @else class="carousel-item" @endif>
                <img class="d-block h-100 w-100" src="{{asset('Storage/'.$banner->image)}}" alt="{{++$c}}_slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="text-start">
                        {!!$banner->text!!}
                    </div>

                </div>
            </div>
        @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
