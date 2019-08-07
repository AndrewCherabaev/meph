<table class="error" style="width:100%;border-collapse:collapse;box-shadow:none;border:1px;">
    <tr>
        <td>
            Error: <span style="color:red;"><?= $errstr ?></span> in <span style="color:green;"><?= $errfile ?>@<?= $errline ?></span>
        </td>
    </tr>
    <tr>
        <td>
            Error cause: <span style="font-weight:bold;"><?= json_encode($errcontext, JSON_FORCE_OBJECT) ?>
        </td>
    </tr>
</table>