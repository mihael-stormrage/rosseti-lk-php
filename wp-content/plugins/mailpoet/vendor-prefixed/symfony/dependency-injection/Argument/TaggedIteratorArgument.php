<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MailPoetVendor\Symfony\Component\DependencyInjection\Argument;

/**
 * Represents a collection of services found by tag name to lazily iterate over.
 *
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class TaggedIteratorArgument extends \MailPoetVendor\Symfony\Component\DependencyInjection\Argument\IteratorArgument
{
    private $tag;
    /**
     * @param string $tag
     */
    public function __construct($tag)
    {
        parent::__construct(array());
        $this->tag = (string) $tag;
    }
    public function getTag()
    {
        return $this->tag;
    }
}
