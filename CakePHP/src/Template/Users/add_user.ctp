<!-- src/Template/Users/registration.ctp -->

<div class="users form">
<?= $this->Form->create($user) ?>
<?= $this->Flash->render() ?> 
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
		<?= $this->Form->control('email') ?>
		<?= $this->Form->control('phone') ?>  	
        <?= $this->Form->control('role', [
            'options' => ['admin' => 'Admin', 'user' => 'User']
        ]) ?>
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?php echo $this->Html->link('User List','/userlist' ,['class' => 'btn red bck-btn fl-rt']);?>
<?= $this->Form->end() ?>
</div>

