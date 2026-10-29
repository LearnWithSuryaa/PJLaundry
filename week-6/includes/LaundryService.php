<?php

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
}
