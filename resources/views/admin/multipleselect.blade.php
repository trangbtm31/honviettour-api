<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}} advanced-multiple-select clearfix">
        @include('admin::form.error')
        <select class="form-control {{$class}} select2-element" style="width: 100%; display: none" name="{{$name}}[]" multiple="multiple" data-placeholder="{{ $placeholder }}" {!! $attributes !!} >
            @foreach($options as $select => $option)
                <option value="{{$select}}" {{  in_array($select, (array)old($column, $value)) ?'selected':'' }}
                    data-img="{{$attr[$select]['image']}}"
                    data-des-en="@if(isset($attr[$select]['titles']['en'])) {{$attr[$select]['descriptions']['en']}} @endif"
                    data-des-vi="@if(isset($attr[$select]['descriptions']['vi'])) {{$attr[$select]['descriptions']['vi']}} @endif"
                    data-title-en="@if(isset($attr[$select]['titles']['en'])) {{$attr[$select]['titles']['en']}} @endif"
                    data-title-vi="@if(isset($attr[$select]['titles']['vi'])) {{$attr[$select]['titles']['vi']}} @endif"
                    data-date="{{$attr[$select]['date']}}">
                    {{$option}}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="{{$name}}[]" />
        @include('admin::form.help-block')

    </div>
</div>
<script src="{{asset('js/select2Config.js')}}"></script>