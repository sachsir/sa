<div class="container">
    <div class="cars index content">
        <h3><?= __('Cars  ') ?></h3>
        <?= $this->Form->create(null, ['type' => 'get']) ?>
    <?= $this->Form->control('key', ['label' => 'Search', 'value' => $this->request->getQuery('key')]) ?>
    <!-- <?= $this->Form->submit() ?> -->
    <?= $this->Form->end() ?>
        <div class="table-responsive">
            <div class="container">
                <?php foreach ($cars as $car) : ?>
                    <div class="row">
                        <div class="container float-left">
                            <table>
                                <tr>
                                    <td><?= $this->Html->image(h($car->image), array('width' => '400px')) ?></td>
                                </tr>
                                <tr>
                                    <td><?= $this->Html->link(__('View'), ['action' => 'view', $car->id]) ?></td>
                                </tr>
                            </table>

                        </div>
                        <div class="container float-right  homebackgroud">
                            <table>
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
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
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