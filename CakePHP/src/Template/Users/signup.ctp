	<!-- src/Template/Users/add.ctp -->

<div class="users form">
<?= $this->Flash->render() ?> 
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Registration') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
		<?= $this->Form->control('email') ?>
		<?= $this->Form->control('phone') ?>  			
		<?= $this->Form->control('role', ['type' => 'hidden','value'=>'user']);	?>	
   </fieldset>
  
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div> 
<div class="already-login">
<h4>Already registered user ! <a href="login"> Please Login</a> </h4>
</a>