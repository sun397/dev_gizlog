@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily_report.update', $dailyReport->id]]) !!}
      <input class="form-control" name="_method" type="hidden" value="put">
      <div class="form-group form-size-small">
        {!! Form::input('date', 'reporting_time', $dailyReport->reporting_time->format('Y-m-d'), ['class' => 'form-control']) !!}
        @if ($errors->has('reporting_time'))
          <span class="help-block">
            {{ $errors->first('reporting_time') }}
          </span>
        @endif
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', $dailyReport->title, ['class' => 'form-control']) !!}
        @if ($errors->has('title'))
          <span class="help-block">
            {{ $errors->first('title') }}
          </span>
        @endif
      </div>
      <div class="form-group">
        {!! Form::textarea('contents', $dailyReport->contents, ['class' => 'form-control']) !!}
        @if ($errors->has('contents'))
          <span class="help-block">
            {{ $errors->first('contents') }}
          </span>
        @endif
      </div>
      {!! Form::submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
