<style>
    .select2-selected-image, .select2-option-image {
        height: 28px;
        margin-right: 3px;
        vertical-align: middle;
        border-radius: 50%;
    }
    .select2-selected-image.big {
        float: left;
        height: 100px;
        border-radius: 0;
    }
    .select2-option-image {
        height: 16px;
    }
    .select2-selected-description {
        position: absolute;
        left: 50%;
        bottom: 150%;
        min-width: 400px;
        padding: 6px;
        background: #f3f3f3;
        display: none;
        border-radius: 2px;
        border: 1px solid #e2e2e2;
        box-shadow: 2px 3px 1px rgba(0, 0, 0, 0.2);
    }
    .select2-selected-item:hover ~ .select2-selected-description {
        display: block;
    }
    .meta-wrapper {
        float: right;
        width: calc(100% - 110px);
    }
    .des-item {
        margin-bottom: 5px;
    }
</style>
<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}} advanced-multiple-select clearfix">
        @include('admin::form.error')
        <select class="form-control {{$class}} select2-element" style="width: 100%; display: none" name="{{$name}}[]" multiple="multiple" data-placeholder="{{ $placeholder }}" {!! $attributes !!} >
            @foreach($options as $select => $option)
                <option value="{{$select}}" {{  in_array($select, (array)old($column, $value)) ?'selected':'' }} data-img="{{
                $attr[$select]['image']}}" data-des-en="{{$attr[$select]['descriptions']['en']}}" data-des-vi="{{$attr[$select]['descriptions']['vi']}}" data-title-en="{{$attr[$select]['titles']['en']}}" data-title-vi="{{$attr[$select]['titles']['vi']}}">{{$option}}</option>
            @endforeach
        </select>
        <input type="hidden" name="{{$name}}[]" />
        @include('admin::form.help-block')

    </div>
</div>
<script src="{{asset('js/select2Config.js')}}"></script>