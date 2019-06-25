@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.confirm', 'method' => 'post']) !!}
      <div class="form-group">
        <select name='tag_category_id' class = "form-control selectpicker form-size-small" id="pref_id">
          <option value="">Select category</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('tag_category_id'))
          <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
        @endif
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', null, ['require', 'class' => 'form-control', 'placeholder' => 'title']) !!}
        @if ($errors->has('title'))
          <span class="help-block">{{ $errors->first('title') }}</span>
        @endif
      </div>
      <div class="form-group">
        {!! Form::textarea('content', null, ['require', 'class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        @if ($errors->has('content'))
          <span class="help-block">{{ $errors->first('content') }}</span>
        @endif
      </div>
      {!! Form::submit('create', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
