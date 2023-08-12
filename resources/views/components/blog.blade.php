@props(['post'])
<div class="card h-100 rounded rounded-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{asset('storage/'.$post->cover_image)}}" class="rounded rounded-top-3 rounded-start-3 rounded-top-0 rounded-end-0 " style="height: 180px;width:100%;" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body frosted">
                <h5 class="card-title">{{Str::limit($post->title,20)}}</h5>
                <p class="card-text">{!!Str::limit($post->description,'50')!!}</p>
                <p class="card-text"><small class="text-body-secondary">Posted By:&nbsp;{{$post->user->name}}</small></p>
                <a href="{{route('user.read',['id'=>$post->id])}}" class=""></a>
            </div>
        </div>
    </div>
</div>
