<?php

namespace App\Http\Sections;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;


/**
 * Class Organisation
 *
 * @property \App\Organisation $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Organisation extends Section implements Initializable
{
    
    protected $model = '\App\Organisation';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        // Добавление пункта меню и счетчика кол-ва записей в разделе
        $this->addToNavigation($priority = 500, function() {
            return \App\Organisation::count();
        });

        $this->creating(function($config, \Illuminate\Database\Eloquent\Model $model) {
            //...
        });
    }

    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title='Организации';

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @var string
     */
    protected $alias='buisiness';

     /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-sitemap';
    }
    
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            -> setHtmlAttribute('class','table-primaty')
            -> setColumns(
                AdminColumn::text('id','#')->setWidth('30px'),
                AdminColumn::link('name','Название')->setWidth('200px'),
                AdminColumn::text('description','Описание'),
                AdminColumn::lists('categories.name','Категории')
                //AdminColumn::lists('phones.phone','Телефоны')
            )
            ->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Название')->required(),
            AdminFormElement::textarea('description', 'Описание')->required()
        ]);
        
/*        if(!is_null($id)){
            $contacts = AdminDisplay::table()
                ->with('contacts')
                ->setModelClass(\App\Contact::class)
                ->setColumns(
                    AdminColumn::text('name','Контакт')
                );
            $form->addBody($contacts);
        };
 */
        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // todo: remove if unused
    }
}
