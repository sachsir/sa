<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>

<div class="column-responsive column-90">
    <div class="cars index content">
        <?= $this->Flash->render() ?>
        <!-- <?= $this->Html->link(__('Add'), ['action' => 'useradd'], ['class' => 'button float-right']) ?> -->
        <?= $this->Html->link(__('List Cars'), ['action' => 'index'], ['class' => 'button float-right']) ?>

        <h3><?= __('Users') ?></h3>
        
        <div class="table-responsive">
            <table id="myTable">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Sr No') ?></th>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th><?= $this->Paginator->sort('email') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $i //$this->Number->format($car->id) 
                                ?></td>
                            <td><?= h($user->name) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td class="actions">
                            <span class="reddelete ">
                                <?= $this->Form->postLink(__(''), ['action' => 'userdelete', $user->id], ['class' => 'font fa-solid fa-trash','confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>
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
</div>
</div>