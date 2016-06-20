<?php

namespace Tests\Integration;

use Codeception\Test\Unit;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @author Jáchym Toušek <enumag@gmail.com>
 */
class ExpressionLanguageExtensionTest extends Unit
{
    public function testDefaultConfiguration()
    {
        $language = $this->tester->grabService(ExpressionLanguage::class);

        $this->assertInstanceOf(ExpressionLanguage::class, $language);
        $this->assertSame('hello', $language->evaluate('tests_lowercase("HELLO")'));
    }
}
