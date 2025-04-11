<x-guest-layout title="Signup" bodyClass="page-signup">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('signup')}}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" {{ old('email') }}/>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Your Password" />
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" placeholder="Repeat Password" />
        </div>
        <hr />
        <div class="form-group">
            <input type="text" name="name" placeholder="Your Name" {{ old('name') }}/>
        </div>

        <div class="form-group">
            <input type="text" name="phone" placeholder="Phone" {{ old('phone') }}/>
        </div>
        <button class="btn btn-primary btn-login w-full">Register</button>
    </form>



        <x-slot:footerLink>
            Already have an account? -
            <a href="/login">Click here to login</a>
        </x-slot:footerLink>

</x-guest-layout>
