<?php

namespace Tickit\CacheBundle\Engine;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Tickit\CacheBundle\Types\TaggableCacheInterface;
use Tickit\CacheBundle\Options\FileOptions;

/**
 * Caching engine for the file cache
 *
 * @author James Halsall <james.t.halsall@googlemail.com>
 */
class FileEngine extends AbstractEngine implements TaggableCacheInterface
{

    /* @var \Symfony\Component\DependencyInjection\ContainerInterface */
    protected $container;

    /**
     * Class constructor, sets dependencies
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container The dependency injection container
     * @param array                                                     $options   [Optional] An array of options for the cache
     */
    public function __construct(ContainerInterface $container, array $options = null)
    {
        $this->container = $container;
        $this->setOptions($options);
    }

    /**
     * {@inheritDoc}
     */
    public function internalWrite($id, $data)
    {
        $dir = $this->buildDirectory();

        if (!file_exists($dir)) {
            if (false === mkdir($dir, 0766, true)) {
                throw new Exception\PermissionDeniedException(
                    sprintf('Permission denied creating (%s) in %s on line %s', $dir, __CLASS__, __LINE__)
                );
            }
        }

        $writeData = $this->prepareData($data);
    }

    /**
     * {@inheritDoc}
     */
    public function internalRead($id)
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function addTags($id, array $tags)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function findByTags(array $tags, $partialMatch = false)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function removeByTags(array $tags, $partialMatch = false)
    {

    }


    /**
     * {@inheritDoc}
     */
    protected function setOptions($options)
    {
        if (!$options instanceof FileOptions) {
            $options = new FileOptions($options, $this->container);
        }

        return parent::setOptions($options);
    }

    /**
     * Builds a directory structure for the current cache based off the
     * options object
     *
     * @return string
     */
    protected function buildDirectory()
    {
        $basePath = $this->getOptions()->getCacheDir();
        $namespace = $this->getOptions()->getNamespace();
        $folders = explode('.', $namespace);

        return sprintf('%s/%s', $basePath, implode(DIRECTORY_SEPARATOR, $folders));
    }


    /**
     * Prepares a piece of data for writing to the file cache
     *
     * @param mixed $data The data to cache, if this data is an object then it will be serialized
     *                    (if auto_serialize is disabled an exception will be thrown)
     *
     * @throws \Tickit\CacheBundle\Engine\Exception\NotCacheableException
     */
    protected function prepareData($data)
    {
        $autoSerialize = $this->getOptions()->getAutoSerialize();

        if (is_object($data)) {
            if (false === $autoSerialize) {
                throw new Exception\NotCacheableException(
                    'This data cannot be cached, it is an unserialized instance of %s and Tickit cache\'s auto serialize is disabled',
                    get_class($data)
                );
            }

            //serialize
        }


    }

}