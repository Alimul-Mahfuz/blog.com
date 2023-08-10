@props(['posts'])
<div class="card">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        <div class="row row-cols-1 g-3 row-col-md-2 row-cols-lg-2">
            @foreach ($posts as $post)
            <div class="col"><x-blog :post="$post" /></div> 
            @endforeach
        </div>
    </div>
</div>
