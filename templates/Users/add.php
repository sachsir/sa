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
            <?= $this->Html->link(__('List Cars'), ['action' => 'index'],  ['class' => 'button float-right']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="cars form content">
            <?= $this->Form->create($car, ["enctype" => "multipart/form-data",['id'=>"addform"]]) ?>
            <fieldset>
                <legend><?= __('Add Car') ?></legend>
                <?php
                echo $this->Form->control('image', ['required' => false, 'type' => 'file']);
                echo $this->Form->control('company', ['required' => false]);
                echo '<label for="brand">Brand</label>';
                echo $this->Form->select('brand', [
                    $brands[1] => $brands[1],
                    $brands[2] => $brands[2],
                    $brands[3] => $brands[3],
                ],              
                  ['empty'=>'select car'], 
            );
                echo '<label for="model">Model</label>';
                echo $this->Form->select('model', [
                    'Lxi' => 'Lxi',
                    'Vxi' => 'Vxi',
                    'Zxi' => 'Zxi',
                ],
                ['empty'=>'select Model'], 
            );
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
                ],
                ['empty'=>'select Date'], 
            );
                echo '<label for="color">Color</label>';
                echo $this->Form->select('color', [
                    'Red' => 'Red',
                    'Black' => 'Black',
                    'White' => 'White',
                ],
                ['empty'=>'select Color'], 
            );
                echo $this->Form->control('description', ['required' => false, 'type' => 'textarea']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>