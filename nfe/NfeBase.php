<?php

/**
 * @link
 * @copyright
 * @license
 */

namespace nfe;

/**
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
class NfeBase {

    public static $aliases = array(
        '@nfe' => __DIR__,
    );
    public static $app;

    /**
     * @param 
     * @return
     * @throws
     */
    public static function getAlias($alias, $throwException = true) {
        if (strncmp($alias, '@', 1)) {
            // not an alias
            return $alias;
        }

        $pos = strpos($alias, '/');
        $root = $pos === false ? $alias : substr($alias, 0, $pos);

        if (isset(self::$aliases[$root])) {
            if (is_string(self::$aliases[$root])) {
                return $pos === false ? self::$aliases[$root] : self::$aliases[$root] . substr($alias, $pos);
            } else {
                foreach (self::$aliases[$root] as $name => $path) {
                    if (strpos($alias . '/', $name . '/') === 0) {
                        return $path . substr($alias, strlen($name));
                    }
                }
            }
        }

        if ($throwException) {
            throw new InvalidParamException("Invalid path alias: $alias");
        } else {
            return false;
        }
    }

    /**
     * @param 
     * @return
     * @throws
     */
    public static function autoload($className) {
        $className = ltrim($className, '\\');

        // follow PSR-0 to determine the class file
        if (($pos = strrpos($className, '\\')) !== false) {
            $path = str_replace('\\', '/', substr($className, 0, $pos + 1))
                    . str_replace('_', '/', substr($className, $pos + 1)) . '.php';
        } else {
            $path = str_replace('_', '/', $className) . '.php';
        }

        // try via path alias first
        if (strpos($path, '/') !== false) {
            $fullPath = static::getAlias('@' . $path, false);
            if ($fullPath !== false && is_file($fullPath)) {
                $classFile = $fullPath;
            }
        }

        if (!isset($classFile)) {
            // return false to let other autoloaders to try loading the class
            return false;
        }

        include($classFile);

        if (class_exists($className, false) || interface_exists($className, false) ||
                function_exists('trait_exists') && trait_exists($className, false)) {
            return true;
        } else {
            throw new UnknownClassException("Unable to find '$className' in file: $classFile");
        }
    }

}