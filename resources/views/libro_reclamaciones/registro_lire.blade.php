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
      <div class="w-[650px] max-h-[750px] p-8 bg-[#FAF3F6] border border-[#c41c407d] rounded-[15px] shadow-lg overflow-y-auto">
        <h1 class="text-2xl font-bold mb-6">HOJA DE RECLAMACIÓN UMA</h1>
        <form class="space-y-6">
          <!-- Campo obligatorio -->
          <p class="text-sm text-red-700 font-semibold">* Obligatorio</p>
          <!-- Tipo de Reclamo o Queja -->
          @include('libro_reclamaciones.queja')
          @include('libro_reclamaciones.info_reclamante')
          @include('libro_reclamaciones.iden_bien_contratado')
          @include('libro_reclamaciones.detalle_reclamo')
          <!-- Puedes agregar más campos aquí según necesites -->
        </form>
      </div>
    </div>
  </div>
</body>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
