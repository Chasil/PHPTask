<?php

namespace App\Model;

class LanguageCalculator
{
    /**
     * @param array $repos
     * @return array
     */
    public function calculate(array $repos): array
    {
        $languages = [];
        foreach ($repos as $repo) {
            if (!isset($repo['language']) || !$repo['language']) continue;
            $languages[$repo['language']] = ($languages[$repo['language']] ?? 0) + $repo['size'];
        }

        $totalSize = array_sum($languages);
        foreach ($languages as $lang => $size) {
            $languages[$lang] = round(($size / $totalSize) * 100, 2);
        }

        return $languages;
    }
}