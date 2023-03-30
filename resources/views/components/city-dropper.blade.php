@foreach ($cities as $city)
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{ $city->city_id }}" id="city_option_{{ $city->city_id }}">
    <label class="form-check-label text-secondary" for="city_option_{{ $city->city_id }}" id="city_label_{{$city->city_id}}">
      {{ $city->name }}
    </label>
  </div>
@endforeach
