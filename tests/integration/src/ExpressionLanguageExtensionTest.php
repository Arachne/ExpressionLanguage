<?php

namespace Tests\Integration;

use Arachne\Bootstrap\Configurator;
use Codeception\Test\Unit;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @author Jáchym Toušek <enumag@gmail.com>
 */
class ExpressionLanguageExtensionTest extends Unit
{
    public function testDefaultConfiguration()
    {
        $container = $this->createContainer('config.neon');
        $language = $container->getByType(ExpressionLanguage::class);

        $this->assertInstanceOf(ExpressionLanguage::class, $language);
        $this->assertSame('hello', $language->evaluate('tests_lowercase("HELLO")'));
    }

    private function createContainer($file)
    {
        $config = new Configurator();
        $config->setTempDirectory(TEMP_DIR);
        $config->addConfig(__DIR__.'/../config/'.$file);

        return $config->createContainer();
    }
}
