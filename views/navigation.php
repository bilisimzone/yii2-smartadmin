<?php

use yii\helpers\Url;
?>
<nav>
    <!-- 
    NOTE: Notice the gaps after each icon usage <i></i>..
    Please note that these links work a bit different than
    traditional href="" links. See documentation for details.
    -->

    <ul>
        <li>
            <a href="<?php echo Url::home() ?>" title="<?php echo Yii::t('app', 'Dashboard') ?>"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent"></span></a>
        </li>
        <li>
            <a href="#"><span class="menu-item-parent">Definitions</span></a>
            <ul>
                <li>
                    <a href="flot.html">Flot Chart</a>
                </li>
                <li>
                    <a href="morris.html">Morris Charts</a>
                </li>
                <li>
                    <a href="sparkline-charts.html">Sparklines</a>
                </li>
                <li>
                    <a href="easypie-charts.html">EasyPieCharts</a>
                </li>
                <li>
                    <a href="dygraphs.html">Dygraphs</a>
                </li>
                <li>
                    <a href="chartjs.html">Chart.js</a>
                </li>
                <li>
                    <a href="hchartable.html">HighchartTable <span class="badge pull-right inbox-badge bg-color-yellow">new</span></a>
                </li>
            </ul>
        </li>
    </ul>
</nav>


<span class="minifyme" data-action="minifyMenu"><i class="fa fa-arrow-circle-left hit"></i></span>