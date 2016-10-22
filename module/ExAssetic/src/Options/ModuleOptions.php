<?php

namespace ExAssetic\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var string Path to bin of NodeJs.
     */
    protected $nodeBin;
    /**
     * @var array Path to module or package NodeJs.
     */
    protected $nodePaths;
    /**
     * @var string Path to Yui Compressor.
     */
    protected $yuiPath;
    /**
     * @var string Path to Java.
     */
    protected $javaPath;
    /**
     * @var string Path to UglifyJS2.
     */
    protected $uglifyJs2Path;

    /**
     * @param string $nodeBin
     * @return static
     */
    public function setNodeBin($nodeBin)
    {
        $this->nodeBin = $nodeBin;
        return $this;
    }

    /**
     * @return string
     */
    public function getNodeBin()
    {
        return $this->nodeBin;
    }

    /**
     * @param array $nodePaths
     * @return static
     */
    public function setNodePaths($nodePaths)
    {
        $this->nodePaths = $nodePaths;
        return $this;
    }

    /**
     * @return array
     */
    public function getNodePaths()
    {
        return $this->nodePaths;
    }

    /**
     * @param string $yuiPath
     * @return static
     */
    public function setYuiPath($yuiPath)
    {
        $this->yuiPath = $yuiPath;
        return $this;
    }

    /**
     * @return string
     */
    public function getYuiPath()
    {
        return $this->yuiPath;
    }

    /**
     * @param string $javaPath
     * @return static
     */
    public function setJavaPath($javaPath)
    {
        $this->javaPath = $javaPath;
        return $this;
    }

    /**
     * @return string
     */
    public function getJavaPath()
    {
        return $this->javaPath;
    }

    /**
     * @param string $uglifyJs2Path
     * @return static
     */
    public function setUglifyJs2Path($uglifyJs2Path)
    {
        $this->uglifyJs2Path = $uglifyJs2Path;
        return $this;
    }

    /**
     * @return string
     */
    public function getUglifyJs2Path()
    {
        return $this->uglifyJs2Path;
    }
}
