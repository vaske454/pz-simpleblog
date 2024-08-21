<?php

namespace App\Util;

class YamlParser
{
    public static function parseFile($filename)
    {
        $yaml = file_get_contents($filename);
        return self::parse($yaml);
    }

    private static function parse($yaml)
    {
        $lines = explode("\n", trim($yaml));
        $result = [];
        $currentKey = null;

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line) || $line[0] === '#') {
                continue;
            }

            if (preg_match('/^(\w+):\s*(.*)$/', $line, $matches)) {
                $key = $matches[1];
                $value = $matches[2];

                if ($value === '') {
                    $currentKey = $key;
                    $result[$currentKey] = [];
                } else {
                    $result[$currentKey][$key] = $value;
                }
            } else {
                if ($currentKey !== null) {
                    $result[$currentKey][] = $line;
                }
            }
        }

        return $result;
    }
}
