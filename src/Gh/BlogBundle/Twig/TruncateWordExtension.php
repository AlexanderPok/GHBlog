<?php
namespace Gh\BlogBundle\Twig;

class TruncateWordExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('truncate_word', array($this, 'truncateWordFilter')),
        );
    }

    public function truncateWordFilter($value, $limit = 50, $ending = '')
    {
        $value = (string)$value;
        if (strlen($value) > $limit) {
            $value = preg_replace("/^(.{1,$limit})(\s.*|$)/s", '\\1', $value) . $ending;
        }

        return $value;
    }

    public function getName()
    {
        return 'truncate_extension';
    }
}