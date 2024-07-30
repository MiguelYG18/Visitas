<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UGJ | Reporte Visitantes</title>
    <link rel="stylesheet" href="{{ asset('dist/css/Report.css') }}" media="all" />
    <link rel="icon" href="{{asset('dist/img/ugel.png') }}">
</head>

<body>
    <header class="clearfix">
        <div id="company">
            <h2 class="name">UGEL HUANCAYO</h2>
            <div>Jr. Atalaya nro. 1280 (costado de registros públicos)</div>
            <div>Junín - Huancayo - El Tambo</div>
            <div>(064) 229967</div>
        </div>
		<div id="logo">
            <img src="{{ asset('dist/img/ugel.png') }}" width="70px" height="70px">
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">VIGILANCIA:</div>
                <h2 class="name">{{ Auth::user()->surnames }}, {{ Auth::user()->names }}</h2>
            </div>
            <div id="invoice">
                <h1>VISITANTES DEL DÍA</h1>
                <div class="date">Fecha: <?php echo date('d-m-Y'); ?></div>
                <div class="date">Horarios: 8:00 A 13:00 y 14:30 A 17:30</div>
            </div>
        </div>
        <table>
            <thead>
                <tr style="border: 2px solid; border-color: #acacb1da;">
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">#</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">VISITANTE</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">DNI</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">ÁREA</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">INGRESO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitors as $index => $visitor)
                    <tr>
                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $index + 1 }}</td>
                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $visitor->surnames }}, {{ $visitor->names }}</td>
                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $visitor->dni }}</td>
                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $visitor->area->names }}</td>
                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">
                            {{
                                \Carbon\Carbon::parse($visitor->fecha_hora)->format('d-m-Y') . '
                                ' .
                                \Carbon\Carbon::parse($visitor->fecha_hora)->format('g:i A')
                              }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
		<br><br><br>
        <div id="notices">
            <div>NOTA:</div>
            <div class="notice">REPORTE DIARIO DE VISITANTES AL PLANTEL.</div>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>
