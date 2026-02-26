<?php

declare(strict_types=1);

namespace Sentry\Tests;

use PHPUnit\Runner\BeforeTestHook as BeforeTestHookInterface;
use Sentry\Integration\IntegrationRegistry;
use Sentry\SentrySdk;
use Sentry\State\Scope;

final class SentrySdkExtension implements BeforeTestHookInterface
{
    public function executeBeforeTest(string $test): void
    {
        $reflectionProperty = new \ReflectionProperty(SentrySdk::class, 'currentHub');
        $reflectionProperty->setValue(null, null);

        $reflectionProperty = new \ReflectionProperty(Scope::class, 'globalEventProcessors');
        $reflectionProperty->setValue(null, []);

        $reflectionProperty = new \ReflectionProperty(IntegrationRegistry::class, 'integrations');
        $reflectionProperty->setValue(IntegrationRegistry::getInstance(), []);
    }
}
