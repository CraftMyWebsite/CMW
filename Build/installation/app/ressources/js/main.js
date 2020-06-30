function ajax_chmod() {
    var url = 'index.php?action=setchmod';
    $.post(url, function (data) {
        window.location = "index.php"
    });
}