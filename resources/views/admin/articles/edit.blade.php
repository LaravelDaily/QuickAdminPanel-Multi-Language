@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.articles.title')</h3>
    
    {!! Form::open(['method' => 'PUT', 'route' => ['admin.articles.update', $article->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link bg-aqua-active" href="#" id="english-link">EN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="spanish-link">ES</a>
            </li>
        </ul>

        <div class="panel-body" id="english-form">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('en_title', trans('quickadmin.articles.fields.title').' (EN)', ['class' => 'control-label']) !!}
                    {!! Form::text('en_title', old('en_title', $article->translate('en')->title), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('en_description', trans('quickadmin.articles.fields.description').' (EN)', ['class' => 'control-label']) !!}
                    {!! Form::textarea('en_description', old('en_description', $article->translate('en')->description), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
        </div>

        <div class="panel-body hidden" id="spanish-form">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('es_title', trans('quickadmin.articles.fields.title').' (ES)', ['class' => 'control-label']) !!}
                    {!! Form::text('es_title', old('es_title', $article->translate('es')->title), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('es_description', trans('quickadmin.articles.fields.description').' (ES)', ['class' => 'control-label']) !!}
                    {!! Form::textarea('es_description', old('es_description', $article->translate('es')->description), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>

    <script>
      var $englishForm = $('#english-form');
      var $spanishForm = $('#spanish-form');
      var $englishLink = $('#english-link');
      var $spanishLink = $('#spanish-link');

      $englishLink.click(function() {
        $englishLink.toggleClass('bg-aqua-active');
        $englishForm.toggleClass('hidden');
        $spanishLink.toggleClass('bg-aqua-active');
        $spanishForm.toggleClass('hidden');
      });

      $spanishLink.click(function() {
        $englishLink.toggleClass('bg-aqua-active');
        $englishForm.toggleClass('hidden');
        $spanishLink.toggleClass('bg-aqua-active');
        $spanishForm.toggleClass('hidden');
      });
    </script>
@stop