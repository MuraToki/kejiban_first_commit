@extends('layouts.app')

@section('content')
<div class="col-md-6 col-md-offset-2 m-auto"> 
    <form method="post" action="{{ route('store') }}" onSubmit="return checkSubmit()">
        @csrf
        @if ($errors->has('content'))
        <div class="alert alert-danger" role="alert" style="font-weight: bold; font-size: 16px;">
            {{ $errors->first('content') }}
        </div>
        @endif
        <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3" value="{{ old('content') }}" ></textarea>
        <button type="submit" class="btn btn-info mt-2 mb-2">追加</button>
    </form>
</div>

<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-8 offset-1 offset-md-2">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th colspan="3">内容</th>
                    </tr>
                    
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->content }}</td>
                        
                        <td>
                            <button onclick="location.href='/detail/{{ $post->id }}'" class="btn btn-success">詳細</button>
                        </td>
                        <td>
                            <form action="{{ route('delete', $post->id) }}" method="POST" onSubmit="return checkDelete()">
                                @csrf
                                <input type="submit" value="削除" class="btn btn-danger post_del_btn">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>
<script>
function checkSubmit(){
if(confirm('目標を追加してもいいかな？')){
    return true;
} else {
    return false;
}
}
function checkDelete(){
if(confirm('削除をするということは、達成しましたか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
