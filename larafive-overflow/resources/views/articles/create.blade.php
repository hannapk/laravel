@extends('layouts.app')

@section('content')
    <h1>새 포럼 글쓰기</h1>

    <form action="{{ route('articles.store') }}" method="POST">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <label for="title">제목</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                   class="form-contorl"/>
            {!! $errors->first('title', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            <label for="content">본문</label>
            <textarea name="content" id="content" value="{{ old('content') }}"
                      class="form-contorl"></textarea>
            {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                저장하기
            </button>
        </div>

    </form>
@stop
