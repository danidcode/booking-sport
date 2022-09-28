@extends('layouts.panel-user')

@section('content')
<div class="sidebar">
  <a class="active" href="#home">Home</a>
  <a href="/admin/actividades">Configurar Actividades</a>
  <a href="/admin/actividades">Configurar Eventos</a>
  <a href="/admin/actividades">Configurar Reservas</a>
  <a href="#contact">Configurar Inscripciones</a>
  <a href="#about">Modificar datos</a>
  <a href="#about">Volver a la página principal</a>
  <a href="#about">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i></a>
</div>

<div class="content">
  <h2>Bienvenido a tu panel de usuario</h2>
  <p>Aqui podrás configurar tus datos y administrar tus reservas e inscripciones</p>
</div>
@endsection