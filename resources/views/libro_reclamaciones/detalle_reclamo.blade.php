<h2 class="text-lg font-semibold text-[#880E4F] mb-4 mt-6 uppercase">
    DETALLE DEL RECLAMO
</h2>

<div>
    <label class="block text-md font-normal mb-1">18. Motivo del reclamo <span class="text-red-700">*</span></label>
    <div class="mt-3 space-y-2">
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Problemas con la infraestructura" class="form-radio text-red-600">
            <span>Problemas con la infraestructura</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Características del producto o servicio" class="form-radio text-red-600">
            <span>Características del producto o servicio</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Mala atención" class="form-radio text-red-600">
            <span>Mala atención</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Falta / Demora en la entrega de documentos" class="form-radio text-red-600">
            <span>Falta / Demora en la entrega de documentos</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Problemas con cobranza" class="form-radio text-red-600">
            <span>Problemas con cobranza</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Problemas con Sistemas" class="form-radio text-red-600">
            <span>Problemas con Sistemas</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Problemas de matrícula" class="form-radio text-red-600">
            <span>Problemas de matrícula</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Problemas con certificaciones / documentos" class="form-radio text-red-600">
            <span>Problemas con certificaciones / documentos</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Problemas con clases o profesores" class="form-radio text-red-600">
            <span>Problemas con clases o profesores</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="motivo_reclamo" value="Otros" class="form-radio text-red-600">
            <span>Otros</span>
        </label>
    </div>
</div>

<!-- Campo: Descripción de la Queja o Reclamo -->
<div class="mt-6">
    <label for="descripcion_reclamo" class="block text-md font-normal text-gray-800 mb-1">
        19. Descripción de la Queja o Reclamo <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="descripcion_reclamo"
        name="descripcion_reclamo"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none text-gray-800"
        required
    >
</div>

<!-- Campo: Pedido -->
<div>
    <label for="pedido" class="block text-md font-normal text-gray-800 mb-1">
        20. Pedido <span class="text-red-700">*</span>
    </label>

    <input
        type="text"
        id="pedido"
        name="pedido"
        placeholder="Escriba su respuesta"
        class="w-full px-3 py-2 bg-white border-b-2 border-transparent focus:border-[#880E4F] hover:border-[#C2185B] transition duration-200 outline-none"
        required
    >
</div>
