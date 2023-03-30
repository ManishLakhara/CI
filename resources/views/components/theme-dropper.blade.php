@foreach ($themes as $theme)
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{ $theme->mission_theme_id }}" id="mission_theme_option_{{ $theme->mission_theme_id }}">
    <label class="form-check-label text-secondary" for="mission_theme_option_{{ $theme->mission_theme_id }}" id="theme_label_{{$theme->mission_theme_id}}">
      {{ $theme->title }}
    </label>
  </div>
@endforeach
