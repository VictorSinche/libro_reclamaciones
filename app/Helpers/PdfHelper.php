<?php

namespace App\Helpers;

class PdfHelper
{
    public static function reemplazarRutasImagenesHTML($contenidoHtml)
    {
        return preg_replace_callback('/<img\s+[^>]*src=["\']([^"\']+)["\']/i', function ($matches) {
            $url = $matches[1];
            $path = str_replace(asset('storage') . '/', '', $url);
            $localPath = storage_path("app/public/" . $path);

            if (file_exists($localPath)) {
                $data = base64_encode(file_get_contents($localPath));
                $ext = pathinfo($localPath, PATHINFO_EXTENSION);
                return '<img src="data:image/' . $ext . ';base64,' . $data . '" />';
            } else {
                return $matches[0]; // deja la imagen como estaba si no la encuentra
            }
        }, $contenidoHtml);
    }
}
