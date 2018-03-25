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
 * Class TaxiServices
 *
 * @property \App\TaxiService $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class TaxiServices extends Section implements Initializable
{
    protected $model = '\App\TaxiService';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        // Добавление пункта меню и счетчика кол-ва записей в разделе
        $this->addToNavigation($priority = 500, function() {
            return \App\TaxiService::count();
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
    protected $title='Службы такси';

    /**
     * @var string
     */
    protected $alias='transport/taxi';

     /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-taxi';
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return $this->title;
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
                AdminColumn::datetime('created_at','Создано')->setWidth('150px'),
                AdminColumn::datetime('updated_at','Обновлено')->setWidth('150px'),
                AdminColumn::link('name','Название')->setWidth('200px'),
                AdminColumn::text('description','Описание'),
                AdminColumn::lists('phones','Телефоны')
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
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Название')->required(),
            AdminFormElement::textarea('description', 'Описание')->required(),
            AdminFormElement::view(
                                'admin.DynamicField',
                                ['field'=>'phones','label'=>'Номера телефонов']
                            )
                            ->setCallback(function($model,$request)
                            {
                                $phones = array_filter($request->input('phones'));
                                $model->phones=$phones;
                            })
                            // валидация не работает в элементах типа Custom https://github.com/sleeping-owl/admin/issues/189
                            //->addValidationRule('phone:RU','Неверный номер телефона')
                            //->addValidationRule('required','Поле обязательно для заполнения')
                            
        ]);
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
