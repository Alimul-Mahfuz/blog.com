<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!--Font awoesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    @stack('css')
</head>

<body>
    {{-- Nabar --}}
    @include('frontend.layouts.navbar')
    <main>
        <div class="container">
          @yield('content')
        </div>
    </main>
    @include('frontend.layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script>
        let inputData = document.querySelector('#search-form input[type=text]');
        inputData.addEventListener('keyup', async function(e) {
            const previewer = document.getElementById('search-result-global');
            if (e.target.value === '') {
                previewer.innerHTML = ''
                previewer.classList.add('d-none')
            }
            try {
                const url = `post-search/${encodeURIComponent(e.target.value)}`
                const response = await fetch(url)
                const data = await response.json();
                previewer.innerHTML = '';
                data.forEach(element => {
                    const result = document.createElement('p');
                    result.innerHTML = `<a href="post/${element.id}">* ${element.title}</a>`
                    previewer.appendChild(result);
                });
                previewer.classList.remove('d-none')
            } catch (error) {

            }
        })
    </script>
</body>

</html>
