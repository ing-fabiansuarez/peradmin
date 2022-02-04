<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Cotizador<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>
<?= $this->section('menu-cotizador') ?>menu-open<?= $this->endSection() ?>
<?= $this->section('active-cotizador') ?>active<?= $this->endSection() ?>
<?= $this->section('active-cotizador-promotion') ?>active<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= $this->endSection() ?>
<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->
<?= $this->section('content') ?>
<div class="container-fluid">
    <?php
    if (isset($_POST['crud'])) {
        if ($_POST['crud'] == 'set') {
            if ($_POST['pijamas'] == '') {
                $pijamas = 0;
                $valorpijamas = 0;
            } else {
                $pijamas = $_POST['pijamas'];
            }
            if ($_POST['cantidadtapabocas'] == '' || $_POST['valortotaltapabocas'] == '' || $_POST['cantidadtapabocas'] == 0 || $_POST['valortotaltapabocas'] == 0) {
                $totaltapabocas = 0;
                $cantidadtapabocas = 0;
            } else if ($_POST['cantidadtapabocas'] != '' && $_POST['valortotaltapabocas'] != '') {
                $totaltapabocas = $_POST['valortotaltapabocas'];
                $cantidadtapabocas = $_POST['cantidadtapabocas'];
            }
            if ($_POST['clasicas'] == '') {
                $clasicas = 0;
                $valorclasicas = 0;
            } else {
                $clasicas = $_POST['clasicas'];
            }
            if ($_POST['plataformas'] == '') {
                $plataformas = 0;
                $valorplataformas = 0;
            } else {
                $plataformas = $_POST['plataformas'];
            }
            if ($_POST['perablack'] == '') {
                $perablack = 0;
                $valorperablack = 0;
            } else {
                $perablack = $_POST['perablack'];
            }
            if ($_POST['clasicaspiedrita'] == '') {
                $clasicaspiedrita = 0;
                $valorclasicaspiedrita = 0;
            } else {
                $clasicaspiedrita = $_POST['clasicaspiedrita'];
            }
            if ($_POST['plataformaspiedrita'] == '') {
                $plataformaspiedrita = 0;
                $valorplataformaspiedrita = 0;
            } else {
                $plataformaspiedrita = $_POST['plataformaspiedrita'];
            }
            if ($_POST['clasicasestrellita'] == '') {
                $clasicasestrellita = 0;
                $valorclasicasestrellita = 0;
            } else {
                $clasicasestrellita = $_POST['clasicasestrellita'];
            }
            if ($_POST['plataformasestrellita'] == '') {
                $plataformasestrellita = 0;
                $valorplataformasestrellita = 0;
            } else {
                $plataformasestrellita = $_POST['plataformasestrellita'];
            }
            $alpargatas = $clasicas + $plataformas + $clasicaspiedrita + $plataformaspiedrita + $clasicasestrellita + $plataformasestrellita + $perablack;
            if ($_POST['sisa'] == '') {
                $sisa = 0;
                $valorsisa = 0;
            } else {
                $sisa = $_POST['sisa'];
            }
            if ($_POST['larga'] == '') {
                $larga = 0;
                $valorlarga = 0;
            } else {
                $larga = $_POST['larga'];
            }
            if ($_POST['cuellotortuga'] == '') {
                $cuellotortuga = 0;
                $valorcuellotortuga = 0;
            } else {
                $cuellotortuga = $_POST['cuellotortuga'];
            }
            if ($_POST['pantalonetas'] == '') {
                $pantalonetas = 0;
                $valorpantalonetas = 0;
            } else {
                $pantalonetas = $_POST['pantalonetas'];
            }
            if ($_POST['buso'] == '') {
                $buso = 0;
                $valorbuso = 0;
            } else {
                $buso = $_POST['buso'];
            }
            if ($_POST['camisetas'] == '') {
                $camisetas = 0;
                $valorcamisetas = 0;
            } else {
                $camisetas = $_POST['camisetas'];
            }
            if ($_POST['camisetasninos'] == '') {
                $camisetasninos = 0;
                $valorcamisetasninos = 0;
            } else {
                $camisetasninos = $_POST['camisetasninos'];
            }
            if ($_POST['leggings'] == '') {
                $leggings = 0;
                $valorleggings = 0;
            } else {
                $leggings = $_POST['leggings'];
            }
            if ($_POST['leggingscuerina'] == '') {
                $leggingscuerina = 0;
                $valorleggingscuerina = 0;
            } else {
                $leggingscuerina = $_POST['leggingscuerina'];
            }
            if ($_POST['bicicleterocuerina'] == '') {
                $bicicleterocuerina = 0;
                $valorbicicleterocuerina = 0;
            } else {
                $bicicleterocuerina = $_POST['bicicleterocuerina'];
            }
            if ($_POST['faldacuerina'] == '') {
                $faldacuerina = 0;
                $valorfaldacuerina = 0;
            } else {
                $faldacuerina = $_POST['faldacuerina'];
            }
            if ($_POST['leggingsninho'] == '') {
                $leggingsninho = 0;
                $valorleggingsninho = 0;
            } else {
                $leggingsninho = $_POST['leggingsninho'];
            }
            if ($_POST['jeans'] == '') {
                $jeans = 0;
                $valorjeans = 0;
            } else {
                $jeans = $_POST['jeans'];
            }
            if ($_POST['bikini'] == '') {
                $bikini = 0;
                $valorbikini = 0;
            } else {
                $bikini = $_POST['bikini'];
            }
            $ropa = $sisa + $larga + $cuellotortuga + $pantalonetas + $buso  + $camisetas + $camisetasninos + $leggingscuerina + $bicicleterocuerina + $faldacuerina + $leggings + $leggingsninho + $jeans + $bikini + $pijamas;
            if ($_POST['mediasm'] == '') {
                $mediasm = 0;
                $valormediasm = 0;
            } else {
                $mediasm = $_POST['mediasm'];
            }
            if ($_POST['mediash'] == '') {
                $mediash = 0;
                $valormediash = 0;
            } else {
                $mediash = $_POST['mediash'];
            }
            $medias = $mediasm + $mediash;
            if ($_POST['rizos'] == '') {
                $rizos = 0;
                $valorrizos = 0;
            } else {
                $rizos = $_POST['rizos'];
            }
            if ($_POST['flete'] == '') {
                $flete = 0;
            } else {
                $flete = $_POST['flete'];
            }
            if ($_POST['plantillas'] == '' or $_POST['plantillas'] == 0) {
                $plantillas = 0;
                $valorplantillas = 0;
            } else {
                $plantillas = $_POST['plantillas'];
            }
            $allproductspera = $alpargatas + $ropa;
            if ($allproductspera >= 100) {
                if ($_POST['clasicas'] == '' or $_POST['clasicas'] == 0) {
                    $clasicas = 0;
                    $valorclasicas = 0;
                } else {
                    $clasicas = $_POST['clasicas'];
                    if (empty($_POST['radioclasicas'])) {
                        $valorclasicas = 40000;
                    } else {
                        $valorclasicas = $_POST['valorclasicas'];
                    }
                }
                $totalclasicas = $clasicas * $valorclasicas;
                if ($_POST['plataformas'] == '' or $_POST['plataformas'] == 0) {
                    $plataformas = 0;
                    $valorplataformas = 0;
                } else {
                    $plataformas = $_POST['plataformas'];
                    if (empty($_POST['radioplataformas'])) {
                        $valorplataformas = 46000;
                    } else {
                        $valorplataformas = $_POST['valorplataformas'];
                    }
                }
                $totalplataformas = $plataformas * $valorplataformas;
                if ($_POST['perablack'] == '' or $_POST['perablack'] == 0) {
                    $perablack = 0;
                    $valorperablack = 0;
                } else {
                    $perablack = $_POST['perablack'];
                    if (empty($_POST['radioperablack'])) {
                        $valorperablack = 46000;
                    } else {
                        $valorperablack = $_POST['valorperablack'];
                    }
                }
                $totalperablack = $perablack * $valorperablack;
                if ($_POST['clasicaspiedrita'] == '' or $_POST['clasicaspiedrita'] == 0) {
                    $clasicaspiedrita = 0;
                    $valorclasicaspiedrita = 0;
                } else {
                    $clasicaspiedrita = $_POST['clasicaspiedrita'];
                    if (empty($_POST['radioclasicaspiedrita'])) {
                        $valorclasicaspiedrita = 45000;
                    } else {
                        $valorclasicaspiedrita = $_POST['valorclasicaspiedrita'];
                    }
                }
                $totalclasicaspiedrita = $clasicaspiedrita * $valorclasicaspiedrita;
                if ($_POST['plataformaspiedrita'] == '' or $_POST['plataformaspiedrita'] == 0) {
                    $plataformaspiedrita = 0;
                    $valorplataformaspiedrita = 0;
                } else {
                    $plataformaspiedrita = $_POST['plataformaspiedrita'];
                    if (empty($_POST['radioplataformaspiedrita'])) {
                        $valorplataformaspiedrita = 53000;
                    } else {
                        $valorplataformaspiedrita = $_POST['valorplataformaspiedrita'];
                    }
                }
                $totalplataformaspiedrita = $plataformaspiedrita * $valorplataformaspiedrita;
                if ($_POST['clasicasestrellita'] == '' or $_POST['clasicasestrellita'] == 0) {
                    $clasicasestrellita = 0;
                    $valorclasicasestrellita = 0;
                } else {
                    $clasicasestrellita = $_POST['clasicasestrellita'];
                    if (empty($_POST['radioclasicasestrellita'])) {
                        $valorclasicasestrellita = 45000;
                    } else {
                        $valorclasicasestrellita = $_POST['valorclasicasestrellita'];
                    }
                }
                $totalclasicasestrellita = $clasicasestrellita * $valorclasicasestrellita;
                if ($_POST['plataformasestrellita'] == '' or $_POST['plataformasestrellita'] == 0) {
                    $plataformasestrellita = 0;
                    $valorplataformasestrellita = 0;
                } else {
                    $plataformasestrellita = $_POST['plataformasestrellita'];
                    if (empty($_POST['radioplataformasestrellita'])) {
                        $valorplataformasestrellita = 53000;
                    } else {
                        $valorplataformasestrellita = $_POST['valorplataformasestrellita'];
                    }
                }
                $totalplataformasestrellita = $plataformasestrellita * $valorplataformasestrellita;
                if ($_POST['pijamas'] == '' or $_POST['pijamas'] == 0) {
                    $pijamas = 0;
                    $valorpijamas = 0;
                } else {
                    $pijamas = $_POST['pijamas'];
                    if (empty($_POST['radiopijamas'])) {
                        $valorpijamas = 30000;
                    } else {
                        $valorpijamas = $_POST['valorpijamas'];
                    }
                }
                $totalpijamas = $pijamas * $valorpijamas;
                if ($_POST['sisa'] == '' or $_POST['sisa'] == 0) {
                    $sisa = 0;
                    $valorsisa = 0;
                } else {
                    $sisa = $_POST['sisa'];
                    if (empty($_POST['radiosisa'])) {
                        $valorsisa = 37000;
                    } else {
                        $valorsisa = $_POST['valorsisa'];
                    }
                }
                $totalsisa = $sisa * $valorsisa;
                if ($_POST['larga'] == '' or $_POST['larga'] == 0) {
                    $larga = 0;
                    $valorlarga = 0;
                } else {
                    $larga = $_POST['larga'];
                    if (empty($_POST['radiolarga'])) {
                        $valorlarga = 48000;
                    } else {
                        $valorlarga = $_POST['valorlarga'];
                    }
                }
                $totallarga = $larga * $valorlarga;
                if ($_POST['cuellotortuga'] == '' or $_POST['cuellotortuga'] == 0) {
                    $cuellotortuga = 0;
                    $valorcuellotortuga = 0;
                } else {
                    $cuellotortuga = $_POST['cuellotortuga'];
                    if (empty($_POST['radiocuellotortuga'])) {
                        $valorcuellotortuga = 48000;
                    } else {
                        $valorcuellotortuga = $_POST['valorcuellotortuga'];
                    }
                }
                $totalcuellotortuga = $cuellotortuga * $valorcuellotortuga;
                if ($_POST['pantalonetas'] == '' or $_POST['pantalonetas'] == 0) {
                    $pantalonetas = 0;
                    $valorpantalonetas = 0;
                } else {
                    $pantalonetas = $_POST['pantalonetas'];
                    if (empty($_POST['radiopantalonetas'])) {
                        $valorpantalonetas = 48000;
                    } else {
                        $valorpantalonetas = $_POST['valorpantalonetas'];
                    }
                }
                $totalpantalonetas = $pantalonetas * $valorpantalonetas;
                if ($_POST['buso'] == '' or $_POST['buso'] == 0) {
                    $buso = 0;
                    $valorbuso = 0;
                } else {
                    $buso = $_POST['buso'];
                    if (empty($_POST['radiobuso'])) {
                        $valorbuso = 36000;
                    } else {
                        $valorbuso = $_POST['valorbuso'];
                    }
                }
                $totalbuso = $buso * $valorbuso;
                if ($_POST['enterizos'] == '' or $_POST['enterizos'] == 0) {
                    $enterizos = 0;
                    $valorenterizos = 0;
                } else {
                    $enterizos = $_POST['enterizos'];
                    if (empty($_POST['radioenterizos'])) {
                        $valorenterizos = 51000;
                    } else {
                        $valorenterizos = $_POST['valorenterizos'];
                    }
                }
                $totalenterizos = $enterizos * $valorenterizos;
                if ($_POST['camisetas'] == '' or $_POST['camisetas'] == 0) {
                    $camisetas = 0;
                    $valorcamisetas = 0;
                } else {
                    $camisetas = $_POST['camisetas'];
                    if (empty($_POST['radiocamisetas'])) {
                        $valorcamisetas = 31000;
                    } else {
                        $valorcamisetas = $_POST['valorcamisetas'];
                    }
                }
                $totalcamisetas = $camisetas * $valorcamisetas;
                if ($_POST['camisetasninos'] == '' or $_POST['camisetasninos'] == 0) {
                    $camisetasninos = 0;
                    $valorcamisetasninos = 0;
                } else {
                    $camisetasninos = $_POST['camisetasninos'];
                    if (empty($_POST['radiocamisetasninos'])) {
                        $valorcamisetasninos = 30000;
                    } else {
                        $valorcamisetasninos = $_POST['valorcamisetasninos'];
                    }
                }
                $totalcamisetasninos = $camisetasninos * $valorcamisetasninos;
                if ($_POST['leggings'] == '' or $_POST['leggings'] == 0) {
                    $leggings = 0;
                    $valorleggings = 0;
                } else {
                    $leggings = $_POST['leggings'];
                    if (empty($_POST['radioleggings'])) {
                        $valorleggings = 46000;
                    } else {
                        $valorleggings = $_POST['valorleggings'];
                    }
                }
                $totalleggings = $leggings * $valorleggings;
                if ($_POST['leggingscuerina'] == '' or $_POST['leggingscuerina'] == 0) {
                    $leggingscuerina = 0;
                    $valorleggingscuerina = 0;
                } else {
                    $leggingscuerina = $_POST['leggingscuerina'];
                    if (empty($_POST['radioleggingscuerina'])) {
                        $valorleggingscuerina = 46000;
                    } else {
                        $valorleggingscuerina = $_POST['valorleggingscuerina'];
                    }
                }
                $totalleggingscuerina = $leggingscuerina * $valorleggingscuerina;
                if ($_POST['bicicleterocuerina'] == '' or $_POST['bicicleterocuerina'] == 0) {
                    $bicicleterocuerina = 0;
                    $valorbicicleterocuerina = 0;
                } else {
                    $bicicleterocuerina = $_POST['bicicleterocuerina'];
                    if (empty($_POST['radiobicicleterocuerina'])) {
                        $valorbicicleterocuerina = 40000;
                    } else {
                        $valorbicicleterocuerina = $_POST['valorbicicleterocuerina'];
                    }
                }
                $totalbicicleterocuerina = $bicicleterocuerina * $valorbicicleterocuerina;
                if ($_POST['faldacuerina'] == '' or $_POST['faldacuerina'] == 0) {
                    $faldacuerina = 0;
                    $valorfaldacuerina = 0;
                } else {
                    $faldacuerina = $_POST['faldacuerina'];
                    if (empty($_POST['radiofaldacuerina'])) {
                        $valorfaldacuerina = 40000;
                    } else {
                        $valorfaldacuerina = $_POST['valorfaldacuerina'];
                    }
                }
                $totalfaldacuerina = $faldacuerina * $valorfaldacuerina;
                if ($_POST['leggingsninho'] == '' or $_POST['leggingsninho'] == 0) {
                    $leggingsninho = 0;
                    $valorleggingsninho = 0;
                } else {
                    $leggingsninho = $_POST['leggingsninho'];
                    if (empty($_POST['radioleggingsninho'])) {
                        $valorleggingsninho = 37000;
                    } else {
                        $valorleggingsninho = $_POST['valorleggingsninho'];
                    }
                }
                $totalleggingsninho = $leggingsninho * $valorleggingsninho;
                if ($_POST['jeans'] == '' or $_POST['jeans'] == 0) {
                    $jeans = 0;
                    $valorjeans = 0;
                } else {
                    $jeans = $_POST['jeans'];
                    if (empty($_POST['radiojeans'])) {
                        $valorjeans = 46000;
                    } else {
                        $valorjeans = $_POST['valorjeans'];
                    }
                }
                $totaljeans = $jeans * $valorjeans;
                if ($_POST['bikini'] == '' or $_POST['bikini'] == 0) {
                    $bikini = 0;
                    $valorbikini = 0;
                } else {
                    $bikini = $_POST['bikini'];
                    if (empty($_POST['radiobikini'])) {
                        $valorbikini = 45000;
                    } else {
                        $valorbikini = $_POST['valorbikini'];
                    }
                }
                $totalbikini = $bikini * $valorbikini;
            } elseif ($allproductspera >= 12 and $allproductspera < 100) {
                if ($_POST['clasicas'] == '' or $_POST['clasicas'] == 0) {
                    $clasicas = 0;
                    $valorclasicas = 0;
                } else {
                    $clasicas = $_POST['clasicas'];
                    if (empty($_POST['radioclasicas'])) {
                        $valorclasicas = 44000;
                    } else {
                        $valorclasicas = $_POST['valorclasicas'];
                    }
                }
                $totalclasicas = $clasicas * $valorclasicas;
                if ($_POST['plataformas'] == '' or $_POST['plataformas'] == 0) {
                    $plataformas = 0;
                    $valorplataformas = 0;
                } else {
                    $plataformas = $_POST['plataformas'];
                    if (empty($_POST['radioplataformas'])) {
                        $valorplataformas = 50000;
                    } else {
                        $valorplataformas = $_POST['valorplataformas'];
                    }
                }
                $totalplataformas = $plataformas * $valorplataformas;
                if ($_POST['perablack'] == '' or $_POST['perablack'] == 0) {
                    $perablack = 0;
                    $valorperablack = 0;
                } else {
                    $perablack = $_POST['perablack'];
                    if (empty($_POST['radioperablack'])) {
                        $valorperablack = 50000;
                    } else {
                        $valorperablack = $_POST['valorperablack'];
                    }
                }
                $totalperablack = $perablack * $valorperablack;
                if ($_POST['clasicaspiedrita'] == '' or $_POST['clasicaspiedrita'] == 0) {
                    $clasicaspiedrita = 0;
                    $valorclasicaspiedrita = 0;
                } else {
                    $clasicaspiedrita = $_POST['clasicaspiedrita'];
                    if (empty($_POST['radioclasicaspiedrita'])) {
                        $valorclasicaspiedrita = 49000;
                    } else {
                        $valorclasicaspiedrita = $_POST['valorclasicaspiedrita'];
                    }
                }
                $totalclasicaspiedrita = $clasicaspiedrita * $valorclasicaspiedrita;
                if ($_POST['plataformaspiedrita'] == '' or $_POST['plataformaspiedrita'] == 0) {
                    $plataformaspiedrita = 0;
                    $valorplataformaspiedrita = 0;
                } else {
                    $plataformaspiedrita = $_POST['plataformaspiedrita'];
                    if (empty($_POST['radioplataformaspiedrita'])) {
                        $valorplataformaspiedrita = 57000;
                    } else {
                        $valorplataformaspiedrita = $_POST['valorplataformaspiedrita'];
                    }
                }
                $totalplataformaspiedrita = $plataformaspiedrita * $valorplataformaspiedrita;
                if ($_POST['clasicasestrellita'] == '' or $_POST['clasicasestrellita'] == 0) {
                    $clasicasestrellita = 0;
                    $valorclasicasestrellita = 0;
                } else {
                    $clasicasestrellita = $_POST['clasicasestrellita'];
                    if (empty($_POST['radioclasicasestrellita'])) {
                        $valorclasicasestrellita = 49000;
                    } else {
                        $valorclasicasestrellita = $_POST['valorclasicasestrellita'];
                    }
                }
                $totalclasicasestrellita = $clasicasestrellita * $valorclasicasestrellita;
                if ($_POST['plataformasestrellita'] == '' or $_POST['plataformasestrellita'] == 0) {
                    $plataformasestrellita = 0;
                    $valorplataformasestrellita = 0;
                } else {
                    $plataformasestrellita = $_POST['plataformasestrellita'];
                    if (empty($_POST['radioplataformasestrellita'])) {
                        $valorplataformasestrellita = 57000;
                    } else {
                        $valorplataformasestrellita = $_POST['valorplataformasestrellita'];
                    }
                }
                $totalplataformasestrellita = $plataformasestrellita * $valorplataformasestrellita;
                if ($_POST['pijamas'] == '' or $_POST['pijamas'] == 0) {
                    $pijamas = 0;
                    $valorpijamas = 0;
                } else {
                    $pijamas = $_POST['pijamas'];
                    if (empty($_POST['radiopijamas'])) {
                        $valorpijamas = 32000;
                    } else {
                        $valorpijamas = $_POST['valorpijamas'];
                    }
                }
                $totalpijamas = $pijamas * $valorpijamas;
                if ($_POST['sisa'] == '' or $_POST['sisa'] == 0) {
                    $sisa = 0;
                    $valorsisa = 0;
                } else {
                    $sisa = $_POST['sisa'];
                    if (empty($_POST['radiosisa'])) {
                        $valorsisa = 39000;
                    } else {
                        $valorsisa = $_POST['valorsisa'];
                    }
                }
                $totalsisa = $sisa * $valorsisa;
                if ($_POST['larga'] == '' or $_POST['larga'] == 0) {
                    $larga = 0;
                    $valorlarga = 0;
                } else {
                    $larga = $_POST['larga'];
                    if (empty($_POST['radiolarga'])) {
                        $valorlarga = 50000;
                    } else {
                        $valorlarga = $_POST['valorlarga'];
                    }
                }
                $totallarga = $larga * $valorlarga;
                if ($_POST['cuellotortuga'] == '' or $_POST['cuellotortuga'] == 0) {
                    $cuellotortuga = 0;
                    $valorcuellotortuga = 0;
                } else {
                    $cuellotortuga = $_POST['cuellotortuga'];
                    if (empty($_POST['radiocuellotortuga'])) {
                        $valorcuellotortuga = 50000;
                    } else {
                        $valorcuellotortuga = $_POST['valorcuellotortuga'];
                    }
                }
                $totalcuellotortuga = $cuellotortuga * $valorcuellotortuga;
                if ($_POST['pantalonetas'] == '' or $_POST['pantalonetas'] == 0) {
                    $pantalonetas = 0;
                    $valorpantalonetas = 0;
                } else {
                    $pantalonetas = $_POST['pantalonetas'];
                    if (empty($_POST['radiopantalonetas'])) {
                        $valorpantalonetas = 50000;
                    } else {
                        $valorpantalonetas = $_POST['valorpantalonetas'];
                    }
                }
                $totalpantalonetas = $pantalonetas * $valorpantalonetas;
                if ($_POST['buso'] == '' or $_POST['buso'] == 0) {
                    $buso = 0;
                    $valorbuso = 0;
                } else {
                    $buso = $_POST['buso'];
                    if (empty($_POST['radiobuso'])) {
                        $valorbuso = 38000;
                    } else {
                        $valorbuso = $_POST['valorbuso'];
                    }
                }
                $totalbuso = $buso * $valorbuso;
                if ($_POST['camisetas'] == '' or $_POST['camisetas'] == 0) {
                    $camisetas = 0;
                    $valorcamisetas = 0;
                } else {
                    $camisetas = $_POST['camisetas'];
                    if (empty($_POST['radiocamisetas'])) {
                        $valorcamisetas = 33000;
                    } else {
                        $valorcamisetas = $_POST['valorcamisetas'];
                    }
                }
                $totalcamisetas = $camisetas * $valorcamisetas;
                if ($_POST['camisetasninos'] == '' or $_POST['camisetasninos'] == 0) {
                    $camisetasninos = 0;
                    $valorcamisetasninos = 0;
                } else {
                    $camisetasninos = $_POST['camisetasninos'];
                    if (empty($_POST['radiocamisetasninos'])) {
                        $valorcamisetasninos = 30000;
                    } else {
                        $valorcamisetasninos = $_POST['valorcamisetasninos'];
                    }
                }
                $totalcamisetasninos = $camisetasninos * $valorcamisetasninos;
                if ($_POST['leggings'] == '' or $_POST['leggings'] == 0) {
                    $leggings = 0;
                    $valorleggings = 0;
                } else {
                    $leggings = $_POST['leggings'];
                    if (empty($_POST['radioleggings'])) {
                        $valorleggings = 50000;
                    } else {
                        $valorleggings = $_POST['valorleggings'];
                    }
                }
                $totalleggings = $leggings * $valorleggings;
                if ($_POST['leggingscuerina'] == '' or $_POST['leggingscuerina'] == 0) {
                    $leggingscuerina = 0;
                    $valorleggingscuerina = 0;
                } else {
                    $leggingscuerina = $_POST['leggingscuerina'];
                    if (empty($_POST['radioleggingscuerina'])) {
                        $valorleggingscuerina = 50000;
                    } else {
                        $valorleggingscuerina = $_POST['valorleggingscuerina'];
                    }
                }
                $totalleggingscuerina = $leggingscuerina * $valorleggingscuerina;
                if ($_POST['bicicleterocuerina'] == '' or $_POST['bicicleterocuerina'] == 0) {
                    $bicicleterocuerina = 0;
                    $valorbicicleterocuerina = 0;
                } else {
                    $bicicleterocuerina = $_POST['bicicleterocuerina'];
                    if (empty($_POST['radiobicicleterocuerina'])) {
                        $valorbicicleterocuerina = 40000;
                    } else {
                        $valorbicicleterocuerina = $_POST['valorbicicleterocuerina'];
                    }
                }
                $totalbicicleterocuerina = $bicicleterocuerina * $valorbicicleterocuerina;
                if ($_POST['faldacuerina'] == '' or $_POST['faldacuerina'] == 0) {
                    $faldacuerina = 0;
                    $valorfaldacuerina = 0;
                } else {
                    $faldacuerina = $_POST['faldacuerina'];
                    if (empty($_POST['radiofaldacuerina'])) {
                        $valorfaldacuerina = 40000;
                    } else {
                        $valorfaldacuerina = $_POST['valorfaldacuerina'];
                    }
                }
                $totalfaldacuerina = $faldacuerina * $valorfaldacuerina;
                if ($_POST['leggingsninho'] == '' or $_POST['leggingsninho'] == 0) {
                    $leggingsninho = 0;
                    $valorleggingsninho = 0;
                } else {
                    $leggingsninho = $_POST['leggingsninho'];
                    if (empty($_POST['radioleggingsninho'])) {
                        $valorleggingsninho = 40000;
                    } else {
                        $valorleggingsninho = $_POST['valorleggingsninho'];
                    }
                }
                $totalleggingsninho = $leggingsninho * $valorleggingsninho;
                if ($_POST['jeans'] == '' or $_POST['jeans'] == 0) {
                    $jeans = 0;
                    $valorjeans = 0;
                } else {
                    $jeans = $_POST['jeans'];
                    if (empty($_POST['radiojeans'])) {
                        $valorjeans = 50000;
                    } else {
                        $valorjeans = $_POST['valorjeans'];
                    }
                }
                $totaljeans = $jeans * $valorjeans;
                if ($_POST['bikini'] == '' or $_POST['bikini'] == 0) {
                    $bikini = 0;
                    $valorbikini = 0;
                } else {
                    $bikini = $_POST['bikini'];
                    if (empty($_POST['radiobikini'])) {
                        $valorbikini = 47000;
                    } else {
                        $valorbikini = $_POST['valorbikini'];
                    }
                }
                $totalbikini = $bikini * $valorbikini;
            } elseif ($allproductspera < 12) {
                if ($_POST['clasicas'] == '' or $_POST['clasicas'] == 0) {
                    $clasicas = 0;
                    $valorclasicas = 0;
                } else {
                    $clasicas = $_POST['clasicas'];
                    if (empty($_POST['radioclasicas'])) {
                        $valorclasicas = 70000;
                    } else {
                        $valorclasicas = $_POST['valorclasicas'];
                    }
                }
                $totalclasicas = $clasicas * $valorclasicas;
                if ($_POST['plataformas'] == '' or $_POST['plataformas'] == 0) {
                    $plataformas = 0;
                    $valorplataformas = 0;
                } else {
                    $plataformas = $_POST['plataformas'];
                    if (empty($_POST['radioplataformas'])) {
                        $valorplataformas = 80000;
                    } else {
                        $valorplataformas = $_POST['valorplataformas'];
                    }
                }
                $totalplataformas = $plataformas * $valorplataformas;
                if ($_POST['perablack'] == '' or $_POST['perablack'] == 0) {
                    $perablack = 0;
                    $valorperablack = 0;
                } else {
                    $perablack = $_POST['perablack'];
                    if (empty($_POST['radioperablack'])) {
                        $valorperablack = 80000;
                    } else {
                        $valorperablack = $_POST['valorperablack'];
                    }
                }
                $totalperablack = $perablack * $valorperablack;
                if ($_POST['clasicaspiedrita'] == '' or $_POST['clasicaspiedrita'] == 0) {
                    $clasicaspiedrita = 0;
                    $valorclasicaspiedrita = 0;
                } else {
                    $clasicaspiedrita = $_POST['clasicaspiedrita'];
                    if (empty($_POST['radioclasicaspiedrita'])) {
                        $valorclasicaspiedrita = 75000;
                    } else {
                        $valorclasicaspiedrita = $_POST['valorclasicaspiedrita'];
                    }
                }
                $totalclasicaspiedrita = $clasicaspiedrita * $valorclasicaspiedrita;
                if ($_POST['plataformaspiedrita'] == '' or $_POST['plataformaspiedrita'] == 0) {
                    $plataformaspiedrita = 0;
                    $valorplataformaspiedrita = 0;
                } else {
                    $plataformaspiedrita = $_POST['plataformaspiedrita'];
                    if (empty($_POST['radioplataformaspiedrita'])) {
                        $valorplataformaspiedrita = 87000;
                    } else {
                        $valorplataformaspiedrita = $_POST['valorplataformaspiedrita'];
                    }
                }
                $totalplataformaspiedrita = $plataformaspiedrita * $valorplataformaspiedrita;
                if ($_POST['clasicasestrellita'] == '' or $_POST['clasicasestrellita'] == 0) {
                    $clasicasestrellita = 0;
                    $valorclasicasestrellita = 0;
                } else {
                    $clasicasestrellita = $_POST['clasicasestrellita'];
                    if (empty($_POST['radioclasicasestrellita'])) {
                        $valorclasicasestrellita = 75000;
                    } else {
                        $valorclasicasestrellita = $_POST['valorclasicasestrellita'];
                    }
                }
                $totalclasicasestrellita = $clasicasestrellita * $valorclasicasestrellita;
                if ($_POST['plataformasestrellita'] == '' or $_POST['plataformasestrellita'] == 0) {
                    $plataformasestrellita = 0;
                    $valorplataformasestrellita = 0;
                } else {
                    $plataformasestrellita = $_POST['plataformasestrellita'];
                    if (empty($_POST['radioplataformasestrellita'])) {
                        $valorplataformasestrellita = 87000;
                    } else {
                        $valorplataformasestrellita = $_POST['valorplataformasestrellita'];
                    }
                }
                $totalplataformasestrellita = $plataformasestrellita * $valorplataformasestrellita;
                if ($_POST['pijamas'] == '' or $_POST['pijamas'] == 0) {
                    $pijamas = 0;
                    $valorpijamas = 0;
                } else {
                    $pijamas = $_POST['pijamas'];
                    if (empty($_POST['radiopijamas'])) {
                        $valorpijamas = 52000;
                    } else {
                        $valorpijamas = $_POST['valorpijamas'];
                    }
                }
                $totalpijamas = $pijamas * $valorpijamas;
                if ($_POST['sisa'] == '' or $_POST['sisa'] == 0) {
                    $sisa = 0;
                    $valorsisa = 0;
                } else {
                    $sisa = $_POST['sisa'];
                    if (empty($_POST['radiosisa'])) {
                        $valorsisa = 57000;
                    } else {
                        $valorsisa = $_POST['valorsisa'];
                    }
                }
                $totalsisa = $sisa * $valorsisa;
                if ($_POST['larga'] == '' or $_POST['larga'] == 0) {
                    $larga = 0;
                    $valorlarga = 0;
                } else {
                    $larga = $_POST['larga'];
                    if (empty($_POST['radiolarga'])) {
                        $valorlarga = 70000;
                    } else {
                        $valorlarga = $_POST['valorlarga'];
                    }
                }
                $totallarga = $larga * $valorlarga;
                if ($_POST['cuellotortuga'] == '' or $_POST['cuellotortuga'] == 0) {
                    $cuellotortuga = 0;
                    $valorcuellotortuga = 0;
                } else {
                    $cuellotortuga = $_POST['cuellotortuga'];
                    if (empty($_POST['radiocuellotortuga'])) {
                        $valorcuellotortuga = 70000;
                    } else {
                        $valorcuellotortuga = $_POST['valorcuellotortuga'];
                    }
                }
                $totalcuellotortuga = $cuellotortuga * $valorcuellotortuga;
                if ($_POST['pantalonetas'] == '' or $_POST['pantalonetas'] == 0) {
                    $pantalonetas = 0;
                    $valorpantalonetas = 0;
                } else {
                    $pantalonetas = $_POST['pantalonetas'];
                    if (empty($_POST['radiopantalonetas'])) {
                        $valorpantalonetas = 70000;
                    } else {
                        $valorpantalonetas = $_POST['valorpantalonetas'];
                    }
                }
                $totalpantalonetas = $pantalonetas * $valorpantalonetas;
                if ($_POST['buso'] == '' or $_POST['buso'] == 0) {
                    $buso = 0;
                    $valorbuso = 0;
                } else {
                    $buso = $_POST['buso'];
                    if (empty($_POST['radiobuso'])) {
                        $valorbuso = 55000;
                    } else {
                        $valorbuso = $_POST['valorbuso'];
                    }
                }
                $totalbuso = $buso * $valorbuso;
                if ($_POST['camisetas'] == '' or $_POST['camisetas'] == 0) {
                    $camisetas = 0;
                    $valorcamisetas = 0;
                } else {
                    $camisetas = $_POST['camisetas'];
                    if (empty($_POST['radiocamisetas'])) {
                        $valorcamisetas = 48000;
                    } else {
                        $valorcamisetas = $_POST['valorcamisetas'];
                    }
                }
                $totalcamisetas = $camisetas * $valorcamisetas;
                if ($_POST['camisetasninos'] == '' or $_POST['camisetasninos'] == 0) {
                    $camisetasninos = 0;
                    $valorcamisetasninos = 0;
                } else {
                    $camisetasninos = $_POST['camisetasninos'];
                    if (empty($_POST['radiocamisetasninos'])) {
                        $valorcamisetasninos = 45000;
                    } else {
                        $valorcamisetasninos = $_POST['valorcamisetasninos'];
                    }
                }
                $totalcamisetasninos = $camisetasninos * $valorcamisetasninos;
                if ($_POST['leggings'] == '' or $_POST['leggings'] == 0) {
                    $leggings = 0;
                    $valorleggings = 0;
                } else {
                    $leggings = $_POST['leggings'];
                    if (empty($_POST['radioleggings'])) {
                        $valorleggings = 70000;
                    } else {
                        $valorleggings = $_POST['valorleggings'];
                    }
                }
                $totalleggings = $leggings * $valorleggings;
                if ($_POST['leggingscuerina'] == '' or $_POST['leggingscuerina'] == 0) {
                    $leggingscuerina = 0;
                    $valorleggingscuerina = 0;
                } else {
                    $leggingscuerina = $_POST['leggingscuerina'];
                    if (empty($_POST['radioleggingscuerina'])) {
                        $valorleggingscuerina = 70000;
                    } else {
                        $valorleggingscuerina = $_POST['valorleggingscuerina'];
                    }
                }
                $totalleggingscuerina = $leggingscuerina * $valorleggingscuerina;
                if ($_POST['bicicleterocuerina'] == '' or $_POST['bicicleterocuerina'] == 0) {
                    $bicicleterocuerina = 0;
                    $valorbicicleterocuerina = 0;
                } else {
                    $bicicleterocuerina = $_POST['bicicleterocuerina'];
                    if (empty($_POST['radiobicicleterocuerina'])) {
                        $valorbicicleterocuerina = 40000;
                    } else {
                        $valorbicicleterocuerina = $_POST['valorbicicleterocuerina'];
                    }
                }
                $totalbicicleterocuerina = $bicicleterocuerina * $valorbicicleterocuerina;
                if ($_POST['faldacuerina'] == '' or $_POST['faldacuerina'] == 0) {
                    $faldacuerina = 0;
                    $valorfaldacuerina = 0;
                } else {
                    $faldacuerina = $_POST['faldacuerina'];
                    if (empty($_POST['radiofaldacuerina'])) {
                        $valorfaldacuerina = 40000;
                    } else {
                        $valorfaldacuerina = $_POST['valorfaldacuerina'];
                    }
                }
                $totalfaldacuerina = $faldacuerina * $valorfaldacuerina;
                if ($_POST['leggingsninho'] == '' or $_POST['leggingsninho'] == 0) {
                    $leggingsninho = 0;
                    $valorleggingsninho = 0;
                } else {
                    $leggingsninho = $_POST['leggingsninho'];
                    if (empty($_POST['radioleggingsninho'])) {
                        $valorleggingsninho = 48000;
                    } else {
                        $valorleggingsninho = $_POST['valorleggingsninho'];
                    }
                }
                $totalleggingsninho = $leggingsninho * $valorleggingsninho;
                if ($_POST['jeans'] == '' or $_POST['jeans'] == 0) {
                    $jeans = 0;
                    $valorjeans = 0;
                } else {
                    $jeans = $_POST['jeans'];
                    if (empty($_POST['radiojeans'])) {
                        $valorjeans = 80000;
                    } else {
                        $valorjeans = $_POST['valorjeans'];
                    }
                }
                $totaljeans = $jeans * $valorjeans;
                if ($_POST['bikini'] == '' or $_POST['bikini'] == 0) {
                    $bikini = 0;
                    $valorbikini = 0;
                } else {
                    $bikini = $_POST['bikini'];
                    if (empty($_POST['radiobikini'])) {
                        $valorbikini = 70000;
                    } else {
                        $valorbikini = $_POST['valorbikini'];
                    }
                }
                $totalbikini = $bikini * $valorbikini;
            }
            //////MEDIAS///////
            if ($medias >= 6) {
                if ($_POST['mediasm'] == '' or $_POST['mediasm'] == 0) {
                    $mediasm = 0;
                    $valormediasm = 0;
                } else {
                    $mediasm = $_POST['mediasm'];
                    if (empty($_POST['radiomediasm'])) {
                        $valormediasm = 19000;
                    } else {
                        $valormediasm = $_POST['valormediasm'];
                    }
                }
                $totalmediasm = $mediasm * $valormediasm;
                if ($_POST['mediash'] == '' or $_POST['mediash'] == 0) {
                    $mediash = 0;
                    $valormediash = 0;
                } else {
                    $mediash = $_POST['mediash'];
                    if (empty($_POST['radiomediash'])) {
                        $valormediash = 16000;
                    } else {
                        $valormediash = $_POST['valormediash'];
                    }
                }
                $totalmediash = $mediash * $valormediash;
            } elseif ($medias < 6) {
                if ($_POST['mediasm'] == '' or $_POST['mediasm'] == 0) {
                    $mediasm = 0;
                    $valormediasm = 0;
                } else {
                    $mediasm = $_POST['mediasm'];
                    if (empty($_POST['radiomediasm'])) {
                        $valormediasm = 25000;
                    } else {
                        $valormediasm = $_POST['valormediasm'];
                    }
                }
                $totalmediasm = $mediasm * $valormediasm;
                if ($_POST['mediash'] == '' or $_POST['mediash'] == 0) {
                    $mediash = 0;
                    $valormediash = 0;
                } else {
                    $mediash = $_POST['mediash'];
                    if (empty($_POST['radiomediash'])) {
                        $valormediash = 22000;
                    } else {
                        $valormediash = $_POST['valormediash'];
                    }
                }
                $totalmediash = $mediash * $valormediash;
            }
            if ($rizos >= 8) {
                if ($_POST['rizos'] == '' or $_POST['rizos'] == 0) {
                    $rizos = 0;
                    $valorrizos = 0;
                } else {
                    $rizos = $_POST['rizos'];
                    if (empty($_POST['radiorizos'])) {
                        $valorrizos = 15000;
                    } else {
                        $valorrizos = $_POST['valorrizos'];
                    }
                }
                $totalrizos = $rizos * $valorrizos;
            } elseif ($medias < 8) {
                if ($_POST['rizos'] == '' or $_POST['rizos'] == 0) {
                    $rizos = 0;
                    $valorrizos = 0;
                } else {
                    $rizos = $_POST['rizos'];
                    if (empty($_POST['radiorizos'])) {
                        $valorrizos = 25000;
                    } else {
                        $valorrizos = $_POST['valorrizos'];
                    }
                }
                $totalrizos = $rizos * $valorrizos;
            }
            if ($_POST['flete'] == '' or $_POST['flete'] == 0) {
                $flete = 0;
            } else {
                $flete = $_POST['flete'];
            }
            if ($_POST['plantillas'] == '' or $_POST['plantillas'] == 0) {
                $plantillas = 0;
            } else {
                if (empty($_POST['radioplantillas'])) {
                    $valorplantillas = 5000;
                } else {
                    $valorplantillas = $_POST['valorplantillas'];
                }
            }
            $totalplantillas = $plantillas * $valorplantillas;
        }
        $totalalpargatas = $totalclasicas + $totalplataformas + $totalclasicaspiedrita + $totalplataformaspiedrita + $totalclasicasestrellita + $totalplataformasestrellita + $totalperablack;
        $totalropa = $totalsisa + $totallarga + $totalcuellotortuga + $totalpantalonetas + $totalbuso + $totalcamisetas + $totalcamisetasninos +   $totalleggings + $totalleggingsninho + $totalleggingscuerina + $totalbicicleterocuerina + $totalfaldacuerina + $totaljeans + $totalbikini + $totaltapabocas + $totalpijamas;
        $totalmedias = $totalmediasm + $totalmediash;
        $totalproductos = $totalalpargatas + $totalropa + $totalmedias + $totalrizos + $totalplantillas;
        $total = $totalproductos + $flete;
        $templateproductos = ('    <form action="' . base_url() . route_to('quoter_promotion') . '" method="POST">
      <table class="">
      <thead>
          <tr>
          <th scope="col">Productos</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Unidad</th>
          <th scope="col">&nbsp;&nbsp;<i class="fas fa-check"></i></th>
          <th scope="col">&nbsp;&nbsp;Total</th>
          </tr>
      </thead>          <tr>            <td scope="col">Cl&aacute;sicas</td>            <td scope="col"><input name="clasicas" class="caja-texto" type="number" value="' . $clasicas . '"></td>            <td scope="col"><input name="valorclasicas" class="caja-texto" type="number" value="' . $valorclasicas . '"></td>            <td scope="col"><input name="radioclasicas" class="caja-texto" type="checkbox"></td>            <td scope="col">' . $totalclasicas . '</td>          </tr>          <tr>            <td scope="col">Plataformas</td>            <td scope="col"><input name="plataformas" class="caja-texto" type="number" value="' . $plataformas . '"></td>            <td scope="col"><input name="valorplataformas" class="caja-texto" type="number" value="' . $valorplataformas . '"></td>            <td scope="col"><input name="radioplataformas" class="caja-texto" type="checkbox"></td>            <td scope="col">' . $totalplataformas . '</td>          </tr>          <tr>          <td scope="col">PeRa Black</td>
        <td scope="col"><input name="perablack" class="caja-texto" type="number" value="' . $perablack . '"></td>
        <td scope="col"><input name="valorperablack" class="caja-texto" type="number" value="' . $valorperablack . '"></td>
        <td scope="col"><input name="radioperablack" class="caja-texto" type="checkbox"></td>
        <td scope="col">' . $totalperablack . '</td>
      </tr>
        <tr>
          <td scope="col">Cl&aacute;sicas piedritas</td>
          <td scope="col"><input name="clasicaspiedrita" class="caja-texto" type="number" value="' . $clasicaspiedrita . '"></td>
          <td scope="col"><input name="valorclasicaspiedrita" class="caja-texto" type="number" value="' . $valorclasicaspiedrita . '"></td>
          <td scope="col"><input name="radioclasicaspiedrita" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalclasicaspiedrita . '</td>
        </tr>
        <tr>
          <td scope="col">Plataformas piedritas</td>
          <td scope="col"><input name="plataformaspiedrita" class="caja-texto" type="number" value="' . $plataformaspiedrita . '"></td>
          <td scope="col"><input name="valorplataformaspiedrita" class="caja-texto" type="number" value="' . $valorplataformaspiedrita . '"></td>
          <td scope="col"><input name="radioplataformaspiedrita" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalplataformaspiedrita . '</td>
        </tr>
        <tr>
          <td scope="col">Cl&aacute;sicas estrellitas</td>
          <td scope="col"><input name="clasicasestrellita" class="caja-texto" type="number" value="' . $clasicasestrellita . '"></td>
          <td scope="col"><input name="valorclasicasestrellita" class="caja-texto" type="number" value="' . $valorclasicasestrellita . '"></td>
          <td scope="col"><input name="radioclasicasestrellita" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalclasicasestrellita . '</td>
        </tr>
        <tr>
          <td scope="col">Plataformas estrellitas</td>
          <td scope="col"><input name="plataformasestrellita" class="caja-texto" type="number" value="' . $plataformasestrellita . '"></td>
          <td scope="col"><input name="valorplataformasestrellita" class="caja-texto" type="number" value="' . $valorplataformasestrellita . '"></td>
          <td scope="col"><input name="radioplataformasestrellita" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalplataformasestrellita . '</td>
        </tr>
        <tr>
          <td scope="col">Tapabocas</td>
          <td scope="col"><input name="cantidadtapabocas" class="caja-texto" type="number" value="' . $cantidadtapabocas . '"></td>
          <td scope="col"><input name="valortotaltapabocas" class="caja-texto" type="number" value="' . $totaltapabocas . '"></td>
          <td scope="col"> = </td>
          <td scope="col">' . $totaltapabocas . '</td>
        </tr>
        <tr>
          <td scope="col">Body Manga Sisa</td>
          <td scope="col"><input name="sisa" class="caja-texto" type="number" value="' . $sisa . '"></td>
          <td scope="col"><input name="valorsisa" class="caja-texto" type="number" value="' . $valorsisa . '"></td>
          <td scope="col"><input name="radiosisa" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalsisa . '</td>
        </tr>
        <tr>
          <td scope="col">Body Manga Larga</td>
          <td scope="col"><input name="larga" class="caja-texto" type="number" value="' . $larga . '"></td>
          <td scope="col"><input name="valorlarga" class="caja-texto" type="number" value="' . $valorlarga . '"></td>
          <td scope="col"><input name="radiolarga" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totallarga . '</td>
        </tr>
        <tr>
          <td scope="col">Body Cuello Tortuga</td>
          <td scope="col"><input name="cuellotortuga" class="caja-texto" type="number" value="' . $cuellotortuga . '"></td>
          <td scope="col"><input name="valorcuellotortuga" class="caja-texto" type="number" value="' . $valorcuellotortuga . '"></td>
          <td scope="col"><input name="radiocuellotortuga" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalcuellotortuga . '</td>
        </tr>
        <tr>
          <td scope="col">Pantalonetas</td>
          <td scope="col"><input name="pantalonetas" class="caja-texto" type="number" value="' . $pantalonetas . '"></td>
          <td scope="col"><input name="valorpantalonetas" class="caja-texto" type="number" value="' . $valorpantalonetas . '"></td>
          <td scope="col"><input name="radiopantalonetas" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalpantalonetas . '</td>
        </tr>
        <tr>
        <td scope="col">Buso Caballero</td>
        <td scope="col"><input name="buso" class="caja-texto" type="number" value="' . $buso . '"></td>
        <td scope="col"><input name="valorbuso" class="caja-texto" type="number" value="' . $valorbuso . '"></td>
        <td scope="col"><input name="radiobuso" class="caja-texto" type="checkbox"></td>
        <td scope="col">' . $totalbuso . '</td>
      </tr>
        <tr>
          <td scope="col">Camisetas</td>
          <td scope="col"><input name="camisetas" class="caja-texto" type="number" value="' . $camisetas . '"></td>
          <td scope="col"><input name="valorcamisetas" class="caja-texto" type="number" value="' . $valorcamisetas . '"></td>
          <td scope="col"><input name="radiocamisetas" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalcamisetas . '</td>
        </tr>
        <tr>
          <td scope="col">Camisetas Kids</td>
          <td scope="col"><input name="camisetasninos" class="caja-texto" type="number" value="' . $camisetasninos . '"></td>
          <td scope="col"><input name="valorcamisetasninos" class="caja-texto" type="number" value="' . $valorcamisetasninos . '"></td>
          <td scope="col"><input name="radiocamisetasninos" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalcamisetasninos . '</td>
        </tr>
        <tr>
          <td scope="col">Leggings Adulto</td>
          <td scope="col"><input name="leggings" class="caja-texto" type="number" value="' . $leggings . '"></td>
          <td scope="col"><input name="valorleggings" class="caja-texto" type="number" value="' . $valorleggings . '"></td>
          <td scope="col"><input name="radioleggings" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalleggings . '</td>
        </tr>
        <tr>
          <td scope="col">Leggings Niña</td>
          <td scope="col"><input name="leggingsninho" class="caja-texto" type="number" value="' . $leggingsninho . '"></td>
          <td scope="col"><input name="valorleggingsninho" class="caja-texto" type="number" value="' . $valorleggingsninho . '"></td>
          <td scope="col"><input name="radioleggingsninho" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalleggingsninho . '</td>
        </tr>
        <tr>
        <td scope="col">Leggings Cuerina</td>
        <td scope="col"><input name="leggingscuerina" class="caja-texto" type="number" value="' . $leggingscuerina . '"></td>
        <td scope="col"><input name="valorleggingscuerina" class="caja-texto" type="number" value="' . $valorleggingscuerina . '"></td>
        <td scope="col"><input name="radioleggingscuerina" class="caja-texto" type="checkbox"></td>
        <td scope="col">' . $totalleggingscuerina . '</td>
      </tr>
      <tr>
        <td scope="col">Bicicletero Cuerina</td>
        <td scope="col"><input name="bicicleterocuerina" class="caja-texto" type="number" value="' . $bicicleterocuerina . '"></td>
        <td scope="col"><input name="valorbicicleterocuerina" class="caja-texto" type="number" value="' . $valorbicicleterocuerina . '"></td>
        <td scope="col"><input name="radiobicicleterocuerina" class="caja-texto" type="checkbox"></td>
        <td scope="col">' . $totalbicicleterocuerina . '</td>
      </tr>
      <tr>
        <td scope="col">Falda Cuerina</td>
        <td scope="col"><input name="faldacuerina" class="caja-texto" type="number" value="' . $faldacuerina . '"></td>
        <td scope="col"><input name="valorfaldacuerina" class="caja-texto" type="number" value="' . $valorfaldacuerina . '"></td>
        <td scope="col"><input name="radiofaldacuerina" class="caja-texto" type="checkbox"></td>
        <td scope="col">' . $totalfaldacuerina . '</td>
      </tr>
        <tr>
          <td scope="col">Jeans</td>
          <td scope="col"><input name="jeans" class="caja-texto" type="number" value="' . $jeans . '"></td>
          <td scope="col"><input name="valorjeans" class="caja-texto" type="number" value="' . $valorjeans . '"></td>
          <td scope="col"><input name="radiojeans" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totaljeans . '</td>
        </tr>
            <tr>
          <td scope="col">Bikini</td>
          <td scope="col"><input name="bikini" class="caja-texto" type="number" value="' . $bikini . '"></td>
          <td scope="col"><input name="valorbikini" class="caja-texto" type="number" value="' . $valorbikini . '"></td>
          <td scope="col"><input name="radiobikini" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalbikini . '</td>
        </tr>
        <tr>
          <td scope="col">PeRa Pijamas</td>
          <td scope="col"><input name="pijamas" class="caja-texto" type="number" value="' . $pijamas . '"></td>
          <td scope="col"><input name="valorpijamas" class="caja-texto" type="number" value="' . $valorpijamas . '"></td>
          <td scope="col"><input name="radiopijamas" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalpijamas . '</td>
        </tr>
        <tr>
          <td scope="col">Medias Mujer</td>
          <td scope="col"><input name="mediasm" class="caja-texto" type="number" value="' . $mediasm . '"></td>
          <td scope="col"><input name="valormediasm" class="caja-texto" type="number" value="' . $valormediasm . '"></td>
          <td scope="col"><input name="radiomediasm" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalmediasm . '</td>
        </tr>
        <tr>
          <td scope="col">Medias Hombre</td>
          <td scope="col"><input name="mediash" class="caja-texto" type="number" value="' . $mediash . '"></td>
          <td scope="col"><input name="valormediash" class="caja-texto" type="number" value="' . $valormediash . '"></td>
          <td scope="col"><input name="radiomediash" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalmediash . '</td>
        </tr>
        <tr>
          <td scope="col">PeRa Rizos</td>
          <td scope="col"><input name="rizos" class="caja-texto" type="number" value="' . $rizos . '"></td>
          <td scope="col"><input name="valorrizos" class="caja-texto" type="number" value="' . $valorrizos . '"></td>
          <td scope="col"><input name="radiorizos" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalrizos . '</td>
        </tr>
        <tr>
          <td scope="col">PeRa Plantillas</td>
          <td scope="col"><input name="plantillas" class="caja-texto" type="number" value="' . $plantillas . '"></td>
          <td scope="col"><input name="valorplantillas" class="caja-texto" type="number" value="' . $valorplantillas . '"></td>
          <td scope="col"><input name="radioplantillas" class="caja-texto" type="checkbox"></td>
          <td scope="col">' . $totalplantillas . '</td>
        </tr>
            <tr>
          <td scope="col"><b>FLETE</b></td>
          <td scope="col"></td>
          <td scope="col"><input name="flete" class="caja-texto" type="number" value="' . $flete . '"></td>
        </tr>      </table>      <input class="agregar-producto" type="submit" value="COTIZAR">      <input type="hidden" name="r" value="cotizador_mayo">      <input type="hidden" name="crud" value="set">      </form>    			');
    } else {
        $templateproductos = ('  <form action="' . base_url() . route_to('quoter_promotion') . '" method="POST">    <table class="">
      <thead>
          <tr>
        <th scope="col">Productos</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Unidad</th>
        <th scope="col">&nbsp;&nbsp;<i class="fas fa-check"></i></th>
        <th scope="col">&nbsp;&nbsp;Total</th>
          </tr>
      </thead>
      <tr>
        <td scope="col">Cl&aacute;sicas</td>
        <td scope="col"><input name="clasicas" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorclasicas" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioclasicas" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Plataformas</td>
        <td scope="col"><input name="plataformas" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorplataformas" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioplataformas" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">PeRa Black</td>
        <td scope="col"><input name="perablack" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorperablack" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioperablack" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Cl&aacute;sicas piedritas</td>
        <td scope="col"><input name="clasicaspiedrita" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorclasicaspiedrita" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioclasicaspiedrita" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Plataformas piedritas</td>
        <td scope="col"><input name="plataformaspiedrita" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorplataformaspiedrita" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioplataformaspiedrita" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Cl&aacute;sicas estrellitas</td>
        <td scope="col"><input name="clasicasestrellita" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorclasicasestrellita" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioclasicasestrellita" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Plataformas estrellitas</td>
        <td scope="col"><input name="plataformasestrellita" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorplataformasestrellita" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioplataformasestrellita" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Tapabocas</td>
        <td scope="col"><input name="cantidadtapabocas" class="caja-texto" type="number" value=""></td>
        <td scope="col"><input name="valortotaltapabocas" class="caja-texto" type="number" value="" placeholder="valor total"></td>
        <td scope="col"> = </td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Body Manga Sisa</td>
        <td scope="col"><input name="sisa" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorsisa" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiosisa" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Body Manga Larga</td>
        <td scope="col"><input name="larga" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorlarga" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiolarga" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Body Cuello Tortuga</td>
        <td scope="col"><input name="cuellotortuga" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorcuellotortuga" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiocuellotortuga" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Pantalonetas</td>
        <td scope="col"><input name="pantalonetas" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorpantalonetas" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiopantalonetas" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Busos Caballero</td>
        <td scope="col"><input name="buso" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorbuso" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiobuso" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Camisetas</td>
        <td scope="col"><input name="camisetas" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorcamisetas" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiocamisetas" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
      <td scope="col">Camisetas Kids</td>
      <td scope="col"><input name="camisetasninos" class="caja-texto" type="number" ></td>
      <td scope="col"><input name="valorcamisetasninos" class="caja-texto" type="number"></td>
      <td scope="col"><input name="radiocamisetasninos" class="caja-texto" type="checkbox"></td>
      <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Leggings Adulto</td>
        <td scope="col"><input name="leggings" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorleggings" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioleggings" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Leggings Niña</td>
        <td scope="col"><input name="leggingsninho" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorleggingsninho" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioleggingsninho" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Leggings Cuerina</td>
        <td scope="col"><input name="leggingscuerina" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorleggingscuerina" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioleggingscuerina" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Bicicletero Cuerina</td>
        <td scope="col"><input name="bicicleterocuerina" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorbicicleterocuerina" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiobicicleterocuerina" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Falda Cuerina</td>
        <td scope="col"><input name="faldacuerina" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorfaldacuerina" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiofaldacuerina" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Jeans</td>
        <td scope="col"><input name="jeans" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorjeans" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiojeans" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Bikini</td>
        <td scope="col"><input name="bikini" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorbikini" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiobikini" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Pijamas</td>
        <td scope="col"><input name="pijamas" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorpijamas" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiopijamas" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Medias Mujer</td>
        <td scope="col"><input name="mediasm" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valormediasm" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiomediasm" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Medias Hombre</td>
        <td scope="col"><input name="mediash" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valormediash" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiomediash" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">PeRa Rizos</td>
        <td scope="col"><input name="rizos" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorrizos" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radiorizos" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
      <tr>
        <td scope="col">Plantillas</td>
        <td scope="col"><input name="plantillas" class="caja-texto" type="number" ></td>
        <td scope="col"><input name="valorplantillas" class="caja-texto" type="number"></td>
        <td scope="col"><input name="radioplantillas" class="caja-texto" type="checkbox"></td>
        <td scope="col"></td>
      </tr>
        <tr>
        <td scope="col"><b>FLETE</b></td>
        <td scope="col"></td>
        <td scope="col"><input name="flete" class="caja-texto" type="number"></td>
      </tr>    </table>    <input class="agregar-producto" type="submit" value="COTIZAR">    <input type="hidden" name="r" value="cotizador_mayo">    <input type="hidden" name="crud" value="set">    </form>  			');
    }
    if (!empty($alpargatas)) {
        $resumentotalalpargatas = ('      <tr class="resumencotizador">
 <td scope="col"></td>
 <td scope="col"><b>TOTAL ALPARGATAS</b></td>
 <td scope="col"></td>
 <td scope="col"><b>' . number_format($totalalpargatas) . '</b></td>      </tr>  ');
    } else {
        $resumentotalalpargatas = ('');
    }
    if (!empty($ropa)) {
        $resumentotalropa = ('      <tr class="resumencotizador">
 <td scope="col"></td>
 <td scope="col"><b>TOTAL TERCEROS ROPA</b></td>
 <td scope="col"></td>
 <td scope="col"><b>' . number_format($totalropa) . '</b></td>      </tr>  ');
    } else {
        $resumentotalropa = ('');
    }
    if (!empty($medias)) {
        $resumentotalmedias = ('      <tr class="resumencotizador">
 <td scope="col"></td>
 <td scope="col"><b>TOTAL MEDIAS</b></td>
 <td scope="col"></td>
 <td scope="col"><b>' . number_format($totalmedias) . '</b></td>      </tr>  ');
    } else {
        $resumentotalmedias = ('');
    }
    if (!empty($rizos)) {
        $resumentotalrizos = ('      <tr class="resumencotizador">
 <td scope="col"></td>
 <td scope="col"><b>TOTAL TERCEROS COSM&Eacute;TICOS</b></td>
 <td scope="col"></td>
 <td scope="col"><b>' . number_format($totalrizos) . '</b></td>      </tr>  ');
    } else {
        $resumentotalrizos = ('');
    }
    if (!empty($plantillas)) {
        $resumentotalplantillas = ('      <tr class="resumencotizador">
 <td scope="col"></td>
 <td scope="col"><b>TOTAL PLANTILLAS</b></td>
 <td scope="col"></td>
 <td scope="col"><b>' . number_format($totalplantillas) . '</b></td>      </tr>  ');
    } else {
        $resumentotalplantillas = ('');
    }
    if (!empty($totalproductos)) {
        $resumentotal = ('      <tr>
 <td scope="col"></td>
 <td scope="col"><b>TOTAL</b></td>
 <td scope="col"></td>
 <td scope="col"><b>' . number_format($totalproductos) . '</b></td>      </tr>  ');
    } else {
        $resumentotal = ('');
    }
    if (!empty($total)) {
        $resumentotal = ('      <tr class="celdatotal">
 <td scope="col"></td>
 <td scope="col"><b>TOTAL A PAGAR</b></td>
 <td scope="col"></td>
 <td scope="col"><b>' . number_format($total) . '</b></td>      </tr>  ');
    } else {
        $resumentotal = ('');
    }
    if (!empty($flete)) {
        $resumenflete = ('      <tr>
 <td scope="col"></td>
 <td scope="col">FLETE</td>
 <td scope="col"></td>
 <td scope="col">' . number_format($flete) . '</td>      </tr>  ');
    } else {
        $resumenflete = ('');
    }
    if (!empty($clasicas)) {
        if ($clasicas > 0) {
            $resumenclasicas = ('    <tr>      <td scope="col">' . $clasicas . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Cl&aacute;sicas</td>      <td scope="col">(C/U a ' . number_format($valorclasicas) . ')</td>      <td scope="col">' . number_format($totalclasicas) . '</td>    </tr>    ');
        } else {
            $resumenclasicas = '';
        }
    } else {
        $resumenclasicas = '';
    }
    if (!empty($cantidadtapabocas)) {
        if ($cantidadtapabocas > 0) {
            $resumentapabocas = ('    <tr>      <td scope="col">' . $cantidadtapabocas . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Tapabocas</td>      <td scope="col">-</td>      <td scope="col">' . number_format($totaltapabocas) . '</td>    </tr>    ');
        } else {
            $resumentapabocas = '';
        }
    } else {
        $resumentapabocas = '';
    }
    if (!empty($rizos)) {
        if ($rizos > 0) {
            $resumenrizos = ('    <tr>      <td scope="col">' . $rizos . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> PeRa Rizos</td>      <td scope="col">(C/U a ' . number_format($valorrizos) . ')</td>      <td scope="col">' . number_format($totalrizos) . '</td>    </tr>    ');
        } else {
            $resumenrizos = '';
        }
    } else {
        $resumenrizos = '';
    }
    if (!empty($plataformas)) {
        if ($plataformas > 0) {
            $resumenplataformas = ('    <tr>      <td scope="col">' . $plataformas . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Plataformas</td>      <td scope="col">(C/U a ' . number_format($valorplataformas) . ')</td>      <td scope="col">' . number_format($totalplataformas) . '</td>    </tr>    ');
        } else {
            $resumenplataformas = '';
        }
    } else {
        $resumenplataformas = '';
    }
    if (!empty($perablack)) {
        if ($perablack > 0) {
            $resumenperablack = ('    <tr>      <td scope="col">' . $perablack . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> PeRa Black</td>      <td scope="col">(C/U a ' . number_format($valorperablack) . ')</td>      <td scope="col">' . number_format($totalperablack) . '</td>    </tr>    ');
        } else {
            $resumenperablack = '';
        }
    } else {
        $resumenperablack = '';
    }
    if (!empty($clasicaspiedrita)) {
        if ($clasicaspiedrita > 0) {
            $resumenclasicaspiedrita = ('    <tr>      <td scope="col">' . $clasicaspiedrita . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Cl&aacute;sicas Piedritas</td>      <td scope="col">(C/U a ' . number_format($valorclasicaspiedrita) . ')</td>      <td scope="col">' . number_format($totalclasicaspiedrita) . '</td>    </tr>    ');
        } else {
            $resumenclasicaspiedrita = '';
        }
    } else {
        $resumenclasicaspiedrita = '';
    }
    if (!empty($plataformaspiedrita)) {
        if ($plataformaspiedrita > 0) {
            $resumenplataformaspiedrita = ('    <tr>      <td scope="col">' . $plataformaspiedrita . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Plataformas Piedritas</td>      <td scope="col">(C/U a ' . number_format($valorplataformaspiedrita) . ')</td>      <td scope="col">' . number_format($totalplataformaspiedrita) . '</td>    </tr>    ');
        } else {
            $resumenplataformaspiedrita = '';
        }
    } else {
        $resumenplataformaspiedrita = '';
    }
    if (!empty($clasicasestrellita)) {
        if ($clasicasestrellita > 0) {
            $resumenclasicasestrellita = ('    <tr>      <td scope="col">' . $clasicasestrellita . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Cl&aacute;sicas estrellitas</td>      <td scope="col">(C/U a ' . number_format($valorclasicasestrellita) . ')</td>      <td scope="col">' . number_format($totalclasicasestrellita) . '</td>    </tr>    ');
        } else {
            $resumenclasicasestrellita = '';
        }
    } else {
        $resumenclasicasestrellita = '';
    }
    if (!empty($plataformasestrellita)) {
        if ($plataformasestrellita > 0) {
            $resumenplataformasestrellita = ('    <tr>      <td scope="col">' . $plataformasestrellita . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Plataformas estrellitas</td>      <td scope="col">(C/U a ' . number_format($valorplataformasestrellita) . ')</td>      <td scope="col">' . number_format($totalplataformasestrellita) . '</td>    </tr>    ');
        } else {
            $resumenplataformasestrellita = '';
        }
    } else {
        $resumenplataformasestrellita = '';
    }
    if (!empty($totalropa)) {
        if ($totalropa > 0) {
            $tercerosropa = ('    <tr>      <td scope="col"></td>      <td scope="col"><b>Dinero de Terceros ROPA</b></td>    </tr>    ');
        }
    } else {
        $tercerosropa = '';
    }
    if (!empty($totalrizos)) {
        if ($totalrizos > 0) {
            $tercerosrizos = ('    <tr>      <td scope="col"></td>      <td scope="col"><b>Dinero de Terceros COSM&Eacute;TICOS</b></td>    </tr>    ');
        }
    } else {
        $tercerosrizos = '';
    }
    if (!empty($sisa)) {
        if ($sisa > 0) {
            $resumensisa = ('    <tr>      <td scope="col">' . $sisa . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Body Manga Sisa</td>      <td scope="col">(C/U a ' . number_format($valorsisa) . ')</td>      <td scope="col">' . number_format($totalsisa) . '</td>    </tr>    ');
        } else {
            $resumensisa = '';
        }
    } else {
        $resumensisa = '';
    }
    if (!empty($larga)) {
        if ($larga > 0) {
            $resumenlarga = ('    <tr>      <td scope="col">' . $larga . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Body Manga Larga</td>      <td scope="col">(C/U a ' . number_format($valorlarga) . ')</td>      <td scope="col">' . number_format($totallarga) . '</td>    </tr>    ');
        } else {
            $resumenlarga = '';
        }
    } else {
        $resumenlarga = '';
    }
    if (!empty($cuellotortuga)) {
        if ($cuellotortuga > 0) {
            $resumencuellotortuga = ('    <tr>      <td scope="col">' . $cuellotortuga . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Body Cuello Tortuga</td>      <td scope="col">(C/U a ' . number_format($valorcuellotortuga) . ')</td>      <td scope="col">' . number_format($totalcuellotortuga) . '</td>    </tr>    ');
        } else {
            $resumencuellotortuga = '';
        }
    } else {
        $resumencuellotortuga = '';
    }
    if (!empty($pantalonetas)) {
        if ($pantalonetas > 0) {
            $resumenpantalonetas = ('    <tr>      <td scope="col">' . $pantalonetas . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Pantalonetas</td>      <td scope="col">(C/U a ' . number_format($valorpantalonetas) . ')</td>      <td scope="col">' . number_format($totalpantalonetas) . '</td>    </tr>    ');
        } else {
            $resumenpantalonetas = '';
        }
    } else {
        $resumenpantalonetas = '';
    }
    if (!empty($buso)) {
        if ($buso > 0) {
            $resumenbuso = ('    <tr>      <td scope="col">' . $buso . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Busos Caballero</td>      <td scope="col">(C/U a ' . number_format($valorbuso) . ')</td>      <td scope="col">' . number_format($totalbuso) . '</td>    </tr>    ');
        } else {
            $resumenbuso = '';
        }
    } else {
        $resumenbuso = '';
    }
    if (!empty($enterizos)) {
        if ($enterizos > 0) {
            $resumenenterizos = ('    <tr>      <td scope="col">' . $enterizos . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Enterizos</td>      <td scope="col">(C/U a ' . number_format($valorenterizos) . ')</td>      <td scope="col">' . number_format($totalenterizos) . '</td>    </tr>    ');
        } else {
            $resumenenterizos = '';
        }
    } else {
        $resumenenterizos = '';
    }
    if (!empty($camisetas)) {
        if ($camisetas > 0) {
            $resumencamisetas = ('    <tr>      <td scope="col">' . $camisetas . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Camisetas</td>      <td scope="col">(C/U a ' . number_format($valorcamisetas) . ')</td>      <td scope="col">' . number_format($totalcamisetas) . '</td>    </tr>    ');
        } else {
            $resumencamisetas = '';
        }
    } else {
        $resumencamisetas = '';
    }
    if (!empty($camisetasninos)) {
        if ($camisetasninos > 0) {
            $resumencamisetasninos = ('    <tr>      <td scope="col">' . $camisetasninos . ' </td>
<td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Camisetas Kids</td>
<td scope="col">(C/U a ' . number_format($valorcamisetasninos) . ')</td>
<td scope="col">' . number_format($totalcamisetasninos) . '</td>    </tr>    ');
        } else {
            $resumencamisetasninos = '';
        }
    } else {
        $resumencamisetasninos = '';
    }
    if (!empty($leggings)) {
        if ($leggings > 0) {
            $resumenleggings = ('    <tr>
<td scope="col">' . $leggings . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Leggings Adulto</td>      <td scope="col">(C/U a ' . number_format($valorleggings) . ')</td>      <td scope="col">' . number_format($totalleggings) . '</td>    </tr>    ');
        } else {
            $resumenleggings = '';
        }
    } else {
        $resumenleggings = '';
    }
    if (!empty($leggingscuerina)) {
        if ($leggingscuerina > 0) {
            $resumenleggingscuerina = ('    <tr>      <td scope="col">' . $leggingscuerina . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Leggings Cuerina</td>      <td scope="col">(C/U a ' . number_format($valorleggingscuerina) . ')</td>      <td scope="col">' . number_format($totalleggingscuerina) . '</td>    </tr>    ');
        } else {
            $resumenleggingscuerina = '';
        }
    } else {
        $resumenleggingscuerina = '';
    }
    if (!empty($bicicleterocuerina)) {
        if ($bicicleterocuerina > 0) {
            $resumenbicicleterocuerina = ('    <tr>      <td scope="col">' . $bicicleterocuerina . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Bicicletero Cuerina</td>      <td scope="col">(C/U a ' . number_format($valorbicicleterocuerina) . ')</td>      <td scope="col">' . number_format($totalbicicleterocuerina) . '</td>    </tr>    ');
        } else {
            $resumenbicicleterocuerina = '';
        }
    } else {
        $resumenbicicleterocuerina = '';
    }
    if (!empty($faldacuerina)) {
        if ($faldacuerina > 0) {
            $resumenfaldacuerina = ('    <tr>      <td scope="col">' . $faldacuerina . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Falda Cuerina</td>      <td scope="col">(C/U a ' . number_format($valorfaldacuerina) . ')</td>      <td scope="col">' . number_format($totalfaldacuerina) . '</td>    </tr>    ');
        } else {
            $resumenfaldacuerina = '';
        }
    } else {
        $resumenfaldacuerina = '';
    }
    if (!empty($leggingsninho)) {
        if ($leggingsninho > 0) {
            $resumenleggingsninho = ('    <tr>      <td scope="col">' . $leggingsninho . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Leggings Niña</td>      <td scope="col">(C/U a ' . number_format($valorleggingsninho) . ')</td>      <td scope="col">' . number_format($totalleggingsninho) . '</td>    </tr>    ');
        } else {
            $resumenleggingsninho = '';
        }
    } else {
        $resumenleggingsninho = '';
    }
    if (!empty($jeans)) {
        if ($jeans > 0) {
            $resumenjeans = ('    <tr>      <td scope="col">' . $jeans . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Jeans</td>      <td scope="col">(C/U a ' . number_format($valorjeans) . ')</td>      <td scope="col">' . number_format($totaljeans) . '</td>    </tr>    ');
        } else {
            $resumenjeans = '';
        }
    } else {
        $resumenjeans = '';
    }
    if (!empty($bikini)) {
        if ($bikini > 0) {
            $resumenbikini = ('    <tr>      <td scope="col">' . $bikini . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Bikini</td>      <td scope="col">(C/U a ' . number_format($valorbikini) . ')</td>      <td scope="col">' . number_format($totalbikini) . '</td>    </tr>    ');
        } else {
            $resumenbikini = '';
        }
    } else {
        $resumenbikini = '';
    }
    if (!empty($mediasm)) {
        if ($mediasm > 0) {
            $resumenmediasm = ('    <tr>      <td scope="col">' . $mediasm . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Medias Dama</td>      <td scope="col">(C/U a ' . number_format($valormediasm) . ')</td>      <td scope="col">' . number_format($totalmediasm) . '</td>    </tr>    ');
        } else {
            $resumenmediasm = '';
        }
    } else {
        $resumenmediasm = '';
    }
    if (!empty($mediash)) {
        if ($mediash > 0) {
            $resumenmediash = ('    <tr>      <td scope="col">' . $mediash . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Medias Caballero</td>      <td scope="col">(C/U a ' . number_format($valormediash) . ')</td>      <td scope="col">' . number_format($totalmediash) . '</td>    </tr>    ');
        } else {
            $resumenmediash = '';
        }
    } else {
        $resumenmediash = '';
    }
    if (!empty($plantillas)) {
        if ($plantillas > 0) {
            $resumenplantillas = ('    <tr>      <td scope="col">' . $plantillas . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Plantillas</td>      <td scope="col">(C/U a ' . number_format($valorplantillas) . ')</td>      <td scope="col">' . number_format($totalplantillas) . '</td>    </tr>    ');
        } else {
            $resumenplantillas = '';
        }
    } else {
        $resumenplantillas = '';
    }
    if (!empty($pijamas)) {
        if ($pijamas > 0) {
            $resumenpijamas = ('    <tr>      <td scope="col">' . $pijamas . ' </td>      <td scope="col"><img class="peraimg2" width="60px" src="./public/img/corporativas/peraimg.png" alt=""> Pijamas</td>      <td scope="col">(C/U a ' . number_format($valorpijamas) . ')</td>      <td scope="col">' . number_format($totalpijamas) . '</td>    </tr>    ');
        } else {
            $resumenpijamas = '';
        }
    } else {
        $resumenpijamas = '';
    }
    $all = ('<h1>Cotizador Promoción</h1><div class="row">  <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 cotizador">  ' . $templateproductos . '  </div>  <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5">  <h3>PeRa Pedido</h3>
 <table class="table  colortabla">
  ' . $resumenclasicas . '
  ' . $resumenplataformas . '
  ' . $resumenperablack . '
  ' . $resumenclasicaspiedrita . '
  ' . $resumenplataformaspiedrita . '
  ' . $resumenclasicasestrellita . '
  ' . $resumenplataformasestrellita . '
  ' . $resumenmediasm . '
  ' . $resumenmediash . '
  ' . $resumenplantillas . '
  ' . $resumenflete . '
  ' . $tercerosropa . '
  ' . $resumentapabocas . '
  ' . $resumenpijamas . '
  ' . $resumensisa . '
  ' . $resumenlarga . '
  ' . $resumencuellotortuga . '
  ' . $resumenpantalonetas . '
  ' . $resumenbuso . '
  ' . $resumenenterizos . '
  ' . $resumencamisetas . '
  ' . $resumencamisetasninos . '
  ' . $resumenleggings . '
  ' . $resumenleggingsninho . '
  ' . $resumenleggingscuerina . '
  ' . $resumenbicicleterocuerina . '
  ' . $resumenfaldacuerina . '
  ' . $resumenjeans . '
  ' . $resumenbikini . '
  ' . $tercerosrizos . '
  ' . $resumenrizos . '
  ' . $resumentotal . '
 </table>  </div>  <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">  </div></div>');
    printf($all);
    ?>
</div>
<?= $this->endSection() ?>