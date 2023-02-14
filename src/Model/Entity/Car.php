<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Car Entity
 *
 * @property int $id
 * @property string $company
 * @property string $brand
 * @property string $model
 * @property string $make
 * @property string $color
 * @property string $description
 * @property string $image
 * @property int $active
 *
 * @property \App\Model\Entity\Rating[] $ratings
 */
class Car extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'company' => true,
        'brand' => true,
        'model' => true,
        'make' => true,
        'color' => true,
        'description' => true,
        'image' => true,
        'active' => true,
        'ratings' => true,
    ];
}
