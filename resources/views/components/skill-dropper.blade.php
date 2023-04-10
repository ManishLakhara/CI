@foreach ($skills as $skill)
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{ $skill->skill_id }}" id="skill_option_{{ $skill->skill_id }}">
    <label class="form-check-label text-secondary" for="skill_option_{{ $skill->skill_id }}" id="skill_label_{{$skill->skill_id}}">{{ $skill->skill_name }}</label>
  </div>
@endforeach
