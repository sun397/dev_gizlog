@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['confirm.update', $question->id], 'method' => 'post']) !!}
      <div class="form-group">
        <select name='tag_category_id' class = "form-control selectpicker form-size-small" id ="pref_id">
          <option value="{{ $question->tag_category_id }}">{{ $question->category->name }}</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('tag_category_id'))
          <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
        @endif
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', $question->title, ['require', 'class' => 'form-control']) !!}
        @if ($errors->has('title'))
          <span class="help-block">{{ $errors->first('title') }}</span>
        @endif
      </div>
      <div class="form-group">
        {!! Form::textarea('content', $question->content, ['require', 'class' => 'form-control']) !!}
        @if ($errors->has('content'))
          <span class="help-block">{{ $errors->first('content') }}</span>
        @endif
      </div>
      {!! Form::submit('update', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
