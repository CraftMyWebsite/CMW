function ajax_chmod() {
    const url = 'index.php?action=setchmod';
    $.post(url, function (data) {
        window.location = "index.php"
    });
}

function windows_force_install() {
    const url = 'index.php?action=windowsforceinstall';
    $.post(url, function (data) {
        window.location = "index.php"
    });
}