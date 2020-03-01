<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title>Storico</title>

<style>td:nth-child(1) {font-size: unset !important;}</style>

<div class="col-lg-12">

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Operatore</th>
            <th style="width: 60%;">Richiesta</th>
            <th>URL</th>
            <th>Esito</th>
            <th>Data</th>
        </tr>
        </thead>

        <?php foreach ($history as $index => $row):     $CurrentTime    =   explode(' ',$row["CreatedAt"]); ?>

        <tbody>
        <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-<?php echo $index; ?>" aria-expanded="false" aria-controls="group-of-rows-<?php echo $index; ?>">
            <td><?php echo ucfirst($row["Operatore"]); ?></td>
            <td><?php echo $row["Richiesta"]; ?></td>
            <td><?php echo $row["URL"]; ?></td>
            <td>
                <?php echo '<i class="'.$esiti[$row["Esito"]].'"></i>'; ?>
            </td>
            <td>
                <?php echo ($CurrentTime[0] == $today) ? $CurrentTime[1] : $CurrentTime[0]; ?>
            </td>
        </tr>
        </tbody>


        <tbody id="group-of-rows-<?php echo $index; ?>" class="collapse" style="background-color: gainsboro;">
        <tr>
            <td>Response</td>
            <td>
                <?php echo $row["Response"]; ?>
            </td>
        </tr>

        <tr>
            <td>Request</td>
            <td>
                <?php echo $row["Request"]; ?>
            </td>
        </tr>
        </tbody>

        <?php endforeach; ?>

    </table>
</div>



