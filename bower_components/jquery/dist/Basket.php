<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Basket Entity
 *
 * @property int $benefit_id
 * @property int $sale_id
 * @property int $price
 * @property int $qte
 *
 * @property \App\Model\Entity\Benefit $benefit
 * @property \App\Model\Entity\Sale $sale
 */
class Basket extends Entity
{

}
