{{-- @extends('layouts.app')

@section('content') --}}
<div class="max-w-4xl mx-auto p-8 bg-white border border-gray-300 shadow-lg text-sm text-black font-sans">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #111;
            padding: 8px;
            vertical-align: top;
        }
        th {
            text-align: left;
            background-color: #f3f3f3;
        }
        .tabla-header {
            text-align: center;
            padding: 12px;
        }
        .tabla-header img {
            height: 70px;
        }
    </style>

    <table>
        <!-- Encabezado institucional completo -->
        <tr>
            <td colspan="4" class="tabla-header">
                <table style="width: 100%; border: none;">
                    <tr style="border: none;">
                        <td style="width: 20%; border: none; text-align: left;">
                            <img src="{{ public_path('/uma/img/logo-uma.png') }}" alt="Logo UMA">
                        </td>
                        <td style="width: 60%; border: none; text-align: center;">
                            <strong style="font-size: 20px;">UNIVERSIDAD MARÍA AUXILIADORA</strong><br>
                            <span style="font-size: 18px;">Av. Canto Bello 431, San Juan de Lurigancho</span>
                        </td>
                        <td style="width: 20%; border: none; text-align: right;">
                            <img src="{{ public_path('/uma/img/reclamaciones.png') }}" alt="Libro de Reclamaciones">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Título de la hoja -->
        <tr>
            <th colspan="2">LIBRO DE RECLAMACIONES</th>
            <th colspan="2">HOJA DE RECLAMACIÓN Nº</th>
        </tr>
        <tr>
            <td><strong>FECHA:</strong></td>
            <td>
                {{ \Carbon\Carbon::parse($reclamo->fecha_evento)->format('d') }} /
                {{ \Carbon\Carbon::parse($reclamo->fecha_evento)->format('m') }} /
                {{ \Carbon\Carbon::parse($reclamo->fecha_evento)->format('Y') }}
            </td>
            <td><strong>Nro:</strong></td>
            <td>{{ $reclamo->id }}</td>
        </tr>
        <tr><th colspan="4">1. IDENTIFICACIÓN DEL CONSUMIDOR</th></tr>
        <tr>
            <td><strong>Nombre:</strong></td>
            <td>{{ $reclamo->nombre_apellido }}</td>
            <td><strong>Domicilio:</strong></td>
            <td>{{ $reclamo->direccion }}</td>
        </tr>
        <tr>
            <td><strong>{{ $reclamo->tipo_documento }}:</strong></td>
            <td>{{ $reclamo->nro_doc }}</td>
            <td><strong>Teléfono / E-mail:</strong></td>
            <td>{{ $reclamo->telefono }} / {{ $reclamo->correo }}</td>
        </tr>
        <tr>
            <td><strong>Celular:</strong></td>
            <td>{{ $reclamo->nro_cel }}</td>
            <td><strong>Ubicación:</strong></td>
            <td>{{ $reclamo->ubicacion }}</td>
        </tr>
        <tr>
            <td><strong>Tipo de Reclamante:</strong></td>
            <td>{{ $reclamo->tipo_reclamante }}</td>
            <td><strong>Apoderado:</strong></td>
            <td>{{ $reclamo->apoderado }}</td>
        </tr>
        <tr>
            <td colspan="4"><strong>Programa Académico:</strong> {{ $reclamo->programa }}</td>
        </tr>

        <tr><th colspan="4">2. IDENTIFICACIÓN DEL BIEN CONTRATADO</th></tr>
        <tr>
            <td><strong>Producto:</strong></td>
            <td><strong>{{ $reclamo->tipo_bien == 'producto' ? 'X' : '' }}</strong></td>
            <td><strong>Servicio:</strong></td>
            <td><strong>{{ $reclamo->tipo_bien == 'servicio' ? 'X' : '' }}</strong></td>
        </tr>
        <tr>
            <td><strong>Curso:</strong></td>
            <td>{{ $reclamo->nom_curso }}</td>
            <td><strong>Oficina Involucrada:</strong></td>
            <td>{{ $reclamo->oficina_involucrado }}</td>
        </tr>
        <tr>
            <td colspan="4"><strong>Monto Reclamado:</strong> S/ {{ number_format($reclamo->monto_reclamado, 2) }}</td>
        </tr>

        <tr><th colspan="4">3. DETALLE DE LA RECLAMACIÓN</th></tr>
        <tr>
            <td><strong>Reclamo</strong></td>
            <td><strong>{{ $reclamo->tipo_reclamo_queja == 'reclamo' ? 'X' : '' }}</td>
            <td><strong>Queja</strong><strong></td>
            <td><strong>{{ $reclamo->tipo_reclamo_queja == 'queja' ? 'X' : '' }}</td>
        </tr>
        <tr>
            <td colspan="1"><strong>Motivo:</strong></td>
            <td colspan="3">{{ $reclamo->motivo_reclamo }}</td>
        </tr>
        <tr>
            <td colspan="1"><strong>Descripción:</strong></td>
            <td colspan="3">{{ $reclamo->descripcion_reclamo }}</td>
        </tr>
        <tr>
            <td colspan="1"><strong>Pedido:</strong></td>
            <td colspan="3">{{ $reclamo->pedido }}</td>
        </tr>

        {{-- <tr><th colspan="4">4. ACCIONES ADOPTADAS POR EL PROVEEDOR</th></tr>
        <tr>
            <td colspan="4" style="height: 80px;">
                (Para ser llenado por la universidad)
            </td>
        </tr>

        <tr>
            <td colspan="2" class="text-center"><strong>Firma del Consumidor</strong><br><br><br></td>
            <td colspan="2" class="text-center"><strong>Firma del Proveedor</strong><br>(opcional)<br><br></td>
        </tr> --}}

        <tr>
            <td colspan="4" class="text-xs italic text-justify">
                <strong>RECLAMO:</strong> Disconformidad relacionada a los productos o servicios.<br>
                <strong>QUEJA:</strong> Disconformidad no relacionada a los productos o servicios, o malestar respecto a la atención al público.
            </td>
        </tr>
    </table>
</div>
{{-- @endsection --}}
