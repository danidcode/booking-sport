@extends('layouts.panel-admin')

@section('content')
<div class="content">
    <div class="content-wrap">
        <div class="actividades-wrap">
            <button class="nueva-actividad-button"> Nueva actividad <i class="fa-solid fa-plus"></i></button>

            <div class="actividades-table-wrap">
                <table class="actividades-table">
                    <tr>
                        <th>Nombre
                        <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Límite
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Horario
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Destacado
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Destacado principal
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Estatus
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Creada
                                <i class="fa-solid fa-arrow-up-wide-short"></i>
                                <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <td>Alfreds Futterkiste</td>
                        <td>Germany</td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                        <td>Germany</td>
                        <td class="acciones"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                    </tr>
                    <tr>
                        <td>Centro comercial Moctezuma</td>
                        <td>Mexico</td>
                        <td>Francisco Chang</td>
                        <td>Mexico</td>
                        <td>Francisco Chang</td>
                        <td>Mexico</td>
                        <td>Mexico</td>
                        <td class="acciones"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                    </tr>
                    <tr>
                        <td>Ernst Handel</td>
                        <td>Austria</td>
                        <td>Roland Mendel</td>
                        <td>Austria</td>
                        <td>Roland Mendel</td>
                        <td>Austria</td>
                        <td>Austria</td>
                        <td class="acciones"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                    </tr>
                    <tr>
                        <td>Island Trading</td>
                        <td>UK</td>
                        <td>Helen Bennett</td>
                        <td>UK</td>
                        <td>Helen Bennett</td>
                        <td>UK</td>
                        <td>UK</td>
                        <td class="acciones"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                    </tr>
                    <tr>
                        <td>Laughing Bacchus Winecellars</td>
                        <td>Canada</td>
                        <td>Yoshi Tannamuri</td>
                        <td>Canada</td>
                        <td>Yoshi Tannamuri</td>
                        <td>Canada</td>
                        <td>Canada</td>
                        <td class="acciones"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                    </tr>
                    <tr>
                        <td>Magazzini Alimentari Riuniti</td>
                        <td>Italy</td>
                        <td>Giovanni Rovelli</td>
                        <td>Italy</td>
                        <td>Giovanni Rovelli</td>
                        <td>Italy</td>
                        <td>Italy</td>
                        <td class="acciones"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection