<!-- File: src/Template/Users/login.ctp -->

<div class="users form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
		
<?= $this->Form->button(__('Login')); ?>
<a href="signup" class="btn blue sign-btn fl-rt">Sign Up</a>
<?= $this->Form->end() ?>
</div>

<style>
.sign-btn {
color: #FFFFFF;
background-color: #15848F;
padding: 15px 30px;
font-size: 16px;
text-transform: uppercase;
}
.sign-btn:hover {
color: #FFFFFF;
background-color: #2386ca;
}
</style>