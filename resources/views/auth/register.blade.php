<x-guest-layout>
    <header>
        <h5 style="color: #34ad54;margin-top: 15px;">Member Register</h5>
    </header>
    <!-- Validation Errors -->
    <x-jet-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="field">
            <span class="fa fa-user"></span>
            <input id="name" type="text" name="name" placeholder="Your Full Name" :value="old('name')" required autofocus>
        </div>

        <div class="field space">
            <span class="fas fa-envelope"></span>
            <input type="email" name="email" id="email" placeholder="Email Address" :value="old('email')" required autofocus>
        </div>
        <div class="field space">
            <span class="fa fa-lock"></span>
            <input type="password" name="password" id="password" class="pass-key" placeholder="Password" required autocomplete="new-password">
            <span class="show">SHOW</span>
        </div>
        <div class="field space">
            <span class="fa fa-lock"></span>
            <input type="password" name="password_confirmation" id="password_confirmation" class="pass-key" placeholder="Confirm Password" required autocomplete="new-password">
            <span class="show">SHOW</span>
        </div>
        <div class="field space">
            <input type="submit" value="Register">
        </div>
    </form>
    <div class="signup">Already have account?
        <a href="{{ route('login') }}">Singin Now</a>
    </div>
</x-guest-layout>
