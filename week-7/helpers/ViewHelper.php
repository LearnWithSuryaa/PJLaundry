<?php
declare(strict_types=1);

class ViewHelper
{
    /**
     * Escape output safely for HTML contexts.
     */
    public static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Generate Lucide icon HTML markup.
     */
    public static function lucideIcon(string $name, string $class = 'h-6 w-6'): string
    {
        $iconNames = [
            'laundry' => 'washing-machine',
            'express' => 'zap',
            'premium' => 'sparkles',
            'delivery' => 'truck',
            'shirt' => 'shirt',
            'dress' => 'shirt',
            'jacket' => 'shirt',
            'bedding' => 'bed-double',
            'carpet' => 'square',
            'shoe' => 'footprints',
            'check' => 'check',
            'search' => 'search',
            'bell' => 'bell',
        ];

        return sprintf(
            '<i data-lucide="%s" class="%s" aria-hidden="true"></i>',
            $iconNames[$name] ?? 'washing-machine',
            self::escape($class)
        );
    }
}
