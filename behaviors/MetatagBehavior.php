<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 10.04.18
 * Time: 18:24
 */

namespace tina\metatag\behaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use tina\metatag\services\MetatagService;
use tina\metatag\models\Metatag;

/**
 * Class MetatagBehavior
 *
 * @package tina\metatag\behaviors
 */
class MetatagBehavior extends Behavior
{
    /**
     * @var string
     */
    public $metaAttribute;

    /**
     * @var MetatagService
     */
    protected $service;

    /**
     * MetatagBehavior constructor.
     *
     * @param MetatagService $service
     * @param array $config
     */
    public function __construct(MetatagService $service, array $config = [])
    {
        $this->service = $service;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
            ActiveRecord::EVENT_INIT => 'eventInit',
        ];
    }

    /**
     * @param Event $event
     */
    public function eventInit(Event $event)
    {
        $event->sender->{$this->metaAttribute} = new Metatag();
    }

    /**
     * @param Event $event
     */
    public function afterInsert(Event $event)
    {
        $this->service->execute(get_class($event->sender), $event->sender->id);
    }

    /**
     * @param Event $event
     */
    public function afterUpdate(Event $event)
    {
        $this->service->execute(get_class($event->sender), $event->sender->id);
    }

    /**
     * @param Event $event
     *
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function afterDelete(Event $event)
    {
        $meta = Metatag::find()->where([
            'model' => get_class($event->sender),
            'recordId' => $event->sender->id,
        ])->one();

        if ($meta instanceof Metatag) {
            $meta->delete();
        }
    }

    /**
     * @param Event $event
     */
    public function afterFind(Event $event)
    {
        $meta = Metatag::find()->where([
            'model' => get_class($event->sender),
            'recordId' => $event->sender->id,
        ])->one();

        if ($meta == null) {
            $meta = new Metatag();
        }
        $event->sender->{$this->metaAttribute} = $meta;
    }
}
