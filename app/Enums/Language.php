<?php

namespace App\Enums;

enum Language: string
{
   case EN = 'English';
   case UA = 'Українська';
   case RU = 'Русский';


/**
     * Get human-readable label
     */
    /*
    public function label(): string
    {
        return match($this) {
            self::EN => 'active',
            self::UA => 'out of Stock',
            self::RU => 'closed',
        };
    }
    */
   /**
     * Get FontAwesome icon class
     */
    public function icon(): string
    {
        return match($this) {
            self::EN => 'fa-check-circle',
            self::UA => 'fa-ban',
            self::RU => 'fa-times-circle',
        };
    }
}