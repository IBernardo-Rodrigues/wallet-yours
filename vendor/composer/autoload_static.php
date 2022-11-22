<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9c42f06dd956350ec731d082f50e3f39
{
    public static $files = array (
        '2717494b14b565a65502d44ff82f2c9d' => __DIR__ . '/../..' . '/App/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9c42f06dd956350ec731d082f50e3f39::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9c42f06dd956350ec731d082f50e3f39::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9c42f06dd956350ec731d082f50e3f39::$classMap;

        }, null, ClassLoader::class);
    }
}