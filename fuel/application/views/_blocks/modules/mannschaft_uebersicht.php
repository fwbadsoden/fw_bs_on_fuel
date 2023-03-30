<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$stabis = array("Stadtbrandinspektor", "stellv. Stadtbrandinspektor");
$wehrfuehrung = array("Wehrführer", "stellv. Wehrführer");
$zugfuehrer = array("Zugführer");
?>

<div class="oneColumnBox" id="submenue">
    <div class="filter">
        <div class="thirdnavi_button"><a href="#anker_fuehrung" class="button_black" rel="nicescrolling">Führung</a></div>
        <div class="thirdnavi_button"><a href="#anker_mannschaft" class="button_black" rel="nicescrolling">Mannschaft</a></div>
        <div><a href="#top" class="backToTop" rel="nicescrolling"></a></div>
        <hr class="clear" />
    </div>        
</div>
<div class="jsplatzhalter"></div>

<div class="oneColumnBox">
    <ul id="anker_fuehrung" class="TeaserListe">

        <?php
        //$class = "";
        //$lastFunktion = "";
        //$linebreakZwischenStabiUndFuehrung = false;
        // Block 1 Stabis
        $listcount = 1;
        foreach ($fuehrung as $key => $f) {
            if (in_array($f["executive_name"], $stabis)) {

                if ($listcount > 3) {
                    $listcount = 1;
                }

                switch ($listcount) {
                    case '1': $class = ' class="first"';
                        break;
                    case '2': $class = ' class="second"';
                        break;
                    case '3': $class = ' class="third"';
                        break;
                }

                if ($f["geschlecht"] == 'm')
                    $dienstgrad_name = $f["grade_name_m"];
                elseif ($f["geschlecht"] == 'w')
                    $dienstgrad_name = $f["grade_name_w"];
                else
                    $dienstgrad_name = $f["dienstgrad_name"];
                ?>
                <li<?= $class ?>>
                    <figure>
                        <img src="<?= img_path('mannschaft/' . $f["image"]) ?>" />
                        <img src="<?= img_path('dienstgrad/' . $f["grade_image"]) ?>" class="abzeichen" original-title="Dienstgrad" rel="tipsy" />
                    </figure>
                    <h1><?= $f["vorname"] ?> <?= $f["name"] ?></h1>
                    <h2><?= $dienstgrad_name . ', ' . $f["executive_name"] ?></h2>
                    <p>
                        <?php
                        if (isset($f["geburtstag"]) && $f["geburtstag"] != '0000-00-00' && $f["beruf"] != "") {
                            echo get_alter($f["geburtstag"]) . " Jahre, " . $f["beruf"];
                        } elseif (isset($f["geburtstag"]) && $f["geburtstag"] != '0000-00-00' && $f["beruf"] == "") {
                            echo get_alter($f["geburtstag"]) . " Jahre";
                        } else {
                            if (isset($f["beruf"]) && $f["beruf"] != "") {
                                echo $f["beruf"];
                            } else {
                                echo '&nbsp; ';
                            }
                        }
                        ?>         
                    </p>
                </li>

                <?php
                $listcount++;
                unset($fuehrung[$key]);
            }
        }

        // Block 2 Wehrführung
        $listcount = 1;
        foreach ($fuehrung as $key => $f) {
            if (in_array($f["executive_name"], $wehrfuehrung)) {

                if ($listcount > 3) {
                    $listcount = 1;
                }

                switch ($listcount) {
                    case '1': $class = ' class="first"';
                        break;
                    case '2': $class = ' class="second"';
                        break;
                    case '3': $class = ' class="third"';
                        break;
                }

                if ($f["geschlecht"] == 'm')
                    $dienstgrad_name = $f["grade_name_m"];
                elseif ($f["geschlecht"] == 'w')
                    $dienstgrad_name = $f["grade_name_w"];
                else
                    $dienstgrad_name = $f["dienstgrad_name"];
                ?>
                <li<?= $class ?>>
                    <figure>
                        <img src="<?= img_path('mannschaft/' . $f["image"]) ?>" />
                        <img src="<?= img_path('dienstgrad/' . $f["grade_image"]) ?>" class="abzeichen" original-title="Dienstgrad" rel="tipsy" />
                    </figure>
                    <h1><?= $f["vorname"] ?> <?= $f["name"] ?></h1>
                    <h2><?= $dienstgrad_name . ', ' . $f["executive_name"] ?></h2>
                    <p>
                        <?php
                        if (isset($f["geburtstag"]) && $f["geburtstag"] != '0000-00-00' && $f["beruf"] != "") {
                            echo get_alter($f["geburtstag"]) . " Jahre, " . $f["beruf"];
                        } elseif (isset($f["geburtstag"]) && $f["geburtstag"] != '0000-00-00' && $f["beruf"] == "") {
                            echo get_alter($f["geburtstag"]) . " Jahre";
                        } else {
                            if (isset($f["beruf"]) && $f["beruf"] != "") {
                                echo $f["beruf"];
                            } else {
                                echo '&nbsp; ';
                            }
                        }
                        ?>         
                    </p>
                </li>

                <?php
                $listcount++;
                unset($fuehrung[$key]);
            }
        }

        // Block 3 Zugführer
        $listcount = 1;
        foreach ($fuehrung as $key => $f) {
            if (in_array($f["executive_name"], $zugfuehrer)) {

                if ($listcount > 3) {
                    $listcount = 1;
                }

                switch ($listcount) {
                    case '1': $class = ' class="first"';
                        break;
                    case '2': $class = ' class="second"';
                        break;
                    case '3': $class = ' class="third"';
                        break;
                }

                if ($f["geschlecht"] == 'm')
                    $dienstgrad_name = $f["grade_name_m"];
                elseif ($f["geschlecht"] == 'w')
                    $dienstgrad_name = $f["grade_name_w"];
                else
                    $dienstgrad_name = $f["dienstgrad_name"];
                ?>
                <li<?= $class ?>>
                    <figure>
                        <img src="<?= img_path('mannschaft/' . $f["image"]) ?>" />
                        <img src="<?= img_path('dienstgrad/' . $f["grade_image"]) ?>" class="abzeichen" original-title="Dienstgrad" rel="tipsy" />
                    </figure>
                    <h1><?= $f["vorname"] ?> <?= $f["name"] ?></h1>
                    <h2><?= $dienstgrad_name . ', ' . $f["executive_name"] ?></h2>
                    <p>
                        <?php
                        if (isset($f["geburtstag"]) && $f["geburtstag"] != '0000-00-00' && $f["beruf"] != "") {
                            echo get_alter($f["geburtstag"]) . " Jahre, " . $f["beruf"];
                        } elseif (isset($f["geburtstag"]) && $f["geburtstag"] != '0000-00-00' && $f["beruf"] == "") {
                            echo get_alter($f["geburtstag"]) . " Jahre";
                        } else {
                            if (isset($f["beruf"]) && $f["beruf"] != "") {
                                echo $f["beruf"];
                            } else {
                                echo '&nbsp; ';
                            }
                        }
                        ?>         
                    </p>
                </li>

                <?php
                $listcount++;
                unset($fuehrung[$key]);
            }
        }

