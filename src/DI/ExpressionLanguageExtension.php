<?php

/**
 * This file is part of the Arachne
 *
 * Copyright (c) Jáchym Toušek (enumag@gmail.com)
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 */

namespace Arachne\ExpressionLanguage\DI;

use Nette\DI\CompilerExtension;

/**
 * @author Jáchym Toušek <enumag@gmail.com>
 */
class ExpressionLanguageExtension extends CompilerExtension
{
    /**
     * Function providers with this tag are passed to the ExpressionLanguage service.
     */
    const TAG_FUNCTION_PROVIDER = 'arachne.expressionLanguage.functionProvider';

    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('expressionLanguage'))
            ->setClass('Symfony\Component\ExpressionLanguage\ExpressionLanguage');
    }

    public function beforeCompile()
    {
        $builder = $this->getContainerBuilder();

        $builder->getDefinition($this->prefix('expressionLanguage'))
            ->setArguments([
                'providers' => array_map(
                    function ($service) {
                        return '@' . $service;
                    },
                    array_keys($builder->findByTag(self::TAG_FUNCTION_PROVIDER))
                ),
            ]);
    }
}
