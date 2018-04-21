@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.articles.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.articles.fields.title')</th>
                            <td field-key='title'>{{ $article->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.articles.fields.description')</th>
                            <td field-key='description'>{!! $article->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.articles.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
