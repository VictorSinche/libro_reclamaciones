<head>
    <title>Libro de Reclamaciones - Universidad María Auxiliadora</title>
    <link rel="icon" href="{{ asset('uma/img/logo-uma.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/c500eba471.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div class="relative flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url('uma/img/of_uma.jpeg')">

    <!-- Capa oscura -->
    <div class="absolute inset-0 bg-red-900/30 backdrop-blur-sm"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 flex h-full items-center justify-center">
      <div class="w-[950px] max-h-[750px] p-8 bg-[#FAF3F6] border border-[#c41c407d] rounded-[15px] shadow-lg overflow-y-auto">
        <h1 class="text-3xl font-medium mb-6">HOJA DE RECLAMACIÓN UMA</h1>
          <form id="formulario-reclamo">
              <p class="text-sm text-red-700 font-semibold">* Obligatorio</p>

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
                  <p class="text-sm text-gray-700 mb-4">Puede imprimir una copia de su respuesta después de enviarla</p>
                  <div class="flex items-center space-x-4">
                      <button type="button" id="btn-atras"
                          class="px-6 py-2 rounded-md border border-gray-300 bg-white text-gray-800 hover:bg-gray-100 transition duration-200 hidden">
                          Atrás
                      </button>

                      <button type="button" id="btn-siguiente"
                          class="px-6 py-2 rounded-md bg-[#880E4F] text-white font-semibold hover:bg-[#6a0c3d] transition duration-200">
                          Siguiente
                      </button>

                      <button type="submit" id="btn-enviar"
                          class="px-6 py-2 rounded-md bg-[#880E4F] text-white font-semibold hover:bg-[#6a0c3d] transition duration-200 hidden">
                          Enviar
                      </button>
                  </div>
              </div>
          </form>
      </div>
    </div>
  </div>
</body>

<!-- JS -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
      let pasoActual = 1;
      const totalPasos = 4;

      const mostrarPaso = (n) => {
          if (document.activeElement) document.activeElement.blur(); // quitar focus actual

          document.querySelectorAll('.paso').forEach((p, i) => {
              p.classList.toggle('hidden', i !== n - 1);
          });

          // Mostrar u ocultar botones
          document.getElementById('btn-atras').classList.toggle('hidden', n === 1);
          document.getElementById('btn-siguiente').classList.toggle('hidden', n === totalPasos);
          document.getElementById('btn-enviar').classList.toggle('hidden', n !== totalPasos);
      };
      const validarPaso = (n) => {
          const paso = document.querySelector(`.paso-${n}`);
          const campos = paso.querySelectorAll('input[required], select[required], textarea[required]');

          for (let campo of campos) {
              if (campo.type === 'radio') {
                  const radios = paso.querySelectorAll(`input[name="${campo.name}"]`);
                  const algunoMarcado = [...radios].some(r => r.checked);

                  if (!algunoMarcado) {
                      Swal.fire({
                          icon: 'warning',
                          title: 'Campo obligatorio',
                          text: 'Por favor seleccione una opción antes de continuar.',
                      }).then(() => {
                          radios[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                          radios[0].focus();
                      });
                      return false;
                  }
              } else if (campo.value.trim() === '') {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Campo obligatorio',
                      text: 'Por favor complete todos los campos antes de continuar.',
                  }).then(() => {
                      campo.scrollIntoView({ behavior: 'smooth', block: 'center' });
                      campo.focus();
                  });
                  return false;
              }
          }
          return true;
      };

      document.getElementById('btn-siguiente').addEventListener('click', () => {
          if (validarPaso(pasoActual)) {
              pasoActual++;
              mostrarPaso(pasoActual);
          }
      });

      document.getElementById('btn-atras').addEventListener('click', () => {
          pasoActual--;
          mostrarPaso(pasoActual);
      });

      document.getElementById('formulario-reclamo').addEventListener('submit', (e) => {
          if (!validarPaso(pasoActual)) {
              e.preventDefault();
          } else{

          }
      });

      mostrarPaso(pasoActual);
  });
</script>
