@extends('layouts.default')

@section('content')
<div class="login-container">
  <div class="layout-login">
    <div class="login">
      <div class="login-image">
        <img src={{ Vite::asset('resources/images/foto_registro.jpg') }}></img>
      </div>

      <div class="login-content">
        <form method="POST" action="{{ route('register') }}" class="login-content-form">
          @csrf
          <div class="login-content-form-group name">
            <input type="text" class="form-field" placeholder="Nombre" name="name" id="name" required />
            <label class="form__label">Nombre</label>
          </div>
          <div class="login-content-form-group email">
            <input type="email" class="form-field" placeholder="Email" name="email" id="email" required />
            <label class="form__label">Email</label>
          </div>
          <div class="login-content-form-group password">
            <input type="password" class="form-field" placeholder="Password" name="password" id="password" required />
            <label class="form__label">Contraseña</label>
          </div>
          <div class="forgotPassword">
            <Link to="/recovery-password"> <span>¿Contraseña olvidada?</span></Link>
          </div>
          <div class="login-content-form-button">
            <button type="submit" class="login-content-form-button-sign">
              Crear cuenta
            </button>
          </div>
          <div class="orSignUp"> <a href="/login"> <span>¿Ya tienes cuenta?</span></Link>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</form>
@endsection