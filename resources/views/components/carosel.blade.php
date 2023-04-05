
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
        @foreach ($banners as $banner)
            <div class="carousel-item active">
                <div class="overlay-image" style='background-image: url({{asset('storage/'.$banner->image)}});'></div>
                <div class="container">
                    {!!$banner->text!!}
                </div>
            </div>
        @endforeach
  </div>
</div>
