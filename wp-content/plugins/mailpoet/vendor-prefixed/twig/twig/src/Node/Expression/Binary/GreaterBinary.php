<?php
 namespace MailPoetVendor\Twig\Node\Expression\Binary; if (!defined('ABSPATH')) exit; use MailPoetVendor\Twig\Compiler; class GreaterBinary extends \MailPoetVendor\Twig\Node\Expression\Binary\AbstractBinary { public function operator(\MailPoetVendor\Twig\Compiler $compiler) { return $compiler->raw('>'); } } \class_alias('MailPoetVendor\\Twig\\Node\\Expression\\Binary\\GreaterBinary', 'MailPoetVendor\\Twig_Node_Expression_Binary_Greater'); 