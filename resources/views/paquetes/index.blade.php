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
                                <button class="btn btn-primary">Pedido #{{$paquete->id}}</button>
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
                                <button class="btn btn-primary">Pedido #{{$paquete->id}}</button>
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
                                <button class="btn btn-primary">Pedido #{{$paquete->id}}</button>
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
                                <button class="btn btn-primary">Pedido #{{$paquete->id}}</button>
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
                                <button class="btn btn-primary">Pedido #{{$paquete->id}}</button>
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

        dragAndDrop.init();

        drake.on('over', function (el, container) {
            console.log(container);
        })


        // drake.on('drop', function (el, target) {
        //     // el.style.border = '5px dashed white';
        //     // el.innerText = "Drag MEEEE :)"
        //     // document.getElementsByTagName('body')[0].style.backgroundColor = 'black';
        // })

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
                $('#container1').append('<button class="btn btn-primary">Pedido #' + id_res  +'</button>')

            })
            .fail(function(jqXHR, response) {
                console.log('Fallido', response);
            });
        }

    </script>

</body>

</html>
