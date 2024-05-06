
@push('css')
<style>
section {
  padding: 2px;
}
.eazy-audio-player {
  text-align: center;
  padding: 4px 12px;
  display:block;
  background:#393a3d;
  border-radius: 3px;
}

.eazy-audio-player-icono {
  display: inline-block;
  color: #ffffff;
}
.eazy-audio-player-iconoeliminar {
  display: inline-block;
  color:#e82a2a;
  width:30px;
}
.eazy-time {
  vertical-align: top;
  padding: 2px 4px 0 4px;
  font-size: 12px;
  color: #ffffff;
  display: inline-block;
}

.eazy-audio-player span {
  display: inline-block;
  min-width: 25px;
}

.eazy-seek {
  display: inline-block;
  width: 80px;
  position: relative;
  vertical-align: top;
  margin-top: 4px;
  height: 10px;
}
.eazy-seek_dot {
  position: absolute;
  z-index: 9;
  top: 0px;
  width: 9px;
  height: 9px;
  background-color: #ffffff;
  display: block;
  border-radius: 50%;
}
.eazy-seek_bar {
  position: absolute;
  z-index: 1;
  top: 3px;
  width: 100%;
  height: 2px;
  background-color: #333;
  display: block;
}

</style>
@endpush

<div>
  
    <section>
      <tr>
        <audio style="display:none;" id="player{{$idreproductor}}" src="/audios/{{$idestudio}}/audio{{$idreproductor}}.ogg"
             preload="true" class=""></audio>
        <div class="eazy-audio-wrapper">
            <div class="eazy-audio-player">
                <i class="fa eazy-play fa-play" data-id="{{$idreproductor}}"></i>
                <div class="eazy-time"><span id="curTime{{$idreproductor}}">0:00</span></div>
                <div id="seek{{$idreproductor}}" class="eazy-seek">
                    <div class="eazy-seek_dot" style="left: 0;"></div>
                    <div class="eazy-seek_bar"></div>
                </div>
                <a href="#"  onclick="EliminarGrabacion('{{$idreproductor}}')"><i  class="eazy-audio-player-iconoeliminar fa fa-trash-alt" title="Eliminar"></i></a>

            </div>
          
        </div>
      </tr>
    </section>
</div>