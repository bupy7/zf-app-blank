<?php

namespace Cli\Manager\Provider;

interface CommandManagerProviderInterface
{
    public function getCommandManagerConfig(): array;
}
