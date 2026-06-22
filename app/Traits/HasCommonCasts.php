<?php
// app/Traits/HasCommonCasts.php
namespace App\Traits;

trait HasCommonCasts
{
    protected function initializeHasCommonCasts()
    {
        $this->mergeCommonCasts([
            'created_at' => 'datetime:d.m.Y H:i',
            'updated_at' => 'datetime:d.m.Y H:i',
            'is_active' => 'boolean',
            'deleted_at' => 'datetime:d.m.Y',
        ]);
    }

    public function mergeCommonCasts(array $newCasts)
    {
        $this->casts = array_merge($this->casts ?? [], $newCasts);
    }
}