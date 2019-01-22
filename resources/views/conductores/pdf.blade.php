<style>
    @page {
        margin-top: 120px;
        margin-bottom: 80px;
        margin-left: 55px;
        margin-right: 55px;
    }

    body {
        text-align: justify;
        text-justify: inter-word;
        line-height: 25px;
        font-family: Arial, Helvetica, sans-serif;
    }

    header {
        position: fixed;
        top: -110px;
        left: 0px;
        right: 0px;
        height: 80px;
    }

    footer {
        position: fixed;
        bottom: -40px;
        left: 0px;
        right: 0px;
        height: 40px;
    }

    .listado_uts th {
        text-align: center;
        border: 1px solid #aaaa;
        background-color: #BFE1FF;
    }

    .listado_uts td {
        text-align: right;
        border: 1px solid #aaaa;
    }

    .listado_uts table, td, th {
        border: 1px solid #aaaa;
        padding: 3px;
    }

    .cTable th {
        background-color: #BEE2F2;
        text-align: center;
    }

    .cTable td {
        line-height: 20px;
    }

    td, th {
        border: 1px solid #999999;
        padding: 2px 10px 2px 10px;

    }

    .ut tr {
        line-height: 20px;
    }

    table {
        border-collapse: collapse;
    }

    .titulo td {
        font-size: 20px;
    }

    .ut td {
        padding: 5px 15px 5px 15px;
        text-align: justify;
    }

    .titulo_c1 td {
        background-color: #BAEBFF;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
    }

    .titulo_c2 td, th {
        background-color: #FFC785;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
    }

    .titulo_c3 td {
        background-color: #BFBFBF;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
    }

    table tr th td {
        page-break-inside: avoid;
    }

    .sin_relacionar {
        background-color: #FFEBC7;
    }

    .derecha {
        text-align: right !important;
        padding-left: 5px !important;
        padding-right: 5px !important;
    }

</style>
<table class="table table-bordered" style="border: 1px solid black;">
    <tr>
        <th>Núm. Conductor</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Email</th>
    </tr>
    @foreach($conductores as $conductor)
        <tr>
            <td>{{$conductor->num_conductor}}</td>
            <td>{{$conductor->nombre}}</td>
            <td>{{$conductor->telefono}}</td>
            <td>{{$conductor->email}}</td>
        </tr>
    @endforeach
</table>
