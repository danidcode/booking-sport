@extends('layouts.default')

@section('content')
    <div class="login-container">
        <div class="layout-login">
            <div class="login">
                <div class="login-image">
                    <img src={{ Vite::asset('resources/images/foto_login3.jpg') }}></img>
                </div>

                <div class="login-content">
                    <form method="POST" action="{{ route('auth.signIn') }}" class="login-content-form">
                        @csrf
                        <div class="login-content-form-group name">
                            <input type="email" class="form-field" placeholder="Email" name="email" id="email"
                                required />
                            <label class="form__label">Email</label>
                        </div>
                        <div class="login-content-form-group password">
                            <input type="password" class="form-field" placeholder="Password" name="password" id="password"
                                required />
                            <label class="form__label">Contraseña</label>
                        </div>
                        @if ($errors)
                            <span style="color:rgb(165, 16, 16)">{{ $errors->first() }}</span>
                        @endif
                        <div class="login-content-form-button">
                            <button type="submit" class="login-content-form-button-sign">
                                Entrar
                            </button>
                        </div>
                        <div class="orSignUp"> <a href="/register"> <span>¿No tienes cuenta?</span></Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
