<h2 class="text-lg font-semibold text-[#880E4F] mb-4 mt-6 uppercase">
  Identificación del reclamante
</h2>

<div>
    <label class="block text-md font-normal mb-1">3. Tipo de reclamante <span class="text-red-700">*</span></label>
    <div class="mt-3 space-y-2">
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_reclamante" value="Estudiante" class="form-radio text-[#E72352] w-5 h-5">
            <span>Estudiante</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_reclamante" value="Padre / Tutor o apoderado" class="form-radio text-[#E72352] w-5 h-5">
            <span>Padre / Tutor o apoderado</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_reclamante" value="Usuario visitante" class="form-radio text-[#E72352] w-5 h-5">
            <span>Usuario visitante</span>
        </label>
    </div>
</div>

<!-- Campo: Nombres y apellidos -->
<div>
    <label for="nombre_apellido" class="block text-md font-normal text-gray-800 mb-1">
        4. Nombres y apellidos <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="nombre_apellido"
        name="nombre_apellido"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>

<div>
    <label class="block text-md font-normal mb-1">5. Tipo documento <span class="text-red-700">*</span></label>
    <div class="mt-3 space-y-2">
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_documento" value="Código de estudiante" class="form-radio text-[#E72352] w-5 h-5">
            <span>Código de estudiante</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_documento" value="DNI" class="form-radio text-[#E72352] w-5 h-5">
            <span>DNI</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_documento" value="Carné de extranjería" class="form-radio text-[#E72352] w-5 h-5">
            <span>Carné de extranjería</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_documento" value="RUC" class="form-radio text-[#E72352] w-5 h-5">
            <span>RUC</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_documento" value="Pasaporte" class="form-radio text-[#E72352] w-5 h-5">
            <span>Pasaporte</span>
        </label>
    </div>
</div>

<!-- Campo: Nombres y apellidos con resalte dinámico -->
<!-- Campo: N° de documento -->
<div>
    <label for="nro_doc" class="block text-md font-normal text-gray-800 mb-1">
        6. N° de documento <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="nro_doc"
        name="nro_doc"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>

<!-- Campo: N° de celular -->
<div>
    <label for="nro_cel" class="block text-md font-normal text-gray-800 mb-1">
        7. N° de celular <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="nro_cel"
        name="nro_cel"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>

<!-- Campo: Teléfono fijo -->
<div>
    <label for="telefono" class="block text-md font-normal text-gray-800 mb-1">
        8. Teléfono fijo</span>
    </label>

    <input
        type="text"
        id="telefono"
        name="telefono"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>
<!-- Campo: Correo electrónico -->
<div>
    <label for="correo" class="block text-md font-normal text-gray-800 mb-1">
        9. Correo electrónico <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="correo"
        name="correo"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>

<!-- Campo: Dirección -->
<div>
    <label for="direccion" class="block text-md font-normal text-gray-800 mb-1">
        10. Dirección <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="direccion"
        name="direccion"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>

<!-- Campo: Departamento, Provincia y Distrito -->
<div>
    <label for="ubicacion" class="block text-md font-normal text-gray-800 mb-0.5">
        11. Departamento, Provincia y distrito <span class="text-red-700">*</span>
    </label>

    <p class="text-sm italic text-gray-600 mb-1">
        Por ejemplo: LIMA, LIMA, Ate
    </p>

    <input
        type="text"
        id="ubicacion"
        name="ubicacion"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>

<!-- Campo: Nombre del padre, madre o apoderado -->
<div>
    <label for="apoderado" class="block text-md font-normal text-gray-800 mb-1">
        12. Nombre del padre, madre o apoderado (en caso sea menor de edad).
    </label>

    <input
        type="text"
        id="apoderado"
        name="apoderado"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>
