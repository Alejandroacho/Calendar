@extends('layouts.app')

@section('scripts')
    <link rel="stylesheet" href="{{asset('fullcalendar/core/main.css')}}">
    <link rel="stylesheet" href="{{asset('fullcalendar/daygrid/main.css')}}">
    <link rel="stylesheet" href="{{asset('fullcalendar/list/main.css')}}">
    <link rel="stylesheet" href="{{asset('fullcalendar/timegrid/main.css')}}">

    <script src="{{asset('fullcalendar/core/main.js')}}" defer></script>
    <script src="{{asset('fullcalendar/interaction/main.js')}}" defer></script>
    <script src="{{asset('fullcalendar/daygrid/main.js')}}" defer></script>
    <script src="{{asset('fullcalendar/list/main.js')}}" defer></script>
    <script src="{{asset('fullcalendar/timegrid/main.js')}}" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list' ],
                //defaultView:'timeGridWeek'
                header:{
                    left:'prev,next today, Button',
                    center:'title',
                    right:'dayGridMonth, timeGridWeek, timeGridDay'
                },
                customButtons:{
                    Button:{
                        text:"Actividades",
                        click:function(){
                            $('#exampleModal').modal('toggle');
                        }
                    }
                },
                dateClick:function(info){
                     $('#exampleModal').modal('toggle');
                     calendar.addEvent({title:"Evento x", date:info.dateStr});
                },
                eventClick:function(info){
                    
                },
                events:[
                {
                    title:"Mi evento 1",
                    start:"2020-08-14 13:30:00"
                },{
                    title:"Mi evento 2",
                    start:"2020-08-17 13:30:00",
                    end:"2020-08-19 13:30:00",
                    color:"#FFCCAA",
                    textColor:"#000000"
                }
                ]
            });
            calendar.setOption('locale', 'Es');
            calendar.render();
        });
    </script>

@endsection

@section('content')
    <div class="container">
        <div id="calendar"></div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ID:
                <input type="text" name="id" id="id"> <br>
                Fecha
                <input type="text" name="date" id="date"> <br>
                Titulo
                <input type="text" name="title" id="title"> <br>
                Fecha
                <input type="text" name="start" id="start"> <br>
                Descripcion
                <textarea name="description" id="description"> </textarea> <br>
                Color
                <input type="text" name="color" id="color"><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Agregar</button>
                <button type="button" class="btn btn-warning">Modificar</button>
                <button type="button" class="btn btn-danger">Borrar</button>
                <button type="button" class="btn btn-secondary">Cancelar</button>
            </div>
            </div>
        </div>
    </div>

@endsection