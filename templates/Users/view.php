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
            <?php if ($role == 0) { ?>
                        <?= $this->Html->link(__('Edit Car'), ['action' => 'edit', $car->id],  ['class' => 'button float-right']) ?>
                        <?= $this->Html->link(__('List Cars'), ['action' => 'index'],  ['class' => 'button float-right']) ?>
                        <?= $this->Html->link(__('New Car'), ['action' => 'add'],  ['class' => 'button float-right']) ?>
                        <?= $this->Html->link(__('Delete Car'), ['action' => 'delete', $car->id],  ['class' => 'button float-left','class' => 'button float-right','confirm' => __('Are you sure you want to delete # {0}?', $car->id)]) ?>
                    <?php } else { ?>
                        <?= $this->Html->link(__('List Cars'), ['action' => 'index'], ['class' => 'button float-right']) ?>
                    <?php } ?>
        </div> 
    </aside>
    <div class="column-responsive column-80">
        <div class="cars view content">
            <table>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= $this->Html->image(h($car->image), array('width' => '300px')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Company') ?></th>
                    <td><?= h($car->company) ?></td>
                </tr>
                <tr>
                    <th><?= __('Brand') ?></th>
                    <td><?= h($car->brand) ?></td>
                </tr>
                <tr>
                    <th><?= __('Model') ?></th>
                    <td><?= h($car->model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Make') ?></th>
                    <td><?= h($car->make) ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= h($car->color) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($car->description) ?></td>
                </tr>
            </table>
            <div class="related">

                <h4><?= __('Related Ratings') ?></h4>
                <?php
                  if ($role == 1) {
                if ($auth == true) { ?>
                    <div id="commentshow" class="ratings form content">
                        <?= $this->Form->create($rating) ?>
                        <fieldset>
                            <legend><?= __('Rate this car') ?></legend>
                            <span class="ratestars">
                                <li class="star fa-regular fa-star" value="1"></li>
                                <li class="star fa-regular fa-star" value="2"></li>
                                <li class="star fa-regular fa-star" value="3"></li>
                                <li class="star fa-regular fa-star" value="4"></li>
                                <li class="star fa-regular fa-star" value="5"></li>
                            </span>
                            <?php
                            echo $this->Form->control('star', ['type' => 'hidden', 'value' => '5', 'id' => 'starval']);
                            echo $this->Form->control('review', ['required' => false]);
                            ?>
                        </fieldset>
                        <?= $this->Form->button(__('Submit')) ?>
                        <?= $this->Form->end() ?>
                    </div>
                <?php } }?>
                <?php if (!empty($car->ratings)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Star') ?></th>
                                <th><?= __('Review') ?></th>
                                <th><?= __('Name') ?></th>
                                <th><?= __('Time') ?></th>
                            </tr>
                            <?php foreach ($ratings as $ratings) : ?>
                                <tr>
                                    <td>
                                        <span class="ratestars">
                                            <?php
                                            for ($i = 0; $i < $ratings->star; $i++) {
                                                echo '
                                                <li class="star fa-solid fa-star" value="1"></li>
                                                ';
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td><?= h($ratings->review) ?></td>
                                    <td><?= h($ratings->user_name) ?></td>
                                    <td><?= h($ratings->time) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#commenthide').click(function(e) {
            e.preventDefault();
            $(this).hide();
            $('#commentshow').show();
        });

        $('.star').click(function() {
            var stars = $(this).val()

            $(this).prevAll('li').removeClass('fa-regular');
            $(this).prevAll('li').addClass('fa-solid');
            $(this).removeClass('fa-regular');
            $(this).addClass('fa-solid');
            $(this).nextAll('li').removeClass('fa-solid');
            $(this).nextAll('li').addClass('fa-regular');

            $('#starval').val(stars)
        })
    });
</script>