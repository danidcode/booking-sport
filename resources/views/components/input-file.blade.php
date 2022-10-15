@php
if (!isset($customId)) {
    $customId = $name;
}
    $urlImage = Vite::asset('resources/images/upload.jpg');
if (isset($defaultImage)) {
    $urlImage = $defaultImage;
}

@endphp
<div class="w-100 text-center input-file">
    <img id="{{$customId}}_display_uploaded" class="img-custom-file img-fluid cursor-pointer" src="{{$urlImage}}"
        style="@if (isset($imageStyle)) {{$imageStyle}} @else max-height: 40rem; max-width: 40rem;@endif">
    <br>
    @isset($display)
    <small class="w-100" id="{{@$size_id}}"><i class="mr-50" data-feather="info"></i>{{$display}}</small>
    @endisset
    @if (isset($required) && $required)<small id="{{$customId}}-lbl-valid" class="w-100 text-danger d-none">La imagen es
        requerida</small> @endif
</div>
<input type="text" @if (isset($required) && $required) class="image-upload-required" @endif
    id="{{$customId}}_image_uploaded" name="{{$name}}" value="{{@$defaultInput}}"
    style="position: absolute;z-index: -1;">
<input type="file" hidden id="{{$customId}}_image_upload" @if(isset($disabledButton) && $disabledButton == true) disabled @endif>
<input type="file" hidden id="{{$customId}}_image_upload">
<input type="text" hidden id="{{$customId}}_image_uploaded_update" class="image-uploaded-update">

@if (!isset($showDeleteButton) || $showDeleteButton==true)
  <button type="button" class="btn py-50 px-25" id="{{$customId}}_delete_btn"
  @if(isset($disabledButton) && $disabledButton == true) disabled @endif
  >
    <img class="cursor-pointer mr-25" src="{{Vite::asset('resources/images/trash.png')}}" alt="" width="20px">
    <span>{{$textDeleteButton ?? 'Borrar imagen'}}</span>
  </button>
@endif