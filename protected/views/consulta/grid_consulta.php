<?php echo '<link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/grid_consulta.css" />'; ?>

<?php
    $year = date('Y');
    $month = date('m');
    $month_text = date('F');
?>

<br>
<div class='pointer'>
    <a href="javascript:void(0)">
        <span class='left'>
            <i class='icon-backward icon-2x'></i>
        </span>
    </a>

    <div class='center'>
        <span><?php echo Yii::t('app', $month_text); ?></span>
    </div>

    <a href="javascript:void(0)">
        <span class='right'>
            <i class='icon-forward icon-2x'></i>
        </span>
    </a>
</div>

<div class='calendar'>
    <table>
        <thead>
            <tr>
                <th>D</th>
                <th>S</th>
                <th>T</th>
                <th>Q</th>
                <th>Q</th>
                <th>S</th>
                <th>S</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class='off'>1</td>
                <td class='off'>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
            </tr>
        </tbody>
    </table>
</div>