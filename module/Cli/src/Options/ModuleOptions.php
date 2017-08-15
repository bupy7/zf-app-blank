<?php

namespace Cli\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var array
     */
    protected $commands = [];

    public function setCommands(array $commands): ModuleOptions
    {
        $this->commands = $commands;
        return $this;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }
}
