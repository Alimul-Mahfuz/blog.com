@props(['post'])
<div class="card h-100">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{asset('storage/'.$post->cover_image)}}" class="" style="height: 180px;width:100%;" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{Str::limit($post->title,20)}}</h5>
                <p class="card-text">{!!Str::limit($post->description,'50')!!}</p>
                <p class="card-text"><small class="text-body-secondary">Posted By:&nbsp;{{$post->user->name}}</small></p>
                <a href="{{route('user.read',['id'=>$post->id])}}" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>
