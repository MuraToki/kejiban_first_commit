@extends('layouts.app')
@section('content')
    <div class="col-md-6 col-md-offset-2 m-auto">
        <h2 style="text-align: center;">編集フォーム</h2>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()">
          @csrf
          @if ($errors->has('content'))
              <div class="alert alert-danger" role="alert" style="font-weight: bold; font-size: 16px;">
            {{ $errors->first('content') }}
        </div>
        @endif
          <input type="hidden" name="id" value="{{ $post->id }}">
            <div class="form-group">
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" value="{{ $post->content }}" rows="3">{{ $post->content }}</textarea>
            </div>
            <div class="mt-3">
                <a class="btn btn-secondary" href="{{ route('home') }}">
                    戻る
                </a>
                <button type="submit" class="btn btn-primary">
                    更新
                </button>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
        </form>
    </div>
<script>
function checkSubmit(){
if(confirm('更新してもいいかな？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection