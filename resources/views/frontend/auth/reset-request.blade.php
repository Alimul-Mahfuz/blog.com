@extends('frontend.layouts.main')
@push('css')
    <style>
        .social-icon {
            width: 25px;
        }

        /* .social-btn .col-md-4 {
                width: 25.333333%;
                } */
    </style>
@endpush
@section('content')
    <div id="login-container" class="container min-vh-100 d-flex justify-content-center align-items-center">
        <form class="rounded rounded-3 p-3 frosted-glass" id="password-reset-request-form" method="post">
            @csrf
            <h1>Reset Passwrod</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">If your email matched, we will send you a password reset link.</div>
            </div>
            <p><button type="submit" class="me-3 btn btn-primary">Send Reset Link</button><span id="notify"></span>
            <p>Don't have an account yet? <a href="{{ route('user.register') }}">Create an account</a></p>
        </form>
        <script>
            const notify = document.getElementById('notify');
            let mailInput = document.querySelector('form input[type=email]');
            mailInput.addEventListener('change', function() {
                notify.innerText = '';
            })
            mailInput.addEventListener('keyup', function() {
                notify.innerText = '';
            })
            document.getElementById('password-reset-request-form').addEventListener('submit', async function(event) {
                event.preventDefault();
                notify.innerText = ''
                const formData = new FormData(this);
                try {
                    const response = await fetch('reset-request', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': formData.get(
                            '_token'), // Alternatively, you can set the CSRF token in the headers
                        },
                    });
                    const data = await response.json();
                    if (!response.ok) {
                        if (response.status === 422) {
                            notify.classList.add('text-danger');
                            let err = Object.values(data)[0];
                            notify.innerText = err
                        } else {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                    }
                    if (data.hasOwnProperty('is_exists')) {
                        if (!Object.values(data)[0]) {
                            notify.classList.add('text-danger');
                            notify.innerText = "Account doesn't exists"
                        } else {
                            notify.classList.remove('text-danger');
                            notify.classList.add('text-success');
                            notify.innerText = "Reset link has been sent to your account!"
                        }
                    }
                } catch (error) {
                    console.error('Error sending form data:', error);
                }
            });
        </script>
    </div>
@endsection
