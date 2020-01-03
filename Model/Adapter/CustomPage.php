<?php


namespace Codilar\OpenGraph\Model\Adapter;

use Codilar\OpenGraph\Model\PropertyInterface;
use Magento\Cms\Model\Page as CmsPage;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Page\Title;
use Magento\Theme\Block\Html\Header\Logo;

/**
 * Class CustomPage
 * @package Codilar\OpenGraph\Model\Adapter
 */
class CustomPage
{
    /**
     * @var PropertyInterface
     */
    private $property;
    /**
     * @var CmsPage
     */
    private $page;
    /**
     * @var UrlInterface
     */
    private $url;
    /**
     * @var FilterProvider
     */
    private $filterProvider;
    /**
     * @var Magento\Theme\Block\Html\Header\Logo
     */
    private $logo;


    /**
     * @var Title
     */
    private $title;


    /**
     * Page constructor.
     * @param Title $title
     * @param UrlInterface $url
     * @param FilterProvider $filterProvider
     * @param PropertyInterface $property
     * @param Logo $logo
     */
    public function __construct(
        Title $title,
        UrlInterface $url,
        FilterProvider $filterProvider,
        PropertyInterface $property,
        Logo $logo
    ) {
        $this->property = $property;
        $this->url = $url;
        $this->filterProvider = $filterProvider;
        $this->logo = $logo;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title->getShortHeading();
    }

    /**
     * @return PropertyInterface
     */
    public function getProperty() : PropertyInterface
    {
        $this->property->setTitle((string) $this->getTitle());
        $this->property->setImage((string)$this->logo->getLogoSrc());
        $this->property->setUrl((string) $this->url->getCurrentUrl());
        return $this->property;
    }
}