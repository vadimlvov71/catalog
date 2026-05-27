<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Services\TranslationExportService;
use Illuminate\Http\JsonResponse;

class TranslationController extends Controller
{
    protected TranslationExportService $translationExporter;

    public function __construct(TranslationExportService $translationExporter)
    {
        $this->translationExporter = $translationExporter;
    }

    // Метод для получения переводов по локали через API
    public function getTranslations(string $locale): JsonResponse
    {
        $translationsFile = resource_path("lang_json/{$locale}.json");

        if (!file_exists($translationsFile)) {
            // Если JSON не сгенерирован, создаём на лету (по желанию)
            $this->translationExporter->export('admin.php', ['en', 'ru', 'ua']);
        }

        $translations = json_decode(file_get_contents($translationsFile), true) ?? [];

        return response()->json([
            'locale' => $locale,
            'translations' => $translations,
        ]);
    }
}
