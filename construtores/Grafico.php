<?php

/**
 * Description of graficoscontroller
 *
 * @author I.A.Gzyk
 */
class Grafico {

    function grafico_barra($valores, $titulo, $data, $id) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            backgroundColor: '#7E70C6',
                            borderColor: 'rgb(255, 99, 132)',
                            data: <?= $data ?>
                        }]
                }
            });</script>
        <?php
    }

    function carrega_grafico_barras2($valores, $titulo, $titulo2, $data, $data2, $cor1, $cor2, $id) {
        ?>
        <canvas id="<?= $id ?>"  style="max-width: 500px;"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo2 ?>',
                            borderColor: 'rgb(178,34,34)',
                            data: <?= $data2 ?>,
                            type: 'line'
                        },{
                            label: '<?= $titulo ?>',
                            backgroundColor: <?= $cor1 ?>,
                            borderColor: 'rgba(46,139,87)',
                            data: <?= $data ?>
                        }]
                }
            });</script>
        <?php
    }

    function grafico_pizza($valores, $titulo, $data, $id, $cores) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            backgroundColor: <?= $cores ?>,
                            data: <?= $data ?>
                        }]
                }
            });
        </script>
        <?php
    }

    function grafico_rosca($valores, $titulo, $data, $id) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            /*backgroundColor: ['rgb(255, 99, 132)', 'rgb(255, 199, 132)', 'rgb(55, 99, 132)'],*/
                            data: <?= $data ?>
                        }]
                },
                options: let opcoes = {
                    cutoutPercentage: 40
                }
            });
        </script>
        <?php
    }

    function grafic_linha($valores, $titulo, $data, $id, $color) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            backgroundColor: <?= $color ?>,
                            borderColor: "#2E8B57",
                            data: <?= $data ?>
                        }]
                }
            });</script>
        <?php
    }

}
