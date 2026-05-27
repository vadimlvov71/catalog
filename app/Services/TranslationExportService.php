<?php

namespace App\Services;

use Illuminate\Filesystem\Filesystem;

class TranslationExportService
{
    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function export(string $filename = 'admin.php', array $locales, string $outputPath = null): array
    {
        $outputPath = $outputPath ?: resource_path('lang_json');
        $result = [];

        foreach ($locales as $locale) {
            $translations = [];

            $filePath = resource_path("lang/{$locale}/{$filename}");
            if (!$this->files->exists($filePath)) {
                continue; // пропускаем, если файл не найден
            }

            $content = $this->files->getRequire($filePath);

            $this->flattenTranslations($content, '', $translations);

            $jsonPath = rtrim($outputPath, '/') . "/{$locale}.json";
            $this->files->ensureDirectoryExists(dirname($jsonPath));
            
            $this->files->put($jsonPath, json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            $result[$locale] = $jsonPath;
        }

        return $result;
    }

    protected function flattenTranslations(array $array, string $prefix, array &$result)
    {
        foreach ($array as $key => $value) {
            $fullKey = $prefix === '' ? $key : $prefix . '.' . $key;
            if (is_array($value)) {
                $this->flattenTranslations($value, $fullKey, $result);
            } else {
                $result[$fullKey] = $value;
            }
        }
    }
}
