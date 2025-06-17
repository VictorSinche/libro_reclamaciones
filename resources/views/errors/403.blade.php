{{-- <!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error 403 – No tienes permiso</title>
    <!-- Tailwind CSS vía CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-slate-900 to-slate-700 text-center text-white">
    <!-- Fantasma -->
    <div id="ghost" class="relative flex flex-col items-center transition-transform duration-700">
        <!-- Cuerpo del fantasma -->
        <div class="w-36 h-40 bg-white rounded-t-full flex items-end justify-center">
        <span class="text-slate-800 font-extrabold text-sm pb-6">WaSAAAAAAAAAAAAAAAAAAAAAAA</span>
        </div>
        <!-- Picos inferiores del fantasma -->
        <div class="flex">
        <div class="w-9 h-6 bg-white rounded-b-full"></div>
        <div class="w-9 h-6 bg-white rounded-b-full mx-1"></div>
        <div class="w-9 h-6 bg-white rounded-b-full"></div>
        </div>
        <!-- Ojos -->
        <div class="absolute top-10 left-1/2 -translate-x-1/2 flex space-x-6">
        <span class="w-4 h-4 bg-slate-800 rounded-full"></span>
        <span class="w-4 h-4 bg-slate-800 rounded-full"></span>
        </div>
    </div>

    <!-- Texto de error -->
    <p class="mt-10 text-xl font-semibold tracking-wide">No tienes permiso – vista de error 403 😅</p>

    <!-- Pequeña animación: el fantasma “flota” -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const ghost = document.getElementById('ghost');
        let up = true;
        setInterval(() => {
            ghost.style.transform = up ? 'translateY(-12px)' : 'translateY(0)';
            up = !up;
        }, 800);
        });
    </script>
    </body>
</html> --}}



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Error 403</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes flotar {
      0%, 100% { transform: translateX(0); }
      50% { transform: translateX(20px); }
    }
    .fantasma-animado {
      animation: flotar 3s ease-in-out infinite;
    }
  </style>
</head>
<body class="bg-gray-900 text-white flex flex-col items-center justify-center min-h-screen p-4">

  <div class="fantasma-animado">
    <svg width="200" height="200" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M32 2C18.7 2 8 12.7 8 26V62C8 62 12 58 16 58C20 58 24 62 28 62C32 62 36 58 40 58C44 58 48 62 48 62V26C48 12.7 37.3 2 24 2H32Z" fill="#fff"/>
      <circle cx="22" cy="26" r="4" fill="#000"/>
      <circle cx="42" cy="26" r="4" fill="#000"/>
      <path d="M26 36C28 39 36 39 38 36" stroke="#000" stroke-width="2" stroke-linecap="round"/>
    </svg>
  </div>

  <h1 class="text-3xl font-bold mt-4 animate-bounce">WaSAAAAAAAAAAAAAAAAAAAAAAA</h1>
  <p class="text-red-500 mt-2 text-xl">403 - No tienes permiso para ver esto</p>

</body>
</html>
