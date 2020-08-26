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
                    $('#date').val(info.dateStr);
                    $('#exampleModal').modal('toggle');
                    calendar.addEvent({title:"Evento x", date:info.dateStr});
                },
                events:"{{ url ('event/show') }}"
            });
            calendar.setOption('locale', 'Es');
            calendar.render();

            $('#btnAdd').click(function(){
                eventObj=recolectData("POST");
                sendData('', eventObj);
            });

            function recolectData(method){
                newEvent={

                    title:$('#title').val(),
                    description:$('#description').val(),
                    color:$('#color').val(),
                    textColor:'#FFFFFF',
                    start:$('#date').val()+" "+$('#start').val(),
                    end:$('#date').val()+" "+$('#start').val(),

                    '_token':$("meta[name='csrf-token']").attr("content"),
                    '_method':method
                }
                return(newEvent);
            }

            function sendData(action, eventObj){
                $.ajax({
                    type:"POST",
                    url:"{{url('/event')}}"+action,
                    data:eventObj,
                    success: function(msg){
                        console.log(msg);
                    },
                    error: function(){
                        alert("Hubo un error");
                    }
                });
            }
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
                Titulo
                <input type="text" name="title" id="title"> <br>
                Fecha
                <input type="text" name="date" id="date"> <br>
                Hora
                <input type="text" name="start" id="start"> <br>
                Descripcion
                <textarea name="description" id="description"> </textarea> <br>
                Color
                <input type="color" name="color" id="color"><br>
            </div>
            <div class="modal-footer">
                <button id="btnAdd" type="button" class="btn btn-success">Agregar</button>
                <button id="btnEdit" type="button" class="btn btn-warning">Editar</button>
                <button id="btnDelete" type="button" class="btn btn-danger">Borrar</button>
                <button id="btnCancel" type="button" class="btn btn-secondary">Cancelar</button>
            </div>
            </div>
        </div>
    </div>

@endsection