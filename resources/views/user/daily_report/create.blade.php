@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  {!! Form::open(['route' => 'daily_report.store']) !!}
  <div class="container">
    {!! Form::hidden('user_id', null, ['class' => 'form-control']) !!}
    <div class="form-group form-size-small">
      {!! Form::input('date', 'reporting_time', Carbon::now()->format('Y-m-d'), ['class' => 'form-control']) !!}
      @if ($errors->has('reporting_time'))
        <span class="help-block">
          {{ $errors->first('reporting_time') }}
        </span>
      @endif
    </div>
    <div class="form-group">
      {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      @if ($errors->has('title'))
        <span class="help-block">
          {{ $errors->first('title') }}
        </span>
      @endif
    </div>
    <div class="form-group">
      {!! Form::textarea('contents', null, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
      @if ($errors->has('contents'))
        <span class="help-block">
          {{ $errors->first('contents') }}
        </span>
      @endif
    </div>
    {!! Form::submit('add', ['class' => 'btn btn-success pull-right']) !!}
  </div>
  {!! Form::close() !!}
</div>

@endsection
