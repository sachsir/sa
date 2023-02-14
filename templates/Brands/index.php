<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Brand> $brands
 */
?>
<div class="brands index content">
    <?= $this->Html->link(__('New Brand'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Brands') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($brands as $brand): ?>
                <tr>
                    <td><?= $this->Number->format($brand->id) ?></td>
                    <td><?= $brand->has('user') ? $this->Html->link($brand->user->name, ['controller' => 'Users', 'action' => 'view', $brand->user->id]) : '' ?></td>
                    <td><?= h($brand->name) ?></td>
                    <td><?= $this->Number->format($brand->status) ?></td>
                    <td><?= h($brand->created_at) ?></td>
                    <td><?= h($brand->modified_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $brand->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $brand->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $brand->id], ['confirm' => __('Are you sure you want to delete # {0}?', $brand->id)]) ?>
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
