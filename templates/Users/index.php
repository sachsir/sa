<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Car> $cars
 */
?>
<div class="cars index content">
    
<?php
 foreach ($users as $user) : ?>
<h1><?= h("Hello $user->name") ?></h1>                            
<?php
endforeach; ?>   
     <?= $this->Html->link(__('Add'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('User View'), ['action' => 'usersview'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('Rating Car View'), ['action' => 'ratingview'], ['class' => 'button float-right']) ?>

    <h3><?= __('Cars') ?></h3>
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <?= $this->Form->control('key', ['label' => 'Search', 'value' => $this->request->getQuery('key')]) ?>
    <!-- <?= $this->Form->submit() ?> -->
    <?= $this->Form->end() ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('company') ?></th>
                    <th><?= $this->Paginator->sort('brand') ?></th>
                    <th><?= $this->Paginator->sort('model') ?></th>
                    <th><?= $this->Paginator->sort('make') ?></th>
                    <th><?= $this->Paginator->sort('color') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>
                    <th><?= $this->Paginator->sort('rating') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car) : ?>
                    <tr>
                        <td><?= $this->Number->format($car->id) ?></td>
                        <td><?= h($car->company) ?></td>
                        <td><?= h($car->brand) ?></td>
                        <td><?= h($car->model) ?></td>
                        <td><?= h($car->make) ?></td>
                        <td><?= h($car->color) ?></td>
                        <td><?= $this->Html->image(h($car->image), array('width' => '70px')) ?></td>
                        <td>
                            <span class="overallratestar" style="color:orangered">
                                <?php
                                if (!empty($car->ratings)) {
                                    $sum = 0;
                                    $count = 0;
                                    foreach ($car->ratings as $rating) {
                                        $sum += $rating['star'];
                                        $count++;
                                    }
                                    $overallstar = $sum / $count;
                                    for ($i = 1; $i <= $overallstar; $i++) {
                                        echo '<li class="fa-solid fa-star" value="1"></li>';
                                    }
                                    if ($overallstar > $i - 1 && $overallstar < 5) {
                                        echo '<li class="fa-solid fa-star-half-stroke"></li>';
                                        $i++;
                                    }
                                    for ($j = $i; $j < 6; $j++) {
                                        echo '<li class="fa-regular fa-star" value="1"></li>';
                                    }
                                } else {
                                    echo 'No reviews';
                                }
                                ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($car->active == 1) : ?>
                                <?= $this->Form->postLink(__('Inactive'), ['action' => 'userStatus', $car->id, $car->active], ['confirm' => __('Are you sure you want to Inactive # {0}?', $car->id)]) ?>
                            <?php else : ?>
                                <?= $this->Form->postLink(__('Active'), ['action' => 'userStatus', $car->id, $car->active], ['confirm' => __('Are you sure you want to active # {0}?', $car->id)]) ?>
                            <?php endif; ?>
                        </td>
                        <td class="actions txtcenter">
                                        <span class="view">
                                            <?= $this->Html->link(__(''), ['action' => 'view', $car->id], ['class' => 'font fa-solid fa-eye']) ?>
                                        </span>
                                        <span class="edit">
                                            <?= $this->Html->link(__(''), ['action' => 'edit', $car->id], ['class' => 'font fa-solid fa-pen-to-square']) ?>
                                        </span>
                                        <span class="delete ">
                                            <?= $this->Form->postLink(__(''), ['action' => 'delete', $car->id], ['class' => 'font fa-solid fa-trash', 'confirm' => __('Are you sure you want to delete # {0}?', $car->id)]) ?>
                                        </span>
                                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>