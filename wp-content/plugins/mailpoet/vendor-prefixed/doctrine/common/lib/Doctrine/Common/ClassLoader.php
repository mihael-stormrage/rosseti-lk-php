<?php
 namespace MailPoetVendor\Doctrine\Common; if (!defined('ABSPATH')) exit; use function trigger_error; use const E_USER_DEPRECATED; @\trigger_error(\MailPoetVendor\Doctrine\Common\ClassLoader::class . ' is deprecated.', \E_USER_DEPRECATED); class ClassLoader { protected $fileExtension = '.php'; protected $namespace; protected $includePath; protected $namespaceSeparator = '\\'; public function __construct($ns = null, $includePath = null) { $this->namespace = $ns; $this->includePath = $includePath; } public function setNamespaceSeparator($sep) { $this->namespaceSeparator = $sep; } public function getNamespaceSeparator() { return $this->namespaceSeparator; } public function setIncludePath($includePath) { $this->includePath = $includePath; } public function getIncludePath() { return $this->includePath; } public function setFileExtension($fileExtension) { $this->fileExtension = $fileExtension; } public function getFileExtension() { return $this->fileExtension; } public function register() { \spl_autoload_register([$this, 'loadClass']); } public function unregister() { \spl_autoload_unregister([$this, 'loadClass']); } public function loadClass($className) { if (self::typeExists($className)) { return \true; } if (!$this->canLoadClass($className)) { return \false; } require ($this->includePath !== null ? $this->includePath . \DIRECTORY_SEPARATOR : '') . \str_replace($this->namespaceSeparator, \DIRECTORY_SEPARATOR, $className) . $this->fileExtension; return self::typeExists($className); } public function canLoadClass($className) { if ($this->namespace !== null && \strpos($className, $this->namespace . $this->namespaceSeparator) !== 0) { return \false; } $file = \str_replace($this->namespaceSeparator, \DIRECTORY_SEPARATOR, $className) . $this->fileExtension; if ($this->includePath !== null) { return \is_file($this->includePath . \DIRECTORY_SEPARATOR . $file); } return \false !== \stream_resolve_include_path($file); } public static function classExists($className) { return self::typeExists($className, \true); } public static function getClassLoader($className) { foreach (\spl_autoload_functions() as $loader) { if (\is_array($loader) && ($classLoader = \reset($loader)) && $classLoader instanceof \MailPoetVendor\Doctrine\Common\ClassLoader && $classLoader->canLoadClass($className)) { return $classLoader; } } return null; } private static function typeExists($type, $autoload = \false) { return \class_exists($type, $autoload) || \interface_exists($type, $autoload) || \trait_exists($type, $autoload); } } 