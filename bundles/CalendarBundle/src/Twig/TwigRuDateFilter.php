<?php
namespace bravik\CalendarBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Formats date with localized Russian month:
 * Example: 25 апреля 2018
 * @package App\Templater
 */
class TwigRuDateFilter extends AbstractExtension
{
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    public function getFilters()
    {
        return array(
            new TwigFilter('ru_datetime', array($this, 'dateTimeFilter')),
            new TwigFilter('ru_date', array($this, 'dateFilter')),
        );
    }

    public function dateFilter($date)
    {
        $months = [1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября',
            'октября', 'ноября', 'декабря'];
        if (is_string($date)) {
            $date = \DateTime::createFromFormat(static::DATE_FORMAT, $date);
        }
        $key = $date->format('n');
        return $date->format('d ' . $months[$key] . ' Y');
    }

    public function dateTimeFilter($date)
    {
        $months = [1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября',
            'октября', 'ноября', 'декабря'];
        if (is_string($date)) {
            $date = \DateTime::createFromFormat(static::DATE_FORMAT, $date);
        }
        $key = $date->format('n');
        return $date->format('d ' . $months[$key] . ' Y') . ', ' . $date->format('H:i');
    }
}
