<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class='main-site'>

    <?php if (Yii::app()->user->isGuest) { ?>
        <div class='column'>
            <?php
            $this->beginWidget('bootstrap.widgets.TbBox', array(
                'title' => 'Login',
                'headerIcon' => 'icon-user',
                'htmlHeaderOptions' => array(
                    'class' => 'header-box',
                ),
                'htmlOptions' => array(
                    'style' => 'width: 500px;'
                ),
            ));
            ?>

            <?php $model = new UserGroupsUser('login'); ?>
            <?php $this->renderPartial('application.modules.userGroups.views.user.login', array('model' => $model)); ?>
            <?php $this->endWidget(); ?>

        </div>
    <?php } ?>

    <div class='column'>
        <?php
        $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => Yii::t('app', 'Contato'),
            'headerIcon' => 'icon-ok',
            'htmlHeaderOptions' => array(
                'class' => 'header-box',
            ),
            'htmlOptions' => array(
                'style' => 'width: 500px;'
            ),
        ));
        ?>
        <div class='contact'>
            <label><?php echo Yii::t('app', 'Nosso endereço é:'); ?></label>
            <span>
                <?php echo Yii::app()->params['endereco']; ?>
            </span>
            <label><?php echo Yii::t('app', 'Nosso número é:'); ?></label>
            <span>
                <?php echo Yii::app()->params['telefone']; ?>
            </span>
            <br>
            <label><?php echo Yii::t('app', 'Curta nossa página no Facebook!'); ?></label>

            <div class="fb-like" data-href="<?php echo Yii::app()->params['fbpage']; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>

<style>
    .logbg
    {
        background: 0 0 no-repeat #FFFFFF;
        height: 260px;
        margin: 0;
    }
    #userGroups-container
    {
        padding: 20px !important;
    }
    .contact label
    {
        font-weight: bold;
    }
    .contact span
    {
        display: block;
        padding-left: 20px;
        margin-bottom: 10px;
    }
</style>

