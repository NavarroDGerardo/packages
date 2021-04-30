<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>

    <title>Hello, world!</title>
</head>

<body>
    <h1>Dashboard</h1>
    <h2>crear otro paquete</h2>
    <input class="btn btn-outline-primary" type="button" value="Agregar nuevo paquete" style="margin: 20px 10px;" onclick="createPackage()">
    <div class="row">

        <div class="col-sm-3">
            <div class="card card1">
                <div class="card-body">
                    <div id="container1">
                        <h5 class="card-title">Salida de planta</h5>
                        @foreach ($paquetes as $paquete)
                            @if ($paquete->estado == "Salida de planta")
                                <button id="{{$paquete->id}}" class="btn btn-primary">Pedido #{{$paquete->id}}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card1">
                <div class="card-body">
                    <div id="container2">
                        <h5 class="card-title">2. En Local Delivery Center</h5>
                        @foreach ($paquetes as $paquete)
                            @if ($paquete->estado == "En Local Delivery Center")
                                <button id="{{$paquete->id}}" class="btn btn-primary">Pedido #{{$paquete->id}}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card1">
                <div class="card-body">
                    <div id="container3">
                        <h5 class="card-title">3. En proceso de entrega</h5>
                        @foreach ($paquetes as $paquete)
                            @if ($paquete->estado == "En proceso de entrega")
                                <button id="{{$paquete->id}}" class="btn btn-primary">Pedido #{{$paquete->id}}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card1">
                <div class="card-body">
                    <div id="container4">
                        <h5 class="card-title">4. Entregado</h5>
                        @foreach ($paquetes as $paquete)
                            @if ($paquete->estado == "Entregado")
                                <button id="{{$paquete->id}}" class="btn btn-primary">Pedido #{{$paquete->id}}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card card1">
                <div class="card-body">
                    <div id="container5">
                        <h5 class="card-title">a. Fallida</h5>
                        @foreach ($paquetes as $paquete)
                            @if ($paquete->estado == "Fallida")
                                <button id="{{$paquete->id}}" class="btn btn-primary">Pedido #{{$paquete->id}}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('public/echo.js') }}"></script>
    <script src="{{ asset('resources/js/bootstrap.js') }}"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <!-- Dragula -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js'></script>

    <script>
        let one = document.querySelector('#container1')
        let two = document.querySelector('#container2')
        let three = document.querySelector('#container3')
        let four = document.querySelector('#container4')
        let five = document.querySelector('#container5')
        var drake = dragula([one, two, three, four, five])

        $container = 0;

        var dragAndDrop = {
            limit: 2,
            count: 0,
            init: function () {
                this.dragula();
                this.drake();
            },
            drake: function () {
                this.dragula.on('drop', this.dropped.bind(this));
                this.dragula.on('over', this.dropped.bind(this));
            },
            dragula: function () {
                this.dragula = dragula(drake,
                    {
                        moves: this.canMove.bind(this),
                        copy: true,
                    });
            },
            canMove: function () {
                return this.count < this.limit;
            },
            dropped: function (el) {
                this.count++;
            }
        };

        let containerFrom = 0;

        dragAndDrop.init();

        drake.on('drop', function(el, container){
            //console.log(containerFrom + " -> " + el.id  + " -> " + container.id);
            if(containerFrom == "container4"){
                $("#" + el.id).remove();
                $('#container4').append('<button id="'+ el.id +'"class="btn btn-primary">Pedido #' + el.id +'</button>');
                containerFrom = 0;
            }
            if(container.id == "container1"){
                $("#" + el.id).remove();
                $("#" + containerFrom).append('<button id="'+ el.id +'"class="btn btn-primary">Pedido #' + el.id +'</button>');
                containerFrom = 0;
            }
        })

        drake.on('over', function (el, container) {
            let inicio = $("#" + el.id).parent().attr('id');
            console.log(inicio);

            let paquete_url = '{{ route('paquetes.update', 0) }}';
            paquete_url = paquete_url.replace('0', el.id);
            $.ajax({
                url: paquete_url,
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: el.id,
                    estado: container.id,
                    inicio: inicio
                }
            })
            .done(function(response) {
                if(inicio == "container4"){
                    containerFrom = inicio;
                }
                nombreEstado = "";
                if(response.estado == "En Local Delivery Center"){
                    nombreEstado = "container2";
                }else if(response.estado == "En proceso de entrega"){
                    nombreEstado = "container3"
                }else if(response.estado == "Entregado"){
                    nombreEstado = "container4"
                }else if(response.estado == "Fallida"){
                    nombreEstado = "container5"
                }

                if(nombreEstado == inicio){
                    containerFrom = inicio;
                }
            })
            .fail(function(jqXHR, response) {
                console.log('Fallido', response);
            });
        });

        function createPackage() {
            $.ajax({
                url: '{{ route('paquetes.store') }}',
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                }
            })
            .done(function(response) {
                let id_res = response.id
                console.log(response)
                $('#container1').append('<button id="'+ id_res +'"class="btn btn-primary">Pedido #' + id_res  +'</button>')

            })
            .fail(function(jqXHR, response) {
                console.log('Fallido', response);
            });
        }

        Echo.private('PacketChannel')
        .listen('NewPackageNotification', (e) => {
        console.log(e);
    });
    </script>
<!-- receive notifications -->

</body>

</html>
