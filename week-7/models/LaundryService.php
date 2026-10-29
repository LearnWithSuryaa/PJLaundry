<?php
declare(strict_types=1);

class LaundryService
{
    public function __construct(
        private string $category,
        private string $name,
        private string $icon,
        private string $description,
        private string $price,
        private string $duration,
        private string $theme
    ) {
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    /**
     * Get CSS theme classes for the service card.
     *
     * @return array{bar: string, icon: string}
     */
    public function getThemeClasses(): array
    {
        return match ($this->theme) {
            'blue' => [
                'bar' => 'before:bg-[#8cc0eb]',
                'icon' => 'bg-[#bfddf0] text-[#106367]',
            ],
            'peach' => [
                'bar' => 'before:bg-[#ffebcc]',
                'icon' => 'bg-[#ffebcc] text-[#9a3412]',
            ],
            'teal' => [
                'bar' => 'before:bg-[#106367]',
                'icon' => 'bg-[#e0f2fe] text-[#106367]',
            ],
            default => [
                'bar' => 'before:bg-[#ffc857]',
                'icon' => 'bg-[#fff9d2] text-[#856404]',
            ],
        };
    }

    /**
     * Convert service model to array representation.
     *
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'category' => $this->category,
            'name' => $this->name,
            'icon' => $this->icon,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'theme' => $this->theme,
        ];
    }
}
