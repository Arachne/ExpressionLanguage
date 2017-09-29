<?php

namespace Arachne\ExpressionLanguage\DI;

use Nette\DI\CompilerExtension;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @author Jáchym Toušek <enumag@gmail.com>
 */
class ExpressionLanguageExtension extends CompilerExtension
{
    /**
     * Function providers with this tag are passed to the ExpressionLanguage service.
     */
    const TAG_FUNCTION_PROVIDER = 'arachne.expressionLanguage.functionProvider';

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('expressionLanguage'))
            ->setType(ExpressionLanguage::class);
    }

    public function beforeCompile(): void
    {
        $builder = $this->getContainerBuilder();

        $builder->getDefinition($this->prefix('expressionLanguage'))
            ->setArguments(
                [
                    'providers' => array_map(
                        function ($service) {
                            return '@'.$service;
                        },
                        array_keys($builder->findByTag(self::TAG_FUNCTION_PROVIDER))
                    ),
                ]
            );
    }
}
