<?php

namespace ExAssetic\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var string Path to bin of NodeJs.
     */
    private $nodeBin = '/usr/bin/node';
    /**
     * @var string Path to Yui Compressor.
     */
    private $yuiPath = '';
    /**
     * @var string Path to Java.
     */
    private $javaPath = '/usr/bin/java';
    /**
     * @var string Path to UglifyJS2.
     */
    private $uglifyJs2Path = '';
    /**
     * @var string Path to SASS post-processor.
     */
    private $sassPath = '';

    public function setNodeBin(string $nodeBin): ModuleOptions
    {
        $this->nodeBin = $nodeBin;
        return $this;
    }

    public function getNodeBin(): string
    {
        return $this->nodeBin;
    }

    public function setYuiPath(string $yuiPath): ModuleOptions
    {
        $this->yuiPath = $yuiPath;
        return $this;
    }

    public function getYuiPath(): string
    {
        return $this->yuiPath;
    }

    public function setJavaPath(string $javaPath): ModuleOptions
    {
        $this->javaPath = $javaPath;
        return $this;
    }

    public function getJavaPath(): string
    {
        return $this->javaPath;
    }

    public function setUglifyJs2Path(string $uglifyJs2Path): ModuleOptions
    {
        $this->uglifyJs2Path = $uglifyJs2Path;
        return $this;
    }

    public function getUglifyJs2Path(): string
    {
        return $this->uglifyJs2Path;
    }

    public function setSassPath(string $sassPath): ModuleOptions
    {
        $this->sassPath = $sassPath;
        return $this;
    }

    public function getSassPath(): string
    {
        return $this->sassPath;
    }
}
