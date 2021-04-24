<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <h1>Dashboard</h1>
    <h2>crear otro paquete</h2>
    <form action="{{route('paquetes.store')}}" method="POST">
        @csrf
        <input class="btn btn-outline-primary" type="submit" value="Agregar nuevo paquete" style="margin: 20px 10px;">
    </form>
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


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
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

        var dragAndDrop = {
            limit: 2,
            count: 0,
            init: function () {
                this.dragula();
                this.drake();
            },
            drake: function () {
                this.dragula.on('drop', this.dropped.bind(this));
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

        // drake.on('drag', function (el, source) {
        //     // document.getElementsByTagName('body')[0].style.backgroundColor = '#28a0ef';
        // })


        // drake.on('drop', function (el, target) {
        //     // el.style.border = '5px dashed white';
        //     // el.innerText = "Drag MEEEE :)"
        //     // document.getElementsByTagName('body')[0].style.backgroundColor = 'black';
        // })

    </script>

</body>

</html>
