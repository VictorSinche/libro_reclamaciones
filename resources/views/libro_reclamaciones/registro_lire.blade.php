{{-- Solución alternativa: carga directa del CSS y JS compilados --}}
@php
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
@endphp

<link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
<script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>


<title>Libro de Reclamaciones - Universidad María Auxiliadora</title>
<link rel="icon" href="{{ asset('uma/img/logo-uma.ico') }}" type="image/x-icon">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/c500eba471.js" crossorigin="anonymous"></script>

<body>
  @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Formulario enviado!',
            text: '{{ session('success') }}'
        });
    </script>
  @endif

<!-- Loader Global con Imagen -->
<div id="loader-wrapper" class="hidden fixed inset-0 z-[9999] bg-white/80 flex flex-col justify-center items-center">
  <!-- Imagen arriba -->
  <img src="/uma/img/logo-uma.png" alt="Cargando UMA" class="w-16 h-16 mb-4 animate-pulse" />
  
  <!-- Loader animado -->
  <div class="loader"></div>
  
  <!-- Texto -->
  <p class="text-sm text-gray-700 mt-2">Cargando, por favor espera...</p>
</div>

<style>
.loader {
  width: 120px;
  height: 22px;
  border-radius: 20px;
  color: #e72352;
  border: 2px solid;
  position: relative;
}
.loader::before {
  content: "";
  position: absolute;
  margin: 2px;
  inset: 0 100% 0 0;
  border-radius: inherit;
  background: currentColor;
  animation: l6 2s infinite;
}
@keyframes l6 {
  100% { inset: 0 }
}
</style>

  <div class="relative flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url('uma/img/of_uma.jpeg')">
    <!-- Capa oscura -->
    <div class="absolute inset-0 bg-red-900/30 backdrop-blur-sm"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 flex h-full items-center justify-center">
      <div class="w-[950px] max-h-[750px] p-8 bg-[#FAF3F6] border border-[#c41c407d] rounded-[15px] shadow-lg overflow-y-auto">
        @if(!session('success'))
        <h1 class="text-3xl font-medium mb-6">HOJA DE RECLAMACIÓN UMA</h1>
        <div class="w-full bg-gray-300 rounded-full h-2.5 mb-4">
            <div id="barra-progreso" class="bg-[#880E4F] h-2.5 rounded-full transition-all duration-300" style="width: 25%;"></div>
        </div>
            <form id="formulario-reclamo" method="POST" action="{{ route('libro-reclamaciones.store') }}">
                <p class="text-sm text-red-700 font-semibold">* Obligatorio</p>
                @csrf

                <!-- Paso 1 -->
                <div class="paso paso-1 space-y-6">
                    @include('libro_reclamaciones.queja')
                </div>

                <!-- Paso 2 -->
                <div class="paso paso-2 space-y-6 hidden">
                    @include('libro_reclamaciones.info_reclamante')
                </div>

                <!-- Paso 3 -->
                <div class="paso paso-3 space-y-6 hidden">
                    @include('libro_reclamaciones.iden_bien_contratado')
                </div>

                <!-- Paso 4 -->
                <div class="paso paso-4 space-y-6 hidden">
                    @include('libro_reclamaciones.detalle_reclamo')
                </div>

                <!-- Botones -->
                <div class="mt-8">
                    <p class="text-sm text-gray-700 mb-4">Una copia de su respuesta será remitida automáticamente a su dirección de correo electrónico registrada.</p>
                    <div class="flex items-center space-x-4">
                        <button type="button" id="btn-atras"
                            class="px-6 py-2 rounded-md border border-gray-300 bg-white text-gray-800 hover:bg-gray-100 transition duration-200 hidden">
                            Atrás
                        </button>

                        <button type="button" id="btn-siguiente"
                            class="px-6 py-2 rounded-md bg-[#880E4F] text-white font-semibold hover:bg-[#6a0c3d] transition duration-200">
                            Siguiente
                        </button>

                        <button type="button" id="btn-enviar"
                            class="px-6 py-2 rounded-md bg-[#880E4F] text-white font-semibold hover:bg-[#6a0c3d] transition duration-200 hidden">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
          @else
            @include('libro_reclamaciones.confirmacion')
          @endif
          @if ($errors->any())
          <script>
              let errores = @json($errors->all());
              Swal.fire({
                  icon: 'error',
                  title: 'Errores del formulario',
                  html: '<ul style="text-align:left;">' + errores.map(e => `<li>• ${e}</li>`).join('') + '</ul>',
              });
          </script>
          @endif
      </div>
    </div>
  </div>
