$('input[type=checkbox]').on('click', function() {
    window.location = '/final-project/process.php?completed=' + $(this).val() + '&id=' + $(this).attr('data-id')
});

