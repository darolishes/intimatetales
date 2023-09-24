<?php
namespace IntimateTales\Models;

abstract class Model
{
    protected array $attributes = [];
    protected ?array $meta = null;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    protected function load_meta(): void
    {
        // Implement this method in child classes to load meta data
    }

    public function set(string $key, mixed $value): self
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function get(string $key): mixed
    {
        return $this->attributes[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->attributes);
    }
}