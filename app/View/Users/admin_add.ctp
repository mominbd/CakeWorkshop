<div class="page-header">
    <h3><?php echo __('Neuen Teilnehmer/Benutzer anlegen'); ?></h3>
</div>

<div class="alert bg-light-blue"><?php echo __('Die Benutzer müssen die "Passwort vergessen" Funktion verwenden, um ein Passwort zu erhalten'); ?></div>

<div class="well">
    <?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>

    <legend>
        <?php echo __('Benutzerdaten'); ?>
    </legend>

    <div class="control-group">
        <label class="control-label"><?php echo __('Anrede'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('gender_id', array('required' => true, 'label' => false, 'class' => 'span2')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Vorname'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('firstname', array('required' => true, 'label' => false, 'class' => 'span4')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Nachname'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('lastname', array('required' => true, 'label' => false, 'class' => 'span4')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Titel'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('title', array('label' => false, 'class' => 'span4')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Email'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('email', array('type' => 'email', 'required' => true, 'label' => false, 'class' => 'span4')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Fachbereich'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('department_id', array('showEmpty' => true, 'label' => false, 'class' => 'span4')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Beschäftigt als'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('occupation_id', array('label' => false, 'class' => 'span4')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Hrz-Id'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('hrz', array('label' => false, 'class' => 'span4')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Telefonnummer'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('phone', array('label' => false, 'class' => 'span4')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Benutzergruppe'); ?></label>

        <div class="controls">
            <?php echo $this->Form->select('group_name', $groups, array('empty' => false, 'required' => true, 'label' => false, 'class' => 'span2')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label pull-left"><?php echo __('Konto-Aktivieren'); ?></label>

        <div class="controls">
            <label class="checkbox">
                <?php echo $this->Form->checkbox('active', array('label' => false, 'class' => '')); ?>
                <span class="help-inline"><?php echo __('Wenn dieser Haken deaktiviert ist, dann kann sich der Benutzer nicht anmelden'); ?></span>
            </label>
        </div>
    </div>

    <hr/>

    <div class="form-controls">
        <button type="submit" class="btn btn-primary"><?php echo __('Speichern'); ?></button>
    </div>
    <?php echo $this->Form->end(); ?>

</div>