</body>

<script>
    let pasoActual = 1;
    const totalPasos = 4;

    function mostrarPaso(paso) {
        document.querySelectorAll('.paso').forEach((p, i) => {
            p.classList.toggle('hidden', i + 1 !== paso);
        });

        document.getElementById('btn-atras').classList.toggle('hidden', paso === 1);
        document.getElementById('btn-siguiente').classList.toggle('hidden', paso === totalPasos);
        document.getElementById('btn-enviar').classList.toggle('hidden', paso !== totalPasos);

        actualizarBarraProgreso(paso);
    }

    function actualizarBarraProgreso(paso) {
        const progreso = (paso / totalPasos) * 100;
        const barra = document.getElementById('barra-progreso');
        if (barra) {
            barra.style.width = `${progreso}%`;
        }
    }

    function obtenerCamposVisibles(paso) {
        return [...document.querySelectorAll(`.paso-${paso} [name]`)].filter(
            el => el.offsetParent !== null
        );
    }

    function validarPaso(paso) {
        let esValido = true;
        let primerCampoInvalido = null;

        const contenedor = document.querySelector(`.paso-${paso}`);
        const campos = contenedor.querySelectorAll('[name]');

        // Crear lista única de name para evitar validar radios repetidos
        const validados = new Set();

        campos.forEach(campo => {
            const name = campo.name;
            if (name === 'apoderado') return;
            if (validados.has(name)) return; // ya lo revisamos

            validados.add(name);

            // Si es radio o checkbox, validamos el grupo
            if (campo.type === 'radio' || campo.type === 'checkbox') {
                const grupo = contenedor.querySelectorAll(`[name="${name}"]`);
                const algunoMarcado = Array.from(grupo).some(r => r.checked);

                if (!algunoMarcado) {
                    esValido = false;
                    grupo.forEach(r => r.classList.add('border-red-500'));
                    if (!primerCampoInvalido) primerCampoInvalido = grupo[0];
                } else {
                    grupo.forEach(r => r.classList.remove('ring-red-500'));
                }

            } else {
                // Validar campos normales
                if (!campo.checkValidity()) {
                    esValido = false;
                    campo.classList.add('border-red-500');
                    if (!primerCampoInvalido) primerCampoInvalido = campo;
                } else {
                    campo.classList.remove('border-red-500');
                }
            }
        });

        if (!esValido && primerCampoInvalido) {
            primerCampoInvalido.focus();
        }

        return esValido;
    }

    function validarCorreo() {
        const campoCorreo = document.querySelector('[name="correo"]');
        const valorCorreo = campoCorreo?.value.trim();
        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regexCorreo.test(valorCorreo)) {
            campoCorreo.classList.add('border-red-500');
            campoCorreo.focus();
            Swal.fire({
                icon: 'error',
                title: 'Correo inválido',
                text: 'Por favor, escribe un correo electrónico válido.'
            });
            return false;
        }

        return true;
    }

    document.getElementById('btn-siguiente').addEventListener('click', () => {
        if (!validarPaso(pasoActual)) {
            Swal.fire({
                icon: 'error',
                title: 'Campos obligatorios',
                text: 'Completa todos los campos requeridos antes de continuar.'
            });
            return;
        }

        // Validación especial para el correo
        if (pasoActual === 2 && !validarCorreo()) return;

        pasoActual++;
        mostrarPaso(pasoActual);
    });

    document.getElementById('btn-atras').addEventListener('click', () => {
        pasoActual--;
        mostrarPaso(pasoActual);
    });

    // Mostrar primer paso al cargar
    mostrarPaso(pasoActual);

    document.getElementById('btn-enviar').addEventListener('click', () => {
        if (!validarPaso(pasoActual)) {
            Swal.fire({
                icon: 'error',
                title: 'Faltan campos',
                text: 'Por favor completa todos los campos requeridos antes de enviar el formulario.'
            });
            return;
        }
        //mostrar loader
        document.getElementById('loader-wrapper').classList.remove('hidden');

        // Si todo OK, enviamos el formulario
        document.getElementById('formulario-reclamo').submit();
    });

</script>
