<?php

namespace IT\Interfaces;

interface TemplateLoaderInterface
{

    public function renderTemplate( EmailTemplate $template, array $args ): string;
}
