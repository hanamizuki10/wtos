<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = false;

$cakeDescription = '和暦To西暦';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('home.css') ?>
    <?= $this->Html->script( 'jquery/jquery-3.3.1.min.js' ) ?>
    <?= $this->Html->script( 'home.js' ) ?>

</head>
<body class="home">

<header class="row">
    <div class="header-title">
        <?= $cakeDescription ?>
    </div>
</header>
<?= $this->Flash->render() ?>


<div class="to-seireki-input">
    <?= $this->Form->create($formEntity, ['url' => ['controller' => 'to-seirekis', 'action' => 'index'], 'type' => 'get']) ?>
    <div class="warekiradio-input-wrapper">
    <?php
        //pr($formEntity);
        echo $this->Form->radio( 'gengou',$gengou_radio_options,['hiddenField' => false]);
    ?>
    </div>
    <div class="yeartext-input-wrapper">
    <?php
        echo $this->Form->control('year', ['label'=>false,'type' => 'number']);
    ?>
    </div>

    <?= $this->Form->button(__('変換')) ?>
    <?= $this->Form->end() ?>
</div>

<?php if(isset($seireki_year)) :?>
    <div class="row wareki-to-seireki-results">

        <div class="wareki">
            <div class="center">
                <span><?=h($wareki_gengou) ?></span>
                <h1><?=h($wareki_year) ?>年</h1>
            </div>
        </div>
        <div class="to">
            <div class="center">→</div>
        </div>
        <div class="seireki">
            <div class="center">
                <span>西暦</span>
                <h1><?=h($seireki_year) ?>年</h1>
            </div>
        </div>
    </div>
<?php endif; ?>
</body>
</html>
