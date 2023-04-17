@foreach ($countries as $country)
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{ $country->country_id }}" id="country_option_{{ $country->country_id }}">
    <label class="form-check-label text-secondary" for="country_option_{{ $country->country_id }}" id="country_label_{{$country->country_id}}">
      {{ $country->name }}
    </label>
  </div>
@endforeach
