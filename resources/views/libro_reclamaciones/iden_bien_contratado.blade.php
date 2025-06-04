<h2 class="text-lg font-semibold text-[#880E4F] mb-4 mt-6 uppercase">
    IDENTIFICACIÓN DEL BIEN CONTRATADO
</h2>

<div>
    <label class="block text-md font-normal mb-1">13. Programa <span class="text-red-700">*</span></label>
    <div class="mt-3 space-y-2">
        <label class="flex items-center space-x-2">
            <input type="radio" name="programa" value="Pregrado" class="form-radio text-[#E72352] w-5 h-5">
            <span>Pregrado</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="programa" value="Especialización" class="form-radio text-[#E72352] w-5 h-5">
            <span>Especialización</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="programa" value="Postgrado" class="form-radio text-[#E72352] w-5 h-5">
            <span>Postgrado</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="programa" value="Conferencia / Seminario / Webinar" class="form-radio text-[#E72352] w-5 h-5">
            <span>Conferencia / Seminario / Webinar</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="programa" value="Otro" class="form-radio text-[#E72352] w-5 h-5">
            <span>Otro</span>
        </label>
    </div>
</div>

<!-- Campo: Fecha del evento -->
<div class="mt-6">
    <label for="fecha_evento" class="block text-md font-normal text-gray-800 mb-1">
        14. Fecha del evento <span class="text-red-700">*</span>
    </label>

    <input
        type="date"
        id="fecha_evento"
        name="fecha_evento"
        placeholder="Especifique la fecha (d/M/yyyy)"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none text-gray-800"
        required
    >
</div>

<!-- Campo: Monto reclamado -->
<div>
    <label for="monto_reclamado" class="block text-md font-normal text-gray-800 mb-1">
        15. Monto reclamado <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="monto_reclamado"
        name="monto_reclamado"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>

<!-- Campo: Nombres y apellidos con resalte dinámico -->
<div>
    <label for="nom_curso" class="block text-md font-normal text-gray-800 mb-1">
        16. Nombre del programa o curso <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="nom_curso"
        name="nom_curso"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>

<!-- Campo: Nombres y apellidos con resalte dinámico -->
<div>
    <label for="oficina_involucrado" class="block text-md font-normal text-gray-800 mb-1">
        17. Oficina o personal involucrado <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="oficina_involucrado"
        name="oficina_involucrado"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>