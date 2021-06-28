<?php


namespace App\Listener;


use App\Entity\Produit;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{
    /*
     * @var CacheManager
     */
    private $cacheManager;
    /*
     * @var u ploaderHelper
     */

    private $uploaderHelper;

    /**
     * ImageCacheSubscriber constructor.
     * @param $cacheManager
     * @param $uploaderHelper
     */
    public function __construct(cacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }


    public function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            'preRemove',
            'preUpdate'

        ];
    }

    public function preRemove(LifecycleEventArgs $args): void
    {
        $entity=$args->getEntity();
        if (! $entity instanceof Produit)
        {
            return;
        }
        else
        {
            if($entity->getImageFile() instanceof UploadedFile)
                $this->cacheManager->remove($this->uploaderHelper->asset($entity,'imageFile'));

        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
    $entity=$args->getEntity();
    if (! $entity instanceof Produit)
    {
        return;
    }
    else
    {
       if($entity->getImageFile() instanceof UploadedFile)
        $this->cacheManager->remove($this->uploaderHelper->asset($entity,'imageFile'));

    }
    }


}
