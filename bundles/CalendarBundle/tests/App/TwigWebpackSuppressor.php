<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace bravik\CalendarBundle\Tests\App;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigWebpackSuppressor extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('encore_entry_js_files', [$this, 'returnEmptyString']),
            new TwigFunction('encore_entry_css_files', [$this, 'returnEmptyString']),
            new TwigFunction('encore_entry_script_tags', [$this, 'returnEmptyString'], ['is_safe' => ['html']]),
            new TwigFunction('encore_entry_link_tags', [$this, 'returnEmptyString'], ['is_safe' => ['html']]),
        ];
    }

    public function returnEmptyString()
    {
        return '';
    }
}