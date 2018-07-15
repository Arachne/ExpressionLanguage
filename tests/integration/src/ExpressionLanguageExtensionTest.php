<?php

declare(strict_types=1);

namespace Tests\Integration;

use Arachne\Codeception\Module\NetteDIModule;
use Codeception\Test\Unit;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @author Jáchym Toušek <enumag@gmail.com>
 */
class ExpressionLanguageExtensionTest extends Unit
{
    /**
     * @var NetteDIModule
     */
    protected $tester;

    public function testDefaultConfiguration(): void
    {
        $language = $this->tester->grabService(ExpressionLanguage::class);

        self::assertInstanceOf(ExpressionLanguage::class, $language);
        self::assertSame('hello', $language->evaluate('tests_lowercase("HELLO")'));
    }
}
