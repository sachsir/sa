<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="column-responsive column-80">
<?= $this->Html->link(__('User Listing'), ['action' => 'usersview'], ['class' => 'button float-right']) ?>
    <div class="users form content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= __('Add User') ?></legend>
            <?php
            echo $this->Form->control('name', ['required' => 'false']);
            echo $this->Form->control('email', ['required' => 'false']);
            echo $this->Form->control('password', ['required' => 'false']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>