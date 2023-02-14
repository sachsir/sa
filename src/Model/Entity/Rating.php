<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rating Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $car_id
 * @property int $star
 * @property string $review
 * @property string $user_name
 * @property \Cake\I18n\FrozenTime $time
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Car $car
 */
class Rating extends Entity
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
        'user_id' => true,
        'car_id' => true,
        'star' => true,
        'review' => true,
        'user_name' => true,
        'time' => true,
        'user' => true,
        'car' => true,
    ];
}
