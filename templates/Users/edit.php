<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car $car
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $car->id],['class' => 'button float-right'],
                ['confirm' => __('Are you sure you want to delete # {0}?', $car->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Cars'), ['action' => 'index'],['class' => 'button float-right']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cars form content">
            <?= $this->Form->create($car, ["enctype" => "multipart/form-data",'id' => 'editform']) ?>
            <fieldset>
                <legend><?= __('Edit Car') ?></legend>
                <div class="row">
                    <div class="col-md-6">
                        <?= $this->Form->control('image', ['type' => 'file', 'required' => false]) ?>
                        <span class="error-message" id="file-name-error"></span>
                    </div>
                    <div class="col-md-6">
                        <td><?= $this->Html->image(h($car->image), array('width' => '250px')) ?></td>
                    </div>
                </div>
                <?php
                echo $this->Form->control('company', ['required' => false]);
                echo '<label for="brand">Brand</label>';
                echo $this->Form->select('brand', [
                    $brands[1] => $brands[1],
                    $brands[2] => $brands[2],
                    $brands[3] => $brands[3],
                ]);
                echo '<label for="model">Model</label>';
                echo $this->Form->select('model', [
                    'Lxi' => 'Lxi',
                    'Vxi' => 'Vxi',
                    'Zxi' => 'Zxi',
                ]);
                echo '<label for="make">Make</label>';
                echo $this->Form->select('make', [
                    '2015' => '2015',
                    '2016' => '2016',
                    '2017' => '2017',
                    '2018' => '2018',
                    '2019' => '2019',
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2023' => '2023',
                ]);
                echo '<label for="color">Color</label>';
                echo $this->Form->select('color', [
                    'Red' => 'Red',
                    'Black' => 'Black',
                    'White' => 'White',
                ]);
                echo $this->Form->control('description', ['required' => false, 'type' => 'textarea']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>