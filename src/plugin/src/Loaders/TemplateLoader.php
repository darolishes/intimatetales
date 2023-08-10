<?php

namespace IT\Loaders;

use IT\Interfaces\TemplateLoaderInterface;

class TemplateLoader implements TemplateLoaderInterface
{
    /**
     * @var string
     */
    protected $template;
    /**
     * @var string
     */
    protected $path;
    /**
     * @var string
     */
    protected $extension;

    /**
     * TemplateLoader constructor.
     * @param string $template
     * @param string $path
     * @param string $extension
     */
    public function __construct(string $template, string $path, string $extension)
    {
        $this->template = $template;
        $this->path = $path;
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $template
     * @param array $args
     * @return string
     */
    public function load(string $template, array $args = []): string
    {
        $file = $this->path . DIRECTORY_SEPARATOR . $template . $this->extension;


        if (!file_exists($file)) {
            throw new \Exception('Template file not found: ' . $file);
        }

        ob_start();

        locate_template($file, false, true, $args = []);

        return ob_get_clean();
    }

    /**
     * @param string $extension
     */
    public function setTemplateExtension(string $extension): void
    {
        $this->extension = $extension;
    }
}