// Block 4 Gruppenführer
        $listcount = 1;
        foreach ($fuehrung as $f) {

            if ($listcount > 3) {
                $listcount = 1;
            }

            switch ($listcount) {
                case '1': $class = ' class="first"';
                    break;
                case '2': $class = ' class="second"';
                    break;
                case '3': $class = ' class="third"';
                    break;
            }

            if ($f["geschlecht"] == 'm')
                $dienstgrad_name = $f["grade_name_m"];
            elseif ($f["geschlecht"] == 'w')
                $dienstgrad_name = $f["grade_name_w"];
            else
                $dienstgrad_name = $f["dienstgrad_name"];
            ?>
            <li<?= $class ?>>
                <figure>
                    <img src="<?= img_path('mannschaft/' . $f["image"]) ?>" />
                    <img src="<?= img_path('dienstgrad/' . $f["grade_image"]) ?>" class="abzeichen" original-title="Dienstgrad" rel="tipsy" />
                </figure>
                <h1><?= $f["vorname"] ?> <?= $f["name"] ?></h1>
                <h2><?= $dienstgrad_name . ', ' . $f["executive_name"] ?></h2>
                <p>
                    <?php
                    if (isset($f["geburtstag"]) && $f["geburtstag"] != '0000-00-00' && $f["beruf"] != "") {
                        echo get_alter($f["geburtstag"]) . " Jahre, " . $f["beruf"];
                    } elseif (isset($f["geburtstag"]) && $f["geburtstag"] != '0000-00-00' && $f["beruf"] == "") {
                        echo get_alter($f["geburtstag"]) . " Jahre";
                    } else {
                        if (isset($f["beruf"]) && $f["beruf"] != "") {
                            echo $f["beruf"];
                        } else {
                            echo '&nbsp; ';
                        }
                    }
                    ?>         
                </p>
            </li>

            <?php
            $listcount++;
        }
        ?>                    
    </ul>

    <hr class="clear" />

    <h1 class="module" id="anker_mannschaft">Mannschaft</h1>
    <div class="oneColumnBox">
        <ul class="TeaserListe">
            <?php
            $listcount = 1;
            foreach ($team as $t) :
                if ($listcount > 3)
                    $listcount = 1;

                switch ($listcount) {
                    case '1': $class = ' class="first"';
                        break;
                    case '2': $class = ' class="second"';
                        break;
                    case '3': $class = ' class="third"';
                        break;
                }
                $listcount++;
                if ($t["geschlecht"] == 'm')
                    $dienstgrad_name = $t["grade_name_m"];
                elseif ($t["geschlecht"] == 'w')
                    $dienstgrad_name = $t["grade_name_w"];
                else
                    $dienstgrad_name = $t["dienstgrad_name"];
                ?>
                <li<?= $class ?>>
                    <figure>
                        <img src="<?= img_path('mannschaft/' . $t["image"]) ?>" />
                        <img src="<?= img_path('dienstgrad/' . $t["grade_image"]) ?>" class="abzeichen" original-title="Dienstgrad" rel="tipsy" />
                    </figure>
                    <h1><?= $t["vorname"] ?> <?= $t["name"] ?></h1>
                    <h2><?= $dienstgrad_name ?></h2>
                    <p>
                        <?php
                        if (isset($t["geburtstag"]) && $t["geburtstag"] != '0000-00-00' && $t["beruf"] != "") {
                            echo get_alter($t["geburtstag"]) . " Jahre, " . $t["beruf"];
                        } elseif (isset($t["geburtstag"]) && $t["geburtstag"] != '0000-00-00' && $t["beruf"] == "") {
                            echo get_alter($t["geburtstag"]) . " Jahre";
                        } else {
                            if (isset($t["beruf"]) && $t["beruf"] != "") {
                                echo $t["beruf"];
                            } else {
                                echo '&nbsp; ';
                            }
                        }
                        ?>
                    </p>
                </li>
            <?php endforeach; ?>                    
        </ul>
        <hr class="clear" />

    </div>
    <hr class="clear" />
</div>
<hr class="clear" />
