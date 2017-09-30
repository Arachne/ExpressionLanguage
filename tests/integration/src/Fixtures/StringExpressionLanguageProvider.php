<?php

declare(strict_types=1);

namespace Tests\Integration\Fixtures;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

/**
 * @author Jáchym Toušek <enumag@gmail.com>
 */
class StringExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    public function getFunctions(): array
    {
        return [
            new ExpressionFunction(
                'tests_lowercase',
                function ($string) {
                    return sprintf('(is_string(%1$s) ? strtolower(%1$s) : %1$s)', $string);
                },
                function ($arguments, $string) {
                    return is_string($string) ? strtolower($string) : $string;
                }
            ),
        ];
    }
}
