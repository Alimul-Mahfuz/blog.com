@props(['posts'])
<div class="card border border-0">
    <div class="card-body px-0">
        <h4 class="my-3">Features</h4>
        <div class="row row-cols-1 g-3 row-col-md-2 row-cols-lg-2">
            @foreach ($posts as $post)
            <div class="col"><x-blog :post="$post" /></div> 
            @endforeach
        </div>
        <div class="my-3 float-end">{{$posts->links()}}</div>
    </div>
</div>
