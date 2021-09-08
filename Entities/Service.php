<?php

namespace Modules\Ibooking\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

use Modules\Ibooking\Entities\Category;
use Modules\Ibooking\Entities\Resource;

//Traits
use Modules\Ischedulable\Support\Traits\Schedulable;

class Service extends CrudModel
{
  use Translatable, Schedulable;

  public $transformer = 'Modules\Ibooking\Transformers\ServiceTransformer';
  public $requestValidation = [
    'create' => 'Modules\Ibooking\Http\Requests\CreateServiceRequest',
    'update' => 'Modules\Ibooking\Http\Requests\UpdateServiceRequest',
  ];

  protected $table = 'ibooking__services';
  public $translatedAttributes = ['title', 'description', 'slug'];
  protected $casts = ['options' => 'array'];
  protected $fillable = [
    'price',
    'status',
    'withMeeting',
    'options'
  ];

  /**
   * Relation many to many with categories
   * @return mixed
   */
  public function categories()
  {
    return $this->belongsToMany(Category::class, 'ibooking__service_category');
  }

  /**
   * Relation Many to Many with resources
   * @return mixed
   */
  public function resources()
  {
    return $this->belongsToMany(Resource::class, 'ibooking__service_resource');
  }

  public function reservationItems()
  {
    return $this->hasMany(ReservationItem::class);
  }

}
