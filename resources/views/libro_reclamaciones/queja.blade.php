<div>
    <label class="block text-md font-normal mb-1">1. Tipo de Reclamo o Queja <span class="text-red-700">*</span></label>
    <p class="text-sm italic text-gray-600 mb-1">
        1. RECLAMO: Disconformidad relacionada a los productos o servicios.<br>
        2. QUEJA: Disconformidad no relacionada a los productos o servicios; o, malestar o descontento respecto a la atención al público.
    </p>

    <div class="mt-3 space-y-2 text-[15px]">
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_reclamo_queja" value="reclamo" class="form-radio text-red-600" required>
            <span>Reclamo</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_reclamo_queja" value="queja" class="form-radio text-red-600">
            <span>Queja</span>
        </label>
    </div>
</div>

<div>
    <label class="block text-md font-normal mb-1">2. Tipo de bien contratado <span class="text-red-700">*</span></label>
    <div class="mt-3 space-y-2">
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_bien" value="producto" class="form-radio text-red-600" required>
            <span>Producto</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="tipo_bien" value="servicio" class="form-radio text-red-600">
            <span>Servicio</span>
        </label>
    </div>
</div>
