<x-guest-layout title="Login" bodyClass="page-login">

    <h1 class="auth-page-title">Login</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" {{ old('email') }} />
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Your Password" />
        </div>
{{--        <div class="text-right mb-medium">--}}
{{--            <a href="/password-reset.html" class="auth-page-password-reset">Reset Password</a>--}}
{{--        </div>--}}

        <button class="btn btn-primary btn-login w-full">Login</button>

    </form>
    <x-slot:footerLink>
        Don't have an account? -
        <a href="{{route('signup')}}">Click here to create one</a>
    </x-slot:footerLink>
</x-guest-layout>
