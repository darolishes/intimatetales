<?php

namespace IT\Loaders;

use Exception;
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
     */
    public function __construct( string $template, string $path, string $extension )
    {
        $this->template  = $template;
        $this->path      = $path;
        $this->extension = $extension;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function load( string $template, array $args = [] ): string
    {
        $file = $this->path . DIRECTORY_SEPARATOR . $template . $this->extension;

        if ( !file_exists( $file ) ) {
            throw new Exception( 'Template file not found: ' . $file );
        }

        ob_start();

        locate_template( $file, false, true, $args = [] );

        return ob_get_clean();
    }

    public function setTemplateExtension( string $extension ): void
    {
        $this->extension = $extension;
    }
}
